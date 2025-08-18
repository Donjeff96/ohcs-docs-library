<?php

namespace App\Http\Controllers\Documentation;

use App\Http\Controllers\Controller;
use App\Models\DocumentClassification;
use App\Models\DocumentLibrary;
use App\Models\DocumentType;
use App\Models\PersonnelMain;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class DocumentationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index (){

       return view('documentation.search-for-staff');
    }

    public function searchStaffProcess (Request $request){

        $this->validate($request,[
            'username' => 'required'
        ]);

        $ldap_con = ldap_connect(env('LDAP_IP'));

        $ldap_dn = env('LDAP_DN');
        $ldap_password = env('LDAP_PASSWORD');

        ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);

        $username = trim($request->username);

        if(@ldap_bind($ldap_con,$ldap_dn,$ldap_password)){

            
            $filter = "(|(sn=$username*)(givenname=$username*)(userprincipalname=$username*)(name=$username*))";
           
            $result = @ldap_search($ldap_con,env('LDAP_BASE_PATH'), $filter) or exit("Unable");
            $entries = @ldap_get_entries($ldap_con, $result);
 
            return back()->with(['data'=> $entries,'count' =>$entries['count'],'username' =>$username]);

        }else{

            return back()->with('error','Something went wrong, please try again');

        }


    }

    
    public function staffUploadInformation($userName){

        $decodeData = Crypt::decrypt($userName);

        $ldap_con = ldap_connect(env('LDAP_IP'));

        $ldap_dn = env('LDAP_DN');
        $ldap_password = env('LDAP_PASSWORD');

        ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);

        $username = trim($decodeData);

        if(@ldap_bind($ldap_con,$ldap_dn,$ldap_password)){

            
            $filter = "(|(userprincipalname=$username*))";
           
            $result = @ldap_search($ldap_con,env('LDAP_BASE_PATH'), $filter) or exit("Unable");
            $entries = @ldap_get_entries($ldap_con, $result);

            if(User::where('email',trim($entries[0]['userprincipalname'][0]))->get()->count() > 0){

                $user = User::where('email', '=', trim($entries[0]['userprincipalname'][0]))->first();

                $explodeDn = explode(',',$entries[0]['dn']);
    
                $exploadCat = explode('=',$explodeDn[1]);

                $updateDetails = User::find($user->id);
                if(key_exists('title',$entries[0])){$updateDetails->title = $entries[0]['title'][0];}
                //$updateDetails->name =  $entries[0]['displayname'][0];
                $updateDetails->category =  $exploadCat[1];
                $updateDetails->dc =  $entries[0]['dn'];
                if(key_exists('thumbnailphoto',$entries[0])){$updateDetails->photoUrl =  base64_encode($entries[0]['thumbnailphoto'][0]);}
                $updateDetails->update();

            }else{


                $explodeDn = explode(',',$entries[0]['dn']);

                $exploadCat = explode('=',$explodeDn[1]);

                $insertUser = new User();
                $insertUser->name =  $entries[0]['displayname'][0];
                $insertUser->email = $entries[0]['userprincipalname'][0];
                $insertUser->firstname =  $entries[0]['givenname'][0];
                $insertUser->surname =  $entries[0]['sn'][0];
                if(key_exists('title',$entries[0])){$insertUser->title = $entries[0]['title'][0];}
                $insertUser->username =  $entries[0]['samaccountname'][0];
                $insertUser->dc =  $entries[0]['dn'];

                if(key_exists('thumbnailphoto',$entries[0])){$insertUser->photoUrl =  base64_encode($entries[0]['thumbnailphoto'][0]);}

                
                $insertUser->category =  $exploadCat[1];
                $insertUser->password =  'No_PASSWORD';
    
                $insertUser->save();
            }


           $userData =  User::where('email',trim($entries[0]['userprincipalname'][0]))->get();
           $documentType = DocumentType::get();

           $documentList = DocumentLibrary::where('user_id',$userData[0]->id)->get();

          
            return view('documentation.upload-staff-documents',[
                'data' => $entries,
                'userData' => $userData[0],
                'documentType' => $documentType,
                'documentList' => $documentList,
                'pdfData' => '',
                'userName' => $userName
            ]);

        }else{

            return back()->with('error','Something went wrong, please try again');

        }
    }
    
    public function getDocumentClassifications (Request $request){

        $result = "";
    
        $type = DocumentClassification::where('document_type_id',$request->document_type_id)->orderBy('name')->get();
    
        $result .= "<option value=''>Select Classification</option>";

        $result .= "<option value='0'>All</option>";
    
        foreach ($type as $item) {
            
            $result .= "<option value='".$item->id."'>".$item->name."</option>";  
        }
    
        return $result;
    
    
    }

    public function uploadStaffDocumentsProcess (Request $request,$userID){

        $decodeID = Crypt::decrypt($userID);

        $status = '';

        $this->validate($request,[
            'document_type' => 'required|numeric',
            'document_classification' => 'required|numeric',
            'files' => 'required'
        ]);

        $userData = PersonnelMain::find($decodeID);

        $userDocumentPath = public_path($userData->serial_number.'/');

        if(!File::isDirectory($userDocumentPath)){

            File::makeDirectory($userDocumentPath,077,true,true);

        }

        if($request->document_classification == 0){

            foreach ($request->file('files') as $file) {

                $fileOrginalName = $file->getClientOriginalName();

                $split = explode('_',$fileOrginalName);

                if(DocumentClassification::where([['abbreviation',$split[0],['document_type_id',$request->document_type]]])->get()->count() > 0){

                    $documentTypeData = DocumentClassification::where([['abbreviation',$split[0],['document_type_id',$request->document_type]]])->get();

                    $classificationWithoutWhiteSpace = str_replace(" ",'',$documentTypeData[0]->name);

                    $documentNamePath = $userData->serial_number.'/'.$classificationWithoutWhiteSpace.'-'.auth()->user()->id.'-mof-'.time().rand(1,1000).'.'.$file->extension();
                    $file->move(public_path($userData->serial_number),$documentNamePath);

                    $uploadDocument = new DocumentLibrary();
                    $uploadDocument->user_id = $decodeID;
                    $uploadDocument->document_type_id = $request->document_type;
                    $uploadDocument->document_path = $documentNamePath;
                    $uploadDocument->document_classification_id = $documentTypeData[0]->id;
                    $uploadDocument->created_by = auth()->user()->id;
                    if(auth()->user()->user_cat != 7){$uploadDocument->status = 'Pending';}
                    if(!empty(trim($request->documnet_description))){ $uploadDocument->description = trim($request->documnet_description); }else{$uploadDocument->description = $documentTypeData[0]->name; }
                    $status = $uploadDocument->save();

                }

                

            }

            return $status ? back()->with('success','Documents uploaded successfully.') : back()->with('error','Something went wrong, please try again.');

        }else{

        $documentTypeData = DocumentClassification::find($request->document_classification);

        
        $classificationWithoutWhiteSpace = str_replace(" ",'',$documentTypeData->name);

        

        if($request->has('files')){

            foreach ($request->file('files') as $file) {

                $documentNamePath = $userData->username.'/'.$classificationWithoutWhiteSpace.'-'.auth()->user()->id.'-mof-'.time().rand(1,1000).'.'.$file->extension();
                $file->move(public_path($userData->username),$documentNamePath);

                $uploadDocument = new DocumentLibrary();
                $uploadDocument->user_id = $decodeID;
                $uploadDocument->document_type_id = $request->document_type;
                $uploadDocument->document_path = $documentNamePath;
                $uploadDocument->document_classification_id = $request->document_classification;
                $uploadDocument->created_by = auth()->user()->id;
                if(auth()->user()->user_cat != 7){$uploadDocument->status = 'Pending';}
                if(!empty(trim($request->documnet_description))){ $uploadDocument->description = trim($request->documnet_description); }else{$uploadDocument->description = $documentTypeData->name; }
                $status = $uploadDocument->save();
                
            }

           


        }
        
        return $status ? back()->with('success','Documents uploaded successfully.') : back()->with('error','Something went wrong, please try again.');

    }

        


    }


   

    public function replacePdfObject($userName,$pdfPath){

        $decodeData = Crypt::decrypt($userName);

        $decodeDataPath = Crypt::decrypt($pdfPath);

        $ldap_con = ldap_connect(env('LDAP_IP'));

        $ldap_dn = env('LDAP_DN');
        $ldap_password = env('LDAP_PASSWORD');

        ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);

        $username = trim($decodeData);

        if(@ldap_bind($ldap_con,$ldap_dn,$ldap_password)){

            
            $filter = "(|(userprincipalname=$username*))";
           
            $result = @ldap_search($ldap_con,env('LDAP_BASE_PATH'), $filter) or exit("Unable");
            $entries = @ldap_get_entries($ldap_con, $result);

            if(User::where('email',trim($entries[0]['userprincipalname'][0]))->get()->count() > 0){

                $user = User::where('email', '=', trim($entries[0]['userprincipalname'][0]))->first();

                $explodeDn = explode(',',$entries[0]['dn']);
    
                $exploadCat = explode('=',$explodeDn[1]);

                $updateDetails = User::find($user->id);
                if(key_exists('title',$entries[0])){$updateDetails->title = $entries[0]['title'][0];}
                //$updateDetails->name =  $entries[0]['displayname'][0];
                $updateDetails->category =  $exploadCat[1];
                $updateDetails->dc =  $entries[0]['dn'];
                if(key_exists('thumbnailphoto',$entries[0])){$updateDetails->photoUrl =  base64_encode($entries[0]['thumbnailphoto'][0]);}
                $updateDetails->update();

            }else{


                $explodeDn = explode(',',$entries[0]['dn']);

                $exploadCat = explode('=',$explodeDn[1]);

                $insertUser = new User();
                $insertUser->name =  $entries[0]['displayname'][0];
                $insertUser->email = $entries[0]['userprincipalname'][0];
                $insertUser->firstname =  $entries[0]['givenname'][0];
                $insertUser->surname =  $entries[0]['sn'][0];
                if(key_exists('title',$entries[0])){$insertUser->title = $entries[0]['title'][0];}
                $insertUser->username =  $entries[0]['samaccountname'][0];
                $insertUser->dc =  $entries[0]['dn'];

                if(key_exists('thumbnailphoto',$entries[0])){$insertUser->photoUrl =  base64_encode($entries[0]['thumbnailphoto'][0]);}

                
                $insertUser->category =  $exploadCat[1];
                $insertUser->password =  'No_PASSWORD';
    
                $insertUser->save();
            }


           $userData =  User::where('email',trim($entries[0]['userprincipalname'][0]))->get();
           $documentType = DocumentType::get();

           $documentList = DocumentLibrary::where('user_id',$userData[0]->id)->get();

          
            return view('documentation.upload-staff-documents',[
                'data' => $entries,
                'userData' => $userData[0],
                'documentType' => $documentType,
                'documentList' => $documentList,
                'pdfData' => $decodeDataPath,
                'userName' => $userName
            ]);

        }else{

            return back()->with('error','Something went wrong, please try again');

        }
    }


}

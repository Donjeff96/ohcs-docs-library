<?php

namespace App\Http\Controllers\MyProfile;

use App\Http\Controllers\Controller;
use App\Models\ContactRelationship;
use App\Models\DocumentLibrary;
use App\Models\Grade;
use App\Models\JobQualificationInformation;
use App\Models\ManagementUnit;
use App\Models\PostionAndPromotion;
use App\Models\PostionAndPromotionType;
use App\Models\SupervisorInformation;
use App\Models\User;
use Illuminate\Http\Request;

class MyProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function viewStaffBioInformation (){

        $decodeData = auth()->user()->username;

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

           $contactRelationshipList = ContactRelationship::orderBy('name','ASC')->get();

           $positionAndPromotionTypes = PostionAndPromotionType::orderBy('id','ASC')->get();
           
           $promotionUserList = PostionAndPromotion::where('user_id',$userData[0]->id)->orderBy('type_id','ASC')->get();
           $supervisorData = SupervisorInformation::where('user_id',$userData[0]->id)->orderBy('id','DESC')->limit(1)->get();
           
           $jobQualificationInformation = JobQualificationInformation::where('user_id',$userData[0]->id)->orderBy('id','DESC')->limit(1)->get();

            $documentCount = DocumentLibrary::where('user_id',$userData[0]->id)->get()->count();
            $entryDocsCount = DocumentLibrary::where([['user_id',$userData[0]->id],['document_type_id',1]])->get()->count();
            $inServiceDocsCount = DocumentLibrary::where([['user_id',$userData[0]->id],['document_type_id',2]])->get()->count();
            $gradeList = Grade::orderBy('name','ASC')->get();
            $managementUnitLIst = ManagementUnit::get();
            $recentUpload = DocumentLibrary::where('user_id',$userData[0]->id)->orderBy('id','DESC')->get();
        

            return view('profile.my-profile',[
                'data' => $entries,
                'userData' => $userData[0],
                'contactRelationshipList' => $contactRelationshipList,
                'positionAndPromotionTypes' => $positionAndPromotionTypes,
                'promotionUserList' => $promotionUserList,
                'supervisorData' => $supervisorData,
                'jobQualificationInformation' => $jobQualificationInformation,
                'documentCount' => $documentCount,
                'entryDocsCount'=> $entryDocsCount,
                'inServiceDocsCount'=> $inServiceDocsCount,
                'gradeList' => $gradeList,
                'managementUnitLIst' => $managementUnitLIst,
                'recentUpload' => $recentUpload
               
            ]);

        }else{

            return back()->with('error','Something went wrong, please try again');

        }


    }
}

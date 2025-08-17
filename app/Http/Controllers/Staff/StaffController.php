<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\AcademicQualification;
use App\Models\ContactInfromation;
use App\Models\ContactRelationship;
use App\Models\DocumentLibrary;
use App\Models\DocumentType;
use App\Models\EmergencyContact;
use App\Models\EmployeeCompensation;
use App\Models\Grade;
use App\Models\Institution;
use App\Models\JobQualificationInformation;
use App\Models\ManagementUnit;
use App\Models\NextOfKinInformation;
use App\Models\PersonnelMain;
use App\Models\PostionAndPromotion;
use App\Models\PostionAndPromotionType;
use App\Models\SupervisorInformation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function createPersonel (){

        $inistList = Institution::orderBy('name')->get();
        $gradesList = Grade::orderBy('name')->get();

        $lastRecord = PersonnelMain::get()->count() + 1;

        $serialNumber = date('Ymd').str_pad($lastRecord, '0', STR_PAD_LEFT);

        return view('staff.create-personel',[
            'gradesList' => $gradesList,
            'inistList' => $inistList,
            'serialNumber' => $serialNumber
        ]);
    }

    public function listFiles (){

        $listFiles = PersonnelMain::get();

        return view ('staff.list-files',[
            'listFiles' => $listFiles
        ]);
    }

    public function editFileView ($id){

        $decodeID = Crypt::decrypt($id);

        $data = PersonnelMain::find($decodeID);

        $inistList = Institution::orderBy('name')->get();
        $gradesList = Grade::orderBy('name')->get();


        return view ('staff.edit-file',[
            'data' => $data,
            'inistList' => $inistList,
            'gradesList' => $gradesList,
            'id' => $id
        ]);


    }

        public function updateFileProcess (Request $request,$id){

        $this->validate($request,[
            'full_name' => 'required',
            'rank' => 'required',
            'institution' => 'required',
            'gender' => 'required',
            'date_of_hire' => 'required'
        ]);

        $decodeID = Crypt::decrypt($id);

        $insertRecord = PersonnelMain::find($decodeID);
        $insertRecord->name = $request->full_name;
        $insertRecord->rank = $request->rank;
        $insertRecord->institution = $request->institution;
        $insertRecord->grader = $request->gender;
        $insertRecord->date_of_hire =$request->date_of_hire;
        $insertRecord->date_of_retirement = $request->date_of_retirement;
        $status = $insertRecord->update();

         return $status ? back()->with('success','File updated successfully') :back()->with('error','Something went wrong, please try again.');


       
    }



    public function createFileProcess (Request $request){

        $this->validate($request,[
            'full_name' => 'required',
            'rank' => 'required',
            'institution' => 'required',
            'gender' => 'required',
            'date_of_hire' => 'required'
        ]);


        $lastRecord = PersonnelMain::get()->count() + 1;

        $serialNumber = date('Ymd').str_pad($lastRecord, '0', STR_PAD_LEFT);

        $insertRecord = new PersonnelMain();
        $insertRecord->serial_number = $serialNumber;
        $insertRecord->file_number = $serialNumber;
        $insertRecord->name = $request->full_name;
        $insertRecord->rank = $request->rank;
        $insertRecord->institution = $request->institution;
        $insertRecord->grader = $request->gender;
        $insertRecord->date_of_hire =$request->date_of_hire;
        $insertRecord->date_of_retirement = $request->date_of_retirement;
        $status = $insertRecord->save();

         return $status ? back()->with('success','File created usccessfully') :back()->with('error','Something went wrong, please try again.');


       
    }

    public function searchForStaffView (){

        return view('staff.search-staff');
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


    public function staffBioData($userName){

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

           $contactRelationshipList = ContactRelationship::orderBy('name','ASC')->get();

           $positionAndPromotionTypes = PostionAndPromotionType::orderBy('id','ASC')->get();
           $gradeList = Grade::orderBy('name','ASC')->get();
           $promotionUserList = PostionAndPromotion::where('user_id',$userData[0]->id)->orderBy('type_id','ASC')->get();
           $supervisorData = SupervisorInformation::where('user_id',$userData[0]->id)->orderBy('id','DESC')->limit(1)->get();
           $hQualifiaction = AcademicQualification::get();
           $documentType = DocumentType::get();
           $jobQualificationInformation = JobQualificationInformation::where('user_id',$userData[0]->id)->orderBy('id','DESC')->limit(1)->get();
           $managementUnitLIst = ManagementUnit::get();
            return view('staff.staff-bio-data',[
                'data' => $entries,
                'userData' => $userData[0],
                'contactRelationshipList' => $contactRelationshipList,
                'positionAndPromotionTypes' => $positionAndPromotionTypes,
                'gradeList' => $gradeList,
                'promotionUserList' => $promotionUserList,
                'supervisorData' => $supervisorData,
                'hQualifiaction' => $hQualifiaction,
                'documentType' => $documentType,
                'jobQualificationInformation' => $jobQualificationInformation,
                'managementUnitLIst' => $managementUnitLIst
            ]);

        }else{

            return back()->with('error','Something went wrong, please try again');

        }



    }


    public function updateStaffBioDataOne (Request $request,$id){

        $decodeID = Crypt::decrypt($id);

        $this->validate($request,[
            'gender' => 'required',
            'date_of_birth' => 'required',
            'staff_id' => 'required',
            'marital_status' => 'required',
            'ghana_card_number' => 'required',
            'ssnit_number' => 'required',
            'ptitle'=> 'required',
            'current_grade' => 'required'
        ]);

        if(User::where('id',$decodeID)->get()->count() > 0){

            $updateInformation = User::find($decodeID);
            $updateInformation->name = $request->ptitle.' '.$request->surname.', '.$request->othernames.' '.$request->firstname;
            $updateInformation->gender = $request->gender;
            $updateInformation->staff_id = $request->staff_id;
            $updateInformation->ssnit_number = $request->ssnit_number;
            $updateInformation->ghana_card_number = $request->ghana_card_number;
            $updateInformation->dob = $request->date_of_birth;
            $updateInformation->marital = $request->marital_status;
            //$updateInformation->personal_email = $request->personal_email;


            $updateInformation->firstname = $request->firstname;
            $updateInformation->surname = $request->surname;
            $updateInformation->othernames = $request->othernames;
            $updateInformation->ptitle = $request->ptitle;
            $updateInformation->current_grade = $request->current_grade;


            $status = $updateInformation->update();

           

            return $status ? back()->with('success','Bio information updated successfully.') : back()->with('error','Something went wrong, please try again.');
            

        }else{

            return back()->with('error','Something went wrong, please try again.');


        }

       

    }

    public function updateContactInformation (Request $request,$id){

        $decodeID = Crypt::decrypt($id);

        $this->validate($request,[
            'phone_number' => 'required',
            'email' => 'required'
        ]);

        if(ContactInfromation::where('user_id',$decodeID)->get()->count() > 0){


            $insertData =  ContactInfromation::find($decodeID);
            $insertData->user_id = $decodeID;
            $insertData->phone_number = $request->phone_number;
            $insertData->emal = $request->email;
            if(isset($request->digital_address)){$insertData->digital_address = $request->digital_address;}
            if(isset($request->postal_address)){$insertData->postal_address = $request->postal_address;;}
            $status = $insertData->update();

            return $status ? back()->with('success','Bio information updated successfully.') : back()->with('error','Something went wrong, please try again.'); 


        }else{

            $insertData = new ContactInfromation();
            $insertData->user_id = $decodeID;
            $insertData->phone_number = $request->phone_number;
            $insertData->emal = $request->email;
            if(isset($request->digital_address)){$insertData->digital_address = $request->digital_address;}
            if(isset($request->postal_address)){$insertData->postal_address = $request->postal_address;;}
            $status = $insertData->save();

            return $status ? back()->with('success','Bio information save successfully.') : back()->with('error','Something went wrong, please try again.'); 
            
            
        }


    }

    public function updateEmergencyContact (Request $request,$id){

        $decodeID = Crypt::decrypt($id);

        $this->validate($request,[
            'relationship' => 'required',
            'person_name' => 'required'
        ]);

        if(EmergencyContact::where('user_id',$decodeID)->get()->count() > 0){


            $insertData =  EmergencyContact::find($decodeID);
            $insertData->name = $request->person_name;
            $insertData->relationship_id = $request->relationship;
            $insertData->phone_number = $request->phone_number;
            if(isset($request->email)){$insertData->emal = $request->email;}
            if(isset($request->digital_address)){$insertData->digital_address = $request->digital_address;}
            if(isset($request->postal_address)){$insertData->postal_address = $request->postal_address;}
            $status = $insertData->update();

            return $status ? back()->with('success','Bio information updated successfully.') : back()->with('error','Something went wrong, please try again.'); 


        }else{

            $insertData = new EmergencyContact();
            $insertData->user_id = $decodeID;
            $insertData->name = $request->person_name;
            $insertData->relationship_id = $request->relationship;
            $insertData->phone_number = $request->phone_number;
            if(isset($request->email)){$insertData->emal = $request->email;}
            if(isset($request->digital_address)){$insertData->digital_address = $request->digital_address;}
            if(isset($request->postal_address)){$insertData->postal_address = $request->postal_address;}
            $status = $insertData->save();

            return $status ? back()->with('success','Bio information save successfully.') : back()->with('error','Something went wrong, please try again.'); 
            
            
        }


    }


    public function updateNexkOfKin (Request $request,$id){


        $decodeID = Crypt::decrypt($id);


        $this->validate($request,[
            'relationship' => 'required',
            'person_name' => 'required'
        ]);

        if(NextOfKinInformation::where('user_id',$decodeID)->get()->count() > 0){


            $updatetData =  NextOfKinInformation::find($decodeID);
            $updatetData->name = $request->person_name;
            $updatetData->relationship_id = $request->relationship;
            $updatetData->phone_number = $request->phone_number;
            if(isset($request->email)){$updatetData->emal = $request->email;}
            if(isset($request->digital_address)){$updatetData->digital_address = $request->digital_address;}
            if(isset($request->postal_address)){$updatetData->postal_address = $request->postal_address;}
            $status = $updatetData->update();

            return $status ? back()->with('success','Bio information updated successfully.') : back()->with('error','Something went wrong, please try again.'); 


        }else{

            $insertData = new NextOfKinInformation();
            $insertData->user_id = $decodeID;
            $insertData->name = $request->person_name;
            $insertData->relationship_id = $request->relationship;
            $insertData->phone_number = $request->phone_number;
            if(isset($request->email)){$insertData->emal = $request->email;}
            if(isset($request->digital_address)){$insertData->digital_address = $request->digital_address;}
            if(isset($request->postal_address)){$insertData->postal_address = $request->postal_address;}
            $status = $insertData->save();

            return $status ? back()->with('success','Bio information save successfully.') : back()->with('error','Something went wrong, please try again.'); 
            
            
        }


    }


    public function getPromotionandPostionForms (Request $request){

        $table = '';

        $table .= '<table class="table table-bordered">';

        $table .= '<tbody>';

        $table .= '<tr>';

        $table .= '<td><input id="appointmentDate" name="appointmentDate" type="date" class="form-control"><span id="appointmentDateerror"></span></td>';

        $table .= '<td><input id="appointmentDate" name="appointmentDate" type="date" class="form-control"><span id="appointmentDateerror"></span></td>';

      

        $table .= '</tr>';

        $table .= '</tbody>';

        $table .= '</table>';


        return $table;




    }

    public function updatePromotionAndPositionProcess (Request $request,$id){

        $decodeID = Crypt::decrypt($id);

        if(PostionAndPromotion::where([['user_id',$decodeID],['type_id',$request->position_promotion]])->get()->count() > 0){

            $updateData = PostionAndPromotion::where([['user_id',$decodeID],['type_id',$request->position_promotion]])->get();
            $updateData[0]->type_id = $request->position_promotion;
            $updateData[0]->grade_id = $request->grade;
            $updateData[0]->date = $request->reference_date;
            $status = $updateData[0]->update();

            if($status){

                $data = PostionAndPromotion::where('user_id',$decodeID)->orderBy('type_id','ASC')->get();

                $table = '';


                $table .= '<table id="example1" class="table table-bordered"><thead><tr> <th>Date</th> <th>Type</th><th>Grade</th><th></th> </tr> </thead> <tbody>';

                foreach ($data as $promotionUserListItem) {

                    $table .= '<tr>';

                    $table .= '<td style="color: green;" align="center">'.date('jS F Y',strtotime($promotionUserListItem->date)).'</td>';

                    $table .= '<td>'.$promotionUserListItem->getTypeName().'</td>';

                    $table .= '<td>'.$promotionUserListItem->getGrade().'</td>';

                    $table .= '<td><a id="deletePromotionBtn" data-id="'.$promotionUserListItem->id.'"><i class="fa fa-trash" style="color:red;"></i></a></td>';

                    $table .= '</tr>';
                    

                }

                $table .= ' </tbody></table>';


            }else{

                return 'error';


            }
           

            
        }else{

            $insertData = new PostionAndPromotion();
            $insertData->user_id = $decodeID;
            $insertData->type_id = $request->position_promotion;
            $insertData->grade_id = $request->grade;
            $insertData->date = $request->reference_date;
            $status = $insertData->save();


            if($status){

                $data = PostionAndPromotion::where('user_id',$decodeID)->orderBy('type_id','ASC')->get();

                $table = '';


                $table .= '<table id="example1" class="table display nowrap"><thead><tr> <th>Date</th> <th>Type</th><th>Grade</th><th></th> </tr> </thead> <tbody>';

                foreach ($data as $promotionUserListItem) {

                    $table .= '<tr>';

                    $table .= '<td style="color: green;" align="center">'.date('jS F Y',strtotime($promotionUserListItem->date)).'</td>';

                    $table .= '<td>'.$promotionUserListItem->getTypeName().'</td>';

                    $table .= '<td>'.$promotionUserListItem->getGrade().'</td>';

                    $table .= '<td><a id="postingModalUpdate" data-bs-toggle="modal" data-bs-target="#addDrugs" data-id="'.$promotionUserListItem->id.'"><i class="fa fa-edit" style="color:red;"></i></a></td>';

                    $table .= '</tr>';
                    
                }

                $table .= '</tbody></table>';

                return $table;


            }else{

                return 'error';


            }



        }


    }


    public function deletePromotionPosition (Request $request){

        $getData = PostionAndPromotion::find($request->deleteID);

        $userID = $getData->user_id;

        $status = PostionAndPromotion::find($request->deleteID)->delete();


        if($status){

            $data = PostionAndPromotion::where('user_id',$userID)->orderBy('type_id','ASC')->get();

            $table = '';


            $table .= '<table id="example1" class="table table-bordered"><thead><tr> <th>Date</th> <th>Type</th><th>Grade</th><th></th> </tr> </thead> <tbody>';

            foreach ($data as $promotionUserListItem) {

                $table .= '<tr>';

                $table .= '<td style="color: green;" align="center">'.date('jS F Y',strtotime($promotionUserListItem->date)).'</td>';

                $table .= '<td>'.$promotionUserListItem->getTypeName().'</td>';

                $table .= '<td>'.$promotionUserListItem->getGrade().'</td>';

                $table .= '<td><a id="deletePromotionBtn" data-id="'.$promotionUserListItem->id.'" ><i class="fa fa-trash" style="color:red;"></i></a></td>';

                $table .= '</tr>';
                
            }

            $table .= '</tbody></table>';

            return $table;


        }else{

            return 'error';


        }

    }


    public function updateSupervisorInformation (Request $request,$id){

        $decodeID = Crypt::decrypt($id);

        $insertSupervisor = new SupervisorInformation();
        $insertSupervisor->user_id = $decodeID;
        $insertSupervisor->name = $request->supervisors_name;
        $insertSupervisor->grade_id = $request->supervisors_grade;
        $insertSupervisor->staff_id = $request->supervisors_staff_id;
        $status = $insertSupervisor->save();

        if($status){

        $design = '';

        $supervisorData = SupervisorInformation::where('user_id',$decodeID)->orderBy('id','DESC')->limit(1)->get();

        // $design .= '<link rel="stylesheet" href="'.asset('assets/main/css/style.css').'">';

        // $design .= '<div class="d-flex justify-content-between doctor-info-details">';
        // $design .= '<div class="d-flex left-content">';
        // $design .= '<div class="media align-self-start">';
        // $design .= '<img alt="image" class="rounded-circle shadow" width="90" src="'.asset('assets/images/client.jpg').'" ';
        // $design .= '<div class="pulse-css"></div>';
        // $design .= '</div>';
        // $design .= '<div class="media-body">';
        // $design .= '<h2 class="mb-2">'.$supervisorData[0]->name.'</h2>';
        // $design .= '<p class="mb-md-2 mb-sm-4 mb-2">'.$supervisorData[0]->getGrade().'</p>';
        // $design .= '<p class="mb-md-2 mb-sm-4 mb-2">'.$supervisorData[0]->staff_id.'</p>';
        // $design .= '</div>';
        // $design .= '</div>';
        // $design .= '</div>';

        
        $design .= '<div class="row">';
        $design .= '<div class="col-md-4">';
        $design .= '<div class="media align-self-start">';
        $design .= '<img alt="image" class="rounded-circle shadow" width="90" src="'.asset('assets/images/profile_avater.png').'" ';
        $design .= '<div class="pulse-css"></div>';
        $design .= '</div>';
        $design .= '<div class="<div class="col-md-4">';
        $design .= '<h2 class="mb-2">'.$supervisorData[0]->name.'</h2>';
        $design .= '<p class="mb-md-2 mb-sm-4 mb-2">'.$supervisorData[0]->getGrade().'</p>';
        $design .= '<p class="mb-md-2 mb-sm-4 mb-2">'.$supervisorData[0]->staff_id.'</p>';
        $design .= '</div>';
        $design .= '</div>';
        $design .= '</div>';

        return $design;



        }else{

            return "error";
        }


    }

    public function updateJobAndQualificationInfoProcess (Request $request,$id){

        $table = '';

        $decodeID = Crypt::decrypt($id);

        $userData = User::find($decodeID);

        $userDocumentPath = public_path($userData->username.'/');

            if(!File::isDirectory($userDocumentPath)){

                File::makeDirectory($userDocumentPath,077,true,true);

            }
        
       if($request->has('academic_document')){

           $docOnePath = $userData->username.'/'.time().rand(1,1000).'.'.$request->file('academic_document')->extension();

           $request->file('academic_document')->move(public_path($userData->username),$docOnePath);

           $insertDocumentsOne = new DocumentLibrary();
           $insertDocumentsOne->user_id = $decodeID;
           $insertDocumentsOne->document_type_id = $request->document_type;
           $insertDocumentsOne->document_path = $docOnePath;
           $insertDocumentsOne->created_by = auth()->user()->id;
           if($request->document_type == 1){
            $insertDocumentsOne->document_classification_id = 2;
           }else{
            $insertDocumentsOne->document_classification_id = 26;
           }
           $insertDocumentsOne->description = 'Highest Academic Qualification';
           $insertDocumentsOne->save();

       }

       if($request->has('professional_document')){

        $docTwoPath = $userData->username.'/'.time().rand(1,1000).'.'.$request->file('professional_document')->extension();

        $request->file('professional_document')->move(public_path($userData->username),$docTwoPath);

        $insertDocumentsTwo = new DocumentLibrary();
        $insertDocumentsTwo->user_id = $decodeID;
        $insertDocumentsTwo->document_type_id = $request->document_type_professional;
        $insertDocumentsTwo->document_path = $docTwoPath;
        $insertDocumentsTwo->created_by = auth()->user()->id;
        if($request->document_type_professional == 1){
         $insertDocumentsTwo->document_classification_id = 2;
        }else{
         $insertDocumentsTwo->document_classification_id = 26;
        }
        $insertDocumentsTwo->description = 'Professional Qualification';
        $insertDocumentsTwo->save();
        
    }

    JobQualificationInformation::where('user_id',$decodeID)->delete();

    $insertData = new JobQualificationInformation();
    $insertData->user_id = $decodeID;
    $insertData->highest_academic_id = $request->highest_academic_qualification;
    $insertData->profeesional_qualification = trim($request->professional_qualification);
    $insertData->highest_academic_doc_id = $insertDocumentsOne->id;
    if($request->has('professional_document')){$insertData->profeesional_qualification_doc_id = $insertDocumentsTwo->id;}
    $insertData->cadre = $request->job_cadre;
    $insertData->category = $request->job_category;
    $insertData->number_of_year = $request->number_of_years;
    $finalStatus = $insertData->save();

    if($finalStatus){

    $jobQualificationInformation = JobQualificationInformation::where('user_id',$decodeID)->orderBy('id','DESC')->limit(1)->get();

    $table .= '<table id="table" class="table table-bordered">';
    $table .= '<thead><tr> <th>Highest Academic Qualification</th> <th>Document</th> <th>Professional Qualification</th><th>Document</th><th>Job Cadre</th><th>Job Category</th><th>No. of Year at Ministry</th></tr></thead>';
    $table .= '<tbody>';
    foreach ($jobQualificationInformation as $jobQualificationInformationItem) {
       $table .= '<tr>';
       $table .= '<td>'.$jobQualificationInformationItem->getHighestEducation().'</td>';

       if ($jobQualificationInformationItem->getDocumentPath() != "not avaliable") {
        $table .= '<td align="center"><a target="_blank" href="'.asset($jobQualificationInformationItem->getDocumentPath()).'"><i class="fa fa-file" style="color: red;"></i></a></td>';
       } else {
       $table .= '<td align="center">Not Avaliabale</td>';
       }

       if (!empty($jobQualificationInformationItem->profeesional_qualification)) {
        $table .= '<td align="center">'.$jobQualificationInformationItem->profeesional_qualification.'</td>';
       } else {
       $table .= '<td align="center">Not Avaliabale</td>';
       }

       if ($jobQualificationInformationItem->getProfessionalDocumentPath() != "not avaliable") {
        $table .= '<td align="center"><a target="_blank" href="'.asset($jobQualificationInformationItem->getProfessionalDocumentPath()).'"><i class="fa fa-file" style="color: red;"></i></a></td>';
       } else {
       $table .= '<td align="center">Not Avaliabale</td>';
       }

       $table .= '<td align="center">'.$jobQualificationInformationItem->cadre.'</td>';
       $table .= '<td align="center">'.$jobQualificationInformationItem->category.'</td>';
       $table .= '<td align="center">'.$jobQualificationInformationItem->number_of_year.'</td>';
       $table .= '</tr>';
    }
    $table .= '</tbody>';
    $table .= '</table>';

    return $table;

    }else{

        return "error";
    }


        
    }


    public function addEmployeeCompensationProcess(Request $request,$id){

        $decodeID = Crypt::decrypt($id);

        if(EmployeeCompensation::where('user_id',$decodeID)->get()->count() > 0){

            $updateData = EmployeeCompensation::where('user_id',$decodeID)->get();
            $updateData[0]->current_grade = $request->current_grade;
            $updateData[0]->salary_level = $request->salary_level;
            $updateData[0]->salary_point = $request->salary_point;
            $updateData[0]->management_unit = $request->management_unit;
            $status = $updateData[0]->update();

            return $status ? back()->with('success','Bio information updated successfully.') : back()->with('error','Something went wrong, please try again.');


        }else{

            $insertData = new EmployeeCompensation();
            $insertData->user_id = $decodeID;
            $insertData->current_grade = $request->current_grade;
            $insertData->salary_level = $request->salary_level;
            $insertData->salary_point = $request->salary_point;
            $insertData->management_unit = $request->management_unit;
            $status = $insertData->save();

            return $status ? back()->with('success','Bio information saved successfully.') : back()->with('error','Something went wrong, please try again.');


            
        }


    }


    public function getPostingPositionData (Request $request){

        if(PostionAndPromotion::where('id',$request->postingUpdateID)->get()->count() > 0){

            $data = PostionAndPromotion::find($request->postingUpdateID);

            return response()->json(array('message' => 'success','data' => $data));


        }else{

            return response()->json(array('message' => 'success'));
        }
    }

    public function updatePositionAndPromotion (Request $request,$id){

        $decodeID = Crypt::decrypt($id);


        $updateData = PostionAndPromotion::where([['id',$request->postingUpdateID]])->get();
        $updateData[0]->type_id = $request->modal_position_promotion;
        $updateData[0]->grade_id = $request->modal_grade;
        $updateData[0]->date = $request->modal_reference_date;
        $status = $updateData[0]->update();

        if($status){

            $data = PostionAndPromotion::where('user_id',$decodeID)->orderBy('type_id','ASC')->get();

            $table = '';


            $table .= '<table id="example1" class="table table-bordered"><thead><tr> <th>Date</th> <th>Type</th><th>Grade</th><th></th> </tr> </thead> <tbody>';

            foreach ($data as $promotionUserListItem) {

                $table .= '<tr>';

                $table .= '<td style="color: green;" align="center">'.date('jS F Y',strtotime($promotionUserListItem->date)).'</td>';

                $table .= '<td>'.$promotionUserListItem->getTypeName().'</td>';

                $table .= '<td>'.$promotionUserListItem->getGrade().'</td>';

                $table .= '<td><a id="postingModalUpdate" data-bs-toggle="modal" data-bs-target="#addDrugs" data-id="'.$promotionUserListItem->id.'"><i class="fa fa-edit" style="color:red;"></i></a></td>';

                $table .= '</tr>';
                

            }

            $table .= ' </tbody></table>';

            return $table;

        }else{

            return "error";
        }


    }


    public function viewStaffBioInformation ($userID){

        $decodeData = Crypt::decrypt($userID);


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

            $documentCount = DocumentLibrary::where([['user_id',$userData[0]->id],['status','Active']])->get()->count();
            $entryDocsCount = DocumentLibrary::where([['user_id',$userData[0]->id],['document_type_id',1],['status','Active']])->get()->count();
            $inServiceDocsCount = DocumentLibrary::where([['user_id',$userData[0]->id],['document_type_id',2],['status','Active']])->get()->count();
            $gradeList = Grade::orderBy('name','ASC')->get();
            $managementUnitLIst = ManagementUnit::get();
            $recentUpload = DocumentLibrary::where([['user_id',$userData[0]->id],['status','Active']])->orderBy('id','DESC')->get();
        

            return view('staff.staff-profile-bio',[
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

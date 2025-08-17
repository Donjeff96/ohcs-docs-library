<?php

namespace App\Http\Controllers;

use App\Models\CurrentLeave;
use App\Models\Division;
use App\Models\DocumentLibrary;
use App\Models\Grade;
use App\Models\GroupHeadRequest;
use App\Models\HolidayList;
use App\Models\JobQualificationInformation;
use App\Models\LeaveMain;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Spatie\FlareClient\View;

class DashBoardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index (){

        

        if(auth()->user()->user_cat == 1 || auth()->user()->user_cat == 5 || auth()->user()->user_cat == 6){

            $divisionArr = array();
            $divisionCountArr = array();

            $documentCount = DocumentLibrary::where('status','Active')->get()->count();
            $femaleCount = 0;
            $maleCount = 0;
            $totalStaff = User::get()->count();
            $divisionList = Division::orderBy('name','ASC')->get();
            $job_qualification_informationtype = new JobQualificationInformation();
            $gradeList = Grade::orderBy('name','ASC')->get();

            $pendingDocumentation = DocumentLibrary::where('status','Pending')->select('user_id')->limit(10)->groupBy('user_id')->orderBy('id','ASC')->get();

            
            foreach ($divisionList as $key) {

                array_push($divisionArr,$key->name.' ('.$key->staffCount().')');
 
                array_push($divisionCountArr,$key->staffCount());
                
            }




            return view('admin-dashboard',[
                'documentCount' => $documentCount,
                'femaleCount' => $femaleCount,
                'maleCount' => $maleCount,
                'totalStaff' => $totalStaff,
                'divisionList' => $divisionList,
                'divisionArr' => json_encode($divisionArr),
                'divisionCountArr' => json_encode($divisionCountArr),
                'job_qualification_informationtype' => $job_qualification_informationtype,
                'gradeList' => $gradeList,
                'pendingDocumentation' => $pendingDocumentation
            ]);

           



        }elseif(auth()->user()->user_cat == 3){

            $entriesCount = 0;

            $entries = array();

            $divisionData = Division::find(auth()->user()->division_id);

            $ldap_con = ldap_connect(env('LDAP_IP'));

            $ldap_dn = env('LDAP_DN');
            $ldap_password = env('LDAP_PASSWORD');
    
            $ldap_base   = env('LDAP_SEARCH_BASE_PATH'); 

            if (!$ldap_con) {

                $entriesCount = 0;
            }else{

            ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ldap_con, LDAP_OPT_REFERRALS, 0);

            if (!ldap_bind($ldap_con,$ldap_dn,$ldap_password)) {

                $entriesCount = 0;
            }else{

                $filter = "(&(objectClass=user))"; 


                $result = ldap_search($ldap_con, 'OU='.trim($divisionData->initials).''.$ldap_base, $filter);


                if ($result) {
                  

                    $entries = ldap_get_entries($ldap_con, $result);

                    $entriesCount = $entries['count'];

                    shuffle($entries);

                }


            }


            }

            $femaleCount = User::where([['gender','Female'],['division_id',auth()->user()->division_id]])->get()->count();
            $maleCount = User::where([['gender','Male'],['division_id',auth()->user()->division_id]])->get()->count();
            $totalStaff = User::where('division_id',auth()->user()->division_id)->get()->count();
            $documentCount = DocumentLibrary::where([['user_id',auth()->user()->id],['status','Active']])->get()->count();
            $recentUpload = DocumentLibrary::where([['user_id',auth()->user()->id],['status','Active']])->limit(10)->orderBy('id','DESC')->get();

            return view('dir-dashboard',[
                'femaleCount' => $femaleCount,
                'maleCount' => $maleCount,
                'totalStaff' => $totalStaff,
                'documentCount' => $documentCount,
                'recentUpload' => $recentUpload,
                'count' =>$entriesCount,
                'data' => $entries
            ]);

           

        }else{

            $documentCount = DocumentLibrary::where([['user_id',auth()->user()->id],['status','Active']])->get()->count();
            $entryDocsCount = DocumentLibrary::where([['user_id',auth()->user()->id],['document_type_id',1],['status','active']])->get()->count();
            $inServiceDocsCount = DocumentLibrary::where([['user_id',auth()->user()->id],['document_type_id',2],['status','active']])->get()->count();
    
            $recentUpload = DocumentLibrary::where([['user_id',auth()->user()->id],['status','Active']])->limit(10)->orderBy('id','DESC')->get();
    
            if(auth()->user()->gender == null  || auth()->user()->division_id == null){
    
                return redirect()->route('update-user-information');
            }
    
        
            return view('dashboard',[
                'documentCount' => $documentCount,
                'entryDocsCount' => $entryDocsCount,
                'inServiceDocsCount' => $inServiceDocsCount,
                'recentUpload' => $recentUpload
            ]);

            
        }




    }

    public function logoutUser (){
        
        auth()->logout();

        return redirect('/');
        
    }

    public function listDashboardStaffs ($parameter){

        

        $arr = [];

        if($parameter == "all-staff"){

            $arr = User::get();


        }elseif($parameter == "Male"){

            $arr = User::where('gender','Male')->get();

        }elseif($parameter == "Female"){

            $arr = User::where('gender','Female')->get();

        }elseif($parameter == "Senior"){

            $arr = User::join('job_qualification_information','users.id','=','job_qualification_information.user_id')->where('job_qualification_information.category','Senior')->get();

        }elseif($parameter == "Sub Professional"){

            $arr = User::join('job_qualification_information','users.id','=','job_qualification_information.user_id')->where('job_qualification_information.cadre','Sub Professional')->get();

        }elseif($parameter == "Professional"){

            $arr = User::join('job_qualification_information','users.id','=','job_qualification_information.user_id')->where('job_qualification_information.cadre','Professional')->get();

        }else{

            $decodeID = Crypt::decrypt($parameter);

            $arr = User::where('division_id',$decodeID)->get();


        }

        return view ('dashboard.list-staff',[
            'data' => $arr
        ]);
    }

    
 
}

<?php

namespace App\Http\Controllers\DivisionalUnit;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionalUnitController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){

        $getUnits = Division::orderBy('name','ASC')->get();

        return view('division.list-staff',[
            'getUnits' => $getUnits
        ]);

    }

    public function fetchDivisionalStaffs (Request $request){

        $this->validate($request,[
            'division' => 'required'
        ]);

        $ldap_con = ldap_connect(env('LDAP_IP'));

        $ldap_dn = env('LDAP_DN');
        $ldap_password = env('LDAP_PASSWORD');

        $ldap_base   = env('LDAP_SEARCH_BASE_PATH'); 


        if (!$ldap_con) {

            return back()->with('error','Something went wrong, please try again');
        }

        ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap_con, LDAP_OPT_REFERRALS, 0);


        if (!ldap_bind($ldap_con,$ldap_dn,$ldap_password)) {

            return back()->with('error','Something went wrong, please try again');
        }

        $filter = "(&(objectClass=user))"; 


        

        $result = ldap_search($ldap_con, 'OU='.trim($request->division).''.$ldap_base, $filter);

        if ($result) {
            $entries = ldap_get_entries($ldap_con, $result);
            

          

            return back()->with(['data'=> $entries,'count' =>$entries['count'],'division' =>$request->division]);
    
    
            } else {

                return back()->with('error','Something went wrong, please try again');
            }


            ldap_unbind($ldap_conn);

    }

    public function myDivisionView (){

        $divisionData = Division::find(auth()->user()->division_id);

        $ldap_con = ldap_connect(env('LDAP_IP'));

        $ldap_dn = env('LDAP_DN');
        $ldap_password = env('LDAP_PASSWORD');

        $ldap_base   = env('LDAP_SEARCH_BASE_PATH'); 


        if (!$ldap_con) {

            return back()->with('error','Something went wrong, please try again');
        }

        ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap_con, LDAP_OPT_REFERRALS, 0);


        if (!ldap_bind($ldap_con,$ldap_dn,$ldap_password)) {

            return back()->with('error','Something went wrong, please try again');
        }

        $filter = "(&(objectClass=user))"; 


        $result = ldap_search($ldap_con, 'OU='.trim($divisionData->initials).''.$ldap_base, $filter);

        if ($result) {
            $entries = ldap_get_entries($ldap_con, $result);
         

            return view ('division.my-staff',[
                'data' => $entries,
                'count' =>$entries['count']
            ]);

        }else{

            return view ('division.my-staff',[
                'entries' => []
            ]);

        }



       
    }

}

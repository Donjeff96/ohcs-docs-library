<?php

namespace App\Http\Controllers\Authenticate;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index(){

        return view ('auth.login');
    }


    public function authenticateUserProcessOLd (Request $request){

        $ldap_con = ldap_connect(env('LDAP_IP'));

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);


        $username = substr($request->username, 0, strpos($request->username, "@"));

        if(empty($username)){ $username = $request->username; }


        $ldap_dn = env('LDAP_DN');
        $ldap_password = env('LDAP_PASSWORD');

        ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);
        
        if(@ldap_bind($ldap_con,$ldap_dn,$ldap_password)){

            $filter = "(userprincipalname=".$username."@mofep.gov.gh)";
            $result = @ldap_search($ldap_con,env('LDAP_BASE_PATH'), $filter) or exit("Unable");
            $entries = @ldap_get_entries($ldap_con, $result);

                if (@ldap_bind($ldap_con, $entries[0]['dn'], trim($request->password))) {

                    if(key_exists('mail',$entries[0])){

                        $emailAddress = $entries[0]['mail'][0];
                        
                    }else{

                        $emailAddress = $entries[0]['samaccountname'][0].'@mofep.gov.gh';
                    }

                    
                    if(User::where('email',$emailAddress)->get()->count() > 0){
    
                        $user = User::where('email', '=', $emailAddress)->first();
    
                        if ($user != null)
                        {
                            
                            $explodeDn = explode(',',$entries[0]['dn']);
    
                            $exploadCat = explode('=',$explodeDn[1]);
    
                            $updateDetails = User::find($user->id);
                            if(key_exists('title',$entries[0])){$updateDetails->title = $entries[0]['title'][0];}
                           // $updateDetails->name =  $entries[0]['displayname'][0];
                            $updateDetails->category =  $exploadCat[1];
                            $updateDetails->dc =  $entries[0]['dn'];
                            if(key_exists('thumbnailphoto',$entries[0])){$updateDetails->photoUrl =  base64_encode($entries[0]['thumbnailphoto'][0]);}
                            $updateDetails->update();

                          //  User::find($user->id)->updateUserDivision();

                            Auth::loginUsingId($user->id);

                            $user->insertUserLogs($request->ip());

                            if(auth()->user()->gender == null  || auth()->user()->division_id == null){

                            

                                return redirect()->route('update-user-information');
    
                                

                            }else{
    
                                return redirect()->route('dashboard');
    
                            }
    
                           
                        }
    
                    }else{
    
                        $explodeDn = explode(',',$entries[0]['dn']);
    
                        $exploadCat = explode('=',$explodeDn[1]);
    
                        $insertUser = new User();
                        $insertUser->name =  $entries[0]['displayname'][0];
                        $insertUser->email = $emailAddress;
                        if(key_exists('title',$entries[0])){$insertUser->title = $entries[0]['title'][0];}
                        $insertUser->firstname =  $entries[0]['givenname'][0];
                        $insertUser->surname =  $entries[0]['sn'][0];
                        $insertUser->username =  $entries[0]['samaccountname'][0];
                        $insertUser->dc =  $entries[0]['dn'];

                        if(key_exists('thumbnailphoto',$entries[0])){$insertUser->photoUrl =  base64_encode($entries[0]['thumbnailphoto'][0]);}

                        
                        $insertUser->category =  $exploadCat[1];
                        $insertUser->password =  'No_PASSWORD';
    
                        $status = $insertUser->save();
    
                        if($status){

                           // User::find($insertUser->id)->updateUserDivision();
    
                            Auth::loginUsingId($insertUser->id);

                            User::find($insertUser->id)->insertUserLogs($request->ip());

                            if(auth()->user()->gender == null  || auth()->user()->division_id == null){
    
                                return redirect()->route('update-user-information');
    
                            }else{
    
                                return redirect()->route('dashboard');
    
                            }
    
                        }
                    }
                    
                    
                }else{
                    
    
                    return back()->with('error','User Authentication Failed');
                }

        }else{

            return back()->with('error','Something went wrong, please try again');

        }

       

    }

    public function authenticateUserProcess (Request $request){

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);


        if(!auth()->attempt($request->only('email','password'))){

        return back()->with('error','Something went wrong, please try again.');

        }else{

        $status = auth()->user()->status;

        if($status == "Active"){

            return redirect('dashboard');

        }else{

            auth()->logout();
            
            return back()->with('error_two','Your Account Is Disabled. Please Contact Administrator Or Check Your Email To Activate Account. Thank You');


        }



        
        }



       

    }

}

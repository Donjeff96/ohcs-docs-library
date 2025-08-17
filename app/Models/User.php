<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function userCategory (){

        return UserCategory::find($this->user_cat)->name;
    }

     public function userGrade (){

        if(Grade::where('id',$this->category)->get()->count() > 0){

            return Grade::find($this->category)->name;
            
        }else{
            return 'No Avaliable';
        }

        
    }

    public function getUserDetails (){

        $ldap_con = ldap_connect(env('LDAP_IP'));

        $ldap_dn = env('LDAP_DN');
        $ldap_password = env('LDAP_PASSWORD');

        ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);

        if(@ldap_bind($ldap_con,$ldap_dn,$ldap_password)){

            $filter = "(userprincipalname=".auth()->user()->email.")";
            $result = @ldap_search($ldap_con,env('LDAP_BASE_PATH'), $filter) or exit("Unable");
            $entries = @ldap_get_entries($ldap_con, $result);

            return $entries;
            
        }
    }


    public function updateUserDivision (){

        $dc = explode(',',auth()->user()->dc);

        foreach ($dc as $key) {

            $value = explode('=',$key)[1];

            if(Division::where('initials',$value)->get()->count() > 0){

                $data = Division::where('initials',$value)->get();

                $updateUserInfo = User::find(auth()->user()->id);
                $updateUserInfo->division_id = $data[0]->id;
                $updateUserInfo->update();

            }

        }


    }

    public function getUsrDivision ($dc){

        $explodeDn = explode(',',$dc);
    
        $exploadCat = explode('=',$explodeDn[1]);

        return $exploadCat[1];

    }

    public function getContactInformation(){

        if(ContactInfromation::where('user_id',$this->id)->get()->count() > 0){

            return ContactInfromation::where('user_id',$this->id)->get();

        }else{
             return [];
        }


    }

    public function getEmergencyInformation(){

        if(EmergencyContact::where('user_id',$this->id)->get()->count() > 0){

            return EmergencyContact::where('user_id',$this->id)->get();

        }else{
             return [];
        }


    }


    public function getnextOfKingInformation(){

        if(NextOfKinInformation::where('user_id',$this->id)->get()->count() > 0){

            return NextOfKinInformation::where('user_id',$this->id)->get();

        }else{
             return [];
        }


    }

    public function getEmployeeCompensation(){

        if(EmployeeCompensation::where('user_id',$this->id)->get()->count() > 0){

            return EmployeeCompensation::where('user_id',$this->id)->get();

        }else{
             return [];
        }


    }


    public function age($date)

    {

        return Carbon::parse($date)->age;

    }

    public function pendingDocumentationCount (){

        return DocumentLibrary::where([['user_id',$this->id],['status','Pending']])->get()->count();
    }

    public function approvedDocumentationCount (){

        return DocumentLibrary::where([['user_id',$this->id],['status','Active']])->get()->count();
    }

    public function insertUserLogs ($id){

        $insertLog = new UserLog();

        $insertLog->userID = Auth::User()->id;
        $insertLog->ipAddress = $id;
        $insertLog->save();
    }
}

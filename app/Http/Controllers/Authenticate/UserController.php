<?php

namespace App\Http\Controllers\Authenticate;

use App\Http\Controllers\Controller;
use App\Models\ContactRelationship;
use App\Models\Division;
use App\Models\Grade;
use App\Models\TierList;
use App\Models\User;
use App\Models\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }


    public function index (){

        $divisionalList = Division::orderBy('name')->get();

        $userData = User::find(auth()->user()->id);

        $contactRelationshipList = ContactRelationship::orderBy('name','ASC')->get();

        return view('user.update-profile-information',[
            'divisionalList' => $divisionalList,
            'userData' => $userData,
            'contactRelationshipList' => $contactRelationshipList
        ]);
        
    }

    public function updateUserInformation (Request $request){

        $this->validate($request,[
            'gender' => 'required',
            'division' => 'required|integer',
        ]);


        $updateInformation = User::find(auth()->user()->id);

        $updateInformation->gender = $request->gender;
        // $updateInformation->gradeLevel = $request->grade_level;
        $updateInformation->division_id = $request->division;
        $status = $updateInformation->update();

        return $status ? back()->with('success','User Information Updated Successfully') :back()->with('error','Something went wrong, please try again.');

    }

    public function createAccount (){

        $userCategory = UserCategory::orderBy('name')->get();
        $gradesList = Grade::orderBy('name')->get();

        return view('user.create-user',[
            'userCategory' => $userCategory,
            'gradesList' => $gradesList
        ]);
    }


     public function createUserAccountProcess (Request $request){

          $imageUrl ="";


        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'user_category' => 'required',
            'user_grade' => 'required',
            'password' => 'required|confirmed|min:8'
        ]);


        if(User::where('email',$request->email)->get()->count() > 0){

            return back()->with('message_error','User already exists');

        }else{

             if($request->has('file')){

                $imageUrl = 'profile_image/'.trim($request->email).'-image-'.time().rand(1,1000).'.'.$request->file('file')->extension();
                $request->file('file')->move(public_path('profile_image'),$imageUrl);
    
            }

            $insertUser = new User();
            $insertUser->name = $request->full_name;
            $insertUser->email = $request->email;
            $insertUser->username = $request->email;
            $insertUser->password = Hash::make($request->password);
            $insertUser->user_cat = $request->user_category;
            $insertUser->photoUrl = $imageUrl;
            $insertUser->category = $request->user_grade;
            $status = $insertUser->save();


            return $status ? back()->with('success','Account Created Successfully') : back()->with('error','Something went wrong, please try again.');


        }


    }

}

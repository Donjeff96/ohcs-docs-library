<?php

namespace App\Http\Controllers\UserCategory;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Grade;
use App\Models\User;
use App\Models\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){

        $listCat = UserCategory::latest()->get();

        return view('user.category',[
            'listCat' =>  $listCat
        ]);
    }

    public function store(Request $request){

        $this->validate($request,[

            'category_name' => 'required'
        ]);

      if (UserCategory::where('name',$request->only('category_name'))->count() > 0) {

        return back()->with('error_exist','Category Already Exist');
         
      }

      $insertCat = new UserCategory();
      $insertCat->name = $request->category_name;
      $insertCat->description = $request->description;
      $insertCat->status = $request->status;

      $status = $insertCat->save();

      return $status ? back()->with('success','User Category Created Successfully') :back()->with('error','Something went wrong, please try again') ;


    }


    public function editUserCategoryView ($id){

        

        $decodeID = Crypt::decrypt($id);

        $categoryData = UserCategory::find($decodeID);

        return view('user.edit-category',[
            'id' =>  $id,
            'categoryData' => $categoryData
        ]);



    }

    public function updateCategory(Request $request,$id){

        $decodeID = Crypt::decrypt($id);

        $this->validate($request,[

            'category_name' => 'required'
        ]);

        $insertCat =  UserCategory::find($decodeID);
        $insertCat->name = $request->category_name;
        $insertCat->description = $request->description;
        $insertCat->status = $request->status;
  
        $status = $insertCat->update();
  
        return $status ? back()->with('success','User Category Updated Successfully') :back()->with('error','Something went wrong, please try again.') ;

    }


    public function listStaffs (){

        $listStaff = User::get();
        

        return view('user.user_list_search',[
            'listStaff' => $listStaff
        ]);

    }


    public function editUserCategoryPriv ($id){

        $decodeID = Crypt::decrypt($id);

        $userData = User::find($decodeID);

        $getUnits = User::distinct()->get(['category']);

        $userCategory = UserCategory::orderBy('name')->get();
        $getDivision = Grade::orderBy('name')->get();

        return view('user.reassign_user_category',[
            'id' => $id,
            'userData' => $userData,
            'getUnits' => $getUnits,
            'userCategory' => $userCategory,
            'getDivision' => $getDivision
        ]);


    }

    public function setUnit (Request $request,$id){

        

        $this->validate($request,[
            'password' => 'required|confirmed|min:8'
        ]);

        $decodeID = Crypt::decrypt($id);

        $updateInformation = User::find($decodeID);

        $updateInformation->password = Hash::make($request->password);
        $status = $updateInformation->update();

        return $status ? back()->with('success','User Password Updated Successfully') :back()->with('error','Something went wrong, please try again.');


    }

    public function editUserCategoryPrivProcess (Request $request,$id){


        $this->validate($request,[
            'grade' => 'required',
            'category' => 'required'
        ]);

        $decodeID = Crypt::decrypt($id);

        $updateInformation = User::find($decodeID);

        $updateInformation->category = $request->grade;
        $updateInformation->user_cat = $request->category;
        $status = $updateInformation->update();

        return $status ? back()->with('success','User Information Updated Successfully') :back()->with('error','Something went wrong, please try again.');


    }

    


}

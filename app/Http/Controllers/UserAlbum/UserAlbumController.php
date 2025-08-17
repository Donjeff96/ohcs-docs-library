<?php

namespace App\Http\Controllers\UserAlbum;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\User;
use Illuminate\Http\Request;

class UserAlbumController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){

        $getDivision = Division::get();
        

        return view('staffAlbum.list-staffs',[
            'getDivision' => $getDivision
        ]);
    }

    public function listStaffProcess(Request $request){

        $request->validate([
            'division' => 'required'
        ]);

        if(User::where('division_id' ,$request->division)->get()->count() > 0){

            $getStaffList = User::where('division_id' ,$request->division)->get();

            return back()->with(['userList'=> $getStaffList,'division' => $request->division]);

        }else{

            return back()->with(['userList' => 'empty','division' => $request->division]);

        }

    }
}

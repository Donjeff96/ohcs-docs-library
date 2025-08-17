<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\DocumentLibrary;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function generalReportView (){

            $documentCount = DocumentLibrary::where('status','Active')->get()->count();
            $femaleCount = User::where('gender','Female')->get()->count();
            $maleCount = User::where('gender','Male')->get()->count();
            $totalStaff = User::get()->count();

            $gradeList = Grade::orderBy('id','ASC')->get();
            $divisionList = Division::orderBy('name','ASC')->get();

        return view ('reports.general-report',[
            'documentCount' => $documentCount,
            'femaleCount' => $femaleCount,
            'maleCount' => $maleCount,
            'totalStaff' => $totalStaff,
            'gradeList' => $gradeList,
            'divisionList' => $divisionList
    
        ]);
    }

    public function generalReportListStaffView ($id){

        $decodeID = Crypt::decrypt($id);

        

        $arr = [];


        $arr = User::where('current_grade',$decodeID)->get();

        return view ('reports.list-general-report-staff',[
            'data' => $arr
        ]);
    
    }
}

<?php

namespace App\Http\Controllers\DocumentApprovall;

use App\Http\Controllers\Controller;
use App\Models\DocumentLibrary;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\View;

class DocumentApprovalController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function approvalDocumentView ($userID){

        $decodeID = Crypt::decrypt($userID);

        
        $userData = User::find($decodeID);

        $documentList = DocumentLibrary::where([['user_id',$decodeID],['status','Pending']])->get();


        return view ('approvals.approve-documaentation',[
            'userData' => $userData,
            'documentList' => $documentList
        ]);

    }

    public function approveDocumentProcess (Request $request){

        if(DocumentLibrary::where('id',$request->document_id)->get()->count() > 0){

            $updateData = DocumentLibrary::find($request->document_id);
            if($request->selectedValue == "Approve"){$updateData->status = "Active";}else{$updateData->status = "Inactive";}
            
            $updateData->approved_by = auth()->user()->id;
            $status = $updateData->update();

            if($status){

                return 'success';

            }else{

                return 'error';

            }


        }else{

            return "error";
        }


    }

    public function pendingApprovalView (){

        $pendingDocumentation = DocumentLibrary::where('status','Pending')->select('user_id')->groupBy('user_id')->orderBy('id','DESC')->get();

        return View ('approvals.pending-approval-list',[
            'pendingDocumentation' => $pendingDocumentation
        ]);
    }
}

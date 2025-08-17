<?php

namespace App\Http\Controllers\Documentation;

use App\Http\Controllers\Controller;
use App\Models\DocumentLibrary;
use App\Models\DocumentType;
use App\Models\User;
use Illuminate\Http\Request;

class MyDocumentationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function myDocuments (){

        $userData =  User::find(auth()->user()->id);
        $documentType = DocumentType::get();

        $documentList = DocumentLibrary::where([['user_id',auth()->user()->id],['status','Active']])->get();

       
         return view('documentation.my-profile-documents',[
             'userData' => $userData,
             'documentType' => $documentType,
             'documentList' => $documentList,
             'pdfData' => '',
             'userName' => trim(auth()->user()->username)
         ]);

    }

    public function getDocumentTypeDocuments (Request $request){
        
        $table = '';

        if(DocumentLibrary::where([['document_type_id',$request->document_type_id],['user_id',auth()->user()->id],['status','Active']])->get()->count() > 0){

            $data = DocumentLibrary::where([['document_type_id',$request->document_type_id],['user_id',auth()->user()->id],['status','Active']])->get();

            $table .= '<table id="example1" class="table table-bordered"><thead> <tr><th>Document</th><th></th></tr></thead>';

            $table .= '<tbody>';
            
            foreach ($data as $key) {
                
            $table .= '<tr>';

            $table .= '<td>'.$key->getDocumentClassification()->name.'</td>';

            $table .= '<td align="center"><a  id="pdfViewerBtn" data-id="'.asset($key->document_path).'#toolbar=0"><i class="fa fa-file-pdf"></i> View</a></td>';

            $table .= '</tr>';

            }

            $table .= '</tbody>';

            $table .= '</table>';


            return $table;

        }else{

            return 'empty';
        }



    }
}

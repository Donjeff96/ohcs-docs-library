<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentLibrary extends Model
{
    use HasFactory;


    public function getDocumentType (){

        return DocumentType::find($this->document_type_id);
    }

    public function getDocumentClassification (){

        return DocumentClassification::find($this->document_classification_id);
    }

    public function getUserDetails (){

        return User::find($this->user_id);
    }

    public function pendingDocumentAwaiting (){

        return DocumentLibrary::where([['user_id',$this->user_id],['status','Pending']])->get()->count();
    }
}

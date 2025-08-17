<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobQualificationInformation extends Model
{
    use HasFactory;

    public function getHighestEducation (){

        if(AcademicQualification::where('id',$this->highest_academic_id)->get()->count() > 0){


            return AcademicQualification::find($this->highest_academic_id)->name;

        }else{

            return 'not avaliable';
        }
    }


    public function getDocumentPath (){

        if(DocumentLibrary::where('id',$this->highest_academic_doc_id)->get()->count() > 0){


            return DocumentLibrary::find($this->highest_academic_doc_id)->document_path;

        }else{

            return 'not avaliable';
        }
    }

    public function getProfessionalDocumentPath (){

        if(DocumentLibrary::where('id',$this->profeesional_qualification_doc_id)->get()->count() > 0){


            return DocumentLibrary::find($this->profeesional_qualification_doc_id)->document_path;

        }else{

            return 'not avaliable';
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostionAndPromotion extends Model
{
    use HasFactory;

    public function getTypeName (){

        if(PostionAndPromotionType::where('id',$this->type_id)->get()->count() > 0){

            return PostionAndPromotionType::find($this->type_id)->name;


        }else{

            return 'N/A';
        }
    }

    public function getGrade (){

        if(Grade::where('id',$this->grade_id)->get()->count() > 0){

            return Grade::find($this->grade_id)->name;


        }else{

            return 'N/A';
        }
    }
}

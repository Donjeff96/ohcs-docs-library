<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupervisorInformation extends Model
{
    use HasFactory;

    public function getGrade(){

        if(Grade::where('id',$this->grade_id)->get()->count() > 0){

            return Grade::find($this->grade_id)->name;


        }else{

            return "not Available";
        }


    }
}

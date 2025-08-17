<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    public function staffCount (){

        return EmployeeCompensation::where('current_grade',$this->id)->get()->count();
        
    }

    public function mainStaffCount (){

        return User::where('current_grade',$this->id)->get()->count();
        
    }
}

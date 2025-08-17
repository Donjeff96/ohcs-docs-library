<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonnelMain extends Model
{
    use HasFactory;

    public function getInstitution (){

        return Institution::find($this->institution);
    }

    public function getRank (){

        return Grade::find($this->rank);
    }
}

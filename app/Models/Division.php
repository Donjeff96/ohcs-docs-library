<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    public function staffCount (){

        return 0;
        
    }

    public function getDivisionID (){
        
        return $this->id;
    }
}

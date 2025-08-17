<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;


    public function leaveInformation (){

        return LeaveMain::find($this->leave_id);
    }

    public function userInformation ($userID){

        return User::find($userID);
    }

    public function upateNotificationStatus(){

        $update = Notification::find($this->id);
        $update->status = "Sent";
        $update->update();
        
    }
}

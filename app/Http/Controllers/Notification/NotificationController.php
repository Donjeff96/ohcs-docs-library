<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Mail\DeclineNotification;
use App\Mail\DefferedNotification;
use App\Mail\DivisionHeadNotification;
use App\Mail\HRNotification;
use App\Mail\LeaveConfirmation;
use App\Mail\LeaveNotification;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller
{
    public function sendEmailNotification (){

        if(Notification::where('status','Pending')->get()->count() > 0){

            $notificationData = Notification::where('status','Pending')->get();

            
            foreach ($notificationData as $key) {

                if($key->type == "Supervisor_Approval"){

                    Mail::to($key->userInformation($key->authorizer_id)->email)->send(new LeaveNotification($key->userInformation($key->authorizer_id),$key->leaveInformation(),$key->userInformation($key->applicant_id)));

                    $key->upateNotificationStatus();

                }else if($key->type == "Divisional_Approval"){

                    Mail::to($key->userInformation($key->authorizer_id)->email)->send(new DivisionHeadNotification($key->userInformation($key->authorizer_id),$key->userInformation($key->applicant_id)));

                    $key->upateNotificationStatus();


                }else if($key->type == "HR_Approval"){

                    //replace with HR email

                    Mail::to('JOcran@mofep.gov.gh')->send(new HRNotification($key->userInformation($key->applicant_id)));

                    $key->upateNotificationStatus();


                }else if($key->type == "Declined_Request"){

                    
                    Mail::to($key->userInformation($key->applicant_id)->email)->send(new DeclineNotification($key->userInformation($key->applicant_id)));

                    $key->upateNotificationStatus();


                }else if($key->type == "Final_Approval"){

                    
                    Mail::to($key->userInformation($key->applicant_id)->email)->send(new LeaveConfirmation($key->userInformation($key->applicant_id),$key->leaveInformation()));

                    $key->upateNotificationStatus();


                }else if($key->type == "HR_DEFER"){

                    
                    Mail::to($key->userInformation($key->applicant_id)->email)->send(new DefferedNotification($key->userInformation($key->applicant_id)));

                    $key->upateNotificationStatus();

                }
                
            }
        }

    }
}

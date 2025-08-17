<?php

namespace App\Console\Commands;

use App\Http\Controllers\Notification\NotificationController;
use Illuminate\Console\Command;

class SendNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is to check and send mail notifications every Minute';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $mailNotification = new NotificationController();
        $mailNotification->sendEmailNotification();
    }
}

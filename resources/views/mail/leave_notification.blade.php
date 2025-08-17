<x-mail::message>
<b>Dear {{$userDetials->name}},</b>

<p>I hope this message finds you well. I am writing to inform you that <b>{{$applicant->name}}</b> has submitted a request for leave. They have indicated the following details:</p>
<br>
<ul>
    <li><b>Start Date: {{date('jS F, Y',strtotime($leaveData->start_date))}}</b></li>
    <li><b>End Date: {{date('jS F, Y',strtotime($leaveData->end_date))}}</b></li>
    <li><b>Type of Leave: {{$leaveData->getLeaveName()}}</b></li>
    <li><b>No. of Days: {{$leaveData->no_days}}</b></li>
</ul>
<br>
<p>Please review this request at your earliest convenience and let me know if there are any concerns or if additional information is required. Your prompt attention to this matter is greatly appreciated.</p>
<p>Thank you for your cooperation.</p>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

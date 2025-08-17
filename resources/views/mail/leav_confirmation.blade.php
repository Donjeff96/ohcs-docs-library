<x-mail::message>
<b>Dear {{$userDetials->name}},</b>

<p>I hope this message finds you well.</p>

<p>I am writing to inform you that your leave request has been approved. Your absence from <b style="color:black;">{{date('jS F, Y',strtotime($leaveData->start_date))}}</b> to <b style="color:black;">{{date('jS F, Y',strtotime($leaveData->end_date))}}</b> has been processed and documented in the {{ config('app.name') }}</p>

<p>We understand the importance of taking time off to recharge and attend to personal matters, and we're glad to support you in maintaining a healthy work-life balance.</p>

<p>Please ensure that you've completed any necessary handovers or delegated tasks before your departure. If you have any outstanding responsibilities or if there are any concerns regarding your absence, please don't hesitate to discuss them with your supervisor or the HR department.</p>
<p>We trust that you will return refreshed and ready to contribute positively to our team upon your return.</p>
<p>If you have any questions or need further clarification, feel free to reach out to me directly.</p>
<p>Wishing you a pleasant and rejuvenating time during your leave.</p>

Best regards,<br>
{{ config('app.name') }}
</x-mail::message>

<x-mail::message>
<b>Dear {{$userDetails->name}},</b>

<p>I hope this message finds you well</p>

<p>I regret to inform you that your leave request has been declined at this time. After careful consideration of the current workload and operational needs of the team/department, we find it necessary to retain your presence during the period requested</p>
<p>Thank you for your cooperation and ongoing contribution to the team's success.</p>

Best regards,<br>
{{ config('app.name') }}
</x-mail::message>

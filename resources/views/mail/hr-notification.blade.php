<x-mail::message>
<b>Dear Human Capital,</b>

<p>I hope this message finds you well.</p>

<p>I am writing to bring to your attention that there is a pending leave request awaiting your approval. <b>{{$staffDetails->name}}</b> from <b>{{$staffDetails->category}}</b> has submitted a leave request, and it requires your authorization.</p>

<p>Please take a moment to review the details of the request at your earliest convenience and proceed with the necessary approval process.</p>

<p>Should you require any additional information or assistance regarding this matter, please do not hesitate to reach out to me</p>

<p>Thank you for your attention to this request.</p>

Best regards,<br>
{{ config('app.name') }}
</x-mail::message>

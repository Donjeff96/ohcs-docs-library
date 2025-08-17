<x-mail::message>
<b>Dear {{$userDetails->name}},</b>

<p>I hope this message finds you well. I am writing to inform you that your leave request has been successfully deferred as per your request.</p>

<p>If you have any further questions or need additional assistance, please feel free to reach out. We wish you a smooth and enjoyable time off when the dates arrive.</p>

<p>Thank you for your understanding, and please do not hesitate to contact us if you need anything else.</p>


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

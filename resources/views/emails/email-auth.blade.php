@component('mail::message')
# Verify your login

Please use the verification code below on Hospsech website:

    {{ $data }}

If you didn't request this, you can ignore this email or let us know.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

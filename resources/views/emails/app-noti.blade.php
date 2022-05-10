@component('mail::message')
# HospSech appointment notification

You have an appointment on {{$da}} at {{$ti}}.<br>
Treatment: {{$treatment}}<br>
Doctor: {{$ms}}

Login to our portal to edit/cancel your appointment.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

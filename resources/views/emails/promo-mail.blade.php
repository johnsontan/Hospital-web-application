@component('mail::message')
# {{ $title }}

{{ $content }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent

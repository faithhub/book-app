@component('mail::message')

{{$subject}}

Thanks,<br>
{{$name}},<br>
{{ config('app.name') }}
@endcomponent
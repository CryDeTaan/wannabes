@component('mail::message')
# Tag Request

A new tag has been requested by {{ $user->name }}

@component('mail::button', ['url' => ''])
{{ $tag }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

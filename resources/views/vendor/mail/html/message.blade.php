@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
    <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" width="100" height="108">
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}
@endcomponent
@endslot
@endcomponent

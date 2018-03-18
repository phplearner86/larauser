@component('mail::message')
# Introduction

Dear {{ $user->name }}, thank you for registering with us.

To access the site content <a href="{{ route('login') }}">click here</a>.

To reset your password <a href="{{ route('password.request') }}">click here</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent

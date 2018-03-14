@component('mail::message')
# Introduction

Please press the button below to activate your account.
Your activation link expires on {{ $token->expires_at->toFormattedDateString() }}

@component('mail::button', ['url' => route('token.show', $token)])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

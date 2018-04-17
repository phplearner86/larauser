@component('mail::message')

Press the button bellow to activate your account.

Once you activate your account you may sign in using the following credentials:

<p>Username: {{ $token->user->email }}</p>
<p>Password: {{ $password }}</p>

Your activation link expires on {{ $token->expires_at->toFormattedDateString() }}

@component('mail::button', ['url' => route('token.show', $token)])
Confirm email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

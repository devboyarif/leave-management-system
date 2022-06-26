@component('mail::message')
# Invite to join company

You have been invited to join {{ $team->name }} team in {{ $company->name }}. Please click the button below to
accept the invitation.

@component('mail::button', ['url' => $url])
    Accept Invitation
@endcomponent

Thanks <br>
{{ config('app.name') }}
@endcomponent

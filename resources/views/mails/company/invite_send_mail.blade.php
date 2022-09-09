@component('mail::message')
# Invite to join {{ $company->company_name }}

You have been invited to join {{ $team->name }} team in {{ $company->company_name }}. Please click the button below to
accept the invitation.

@component('mail::button', ['url' => $url])
    Accept Invitation
@endcomponent

Thanks <br>
{{ config('app.name') }}
@endcomponent

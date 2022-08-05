<form action="{{ route('change.language') }}" method="post">
    @csrf
    <select name="language" id="">
        @foreach ($languages as $lang)
            <option value="{{ $lang['code'] }}">{{ $lang['name'] }}</option>
        @endforeach
    </select>

    <button>Submit</button>
</form>

<br>

<p>Current Language: {{ app()->getLocale() }}</p>
<p>Session Language: {{ session('current_lang') }}</p>

<p>{{ __('My Profile') }}</p>

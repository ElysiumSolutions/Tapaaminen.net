@if (count($errors) > 0)
    <div class="notification is-danger">
        Virheellinen lomake. Korjaathan seuraavat kohdat:<br />
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (count($errors) > 0)
    <div class="notification is-danger">
        <strong>Virheellinen lomake. Korjaathan seuraavat kohdat:</strong><br />

        @foreach ($errors->all() as $error)
            &bull; {{ $error }}<br />
        @endforeach

    </div>
@endif
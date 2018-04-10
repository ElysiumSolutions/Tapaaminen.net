<div class="box">
    <form method="post" action="{{ url('/a/'.$meeting->adminslug.'/basic') }}">
        {{ csrf_field() }}
        {{ method_field('patch') }}

        @include('layouts.errors')

        <div class="field">
            <label class="label">Tapaamisen nimi <small>(esim. Lounas, Palaveri)</small></label>
            <p class="control">
                <input class="input" name="name" type="text" value="{{ old('name', $meeting->name) }}" placeholder="Anna tapaamisen nimi" required>
            </p>
        </div>

        <div class="field">
            <label class="label">Tapaamisen kuvaus <small>(valinnainen)</small></label>
            <p class="control">
                <textarea name="description" class="textarea" placeholder="Anna tapaamisen kuvaus">{{ old('description', $meeting->description) }}</textarea>
            </p>
        </div>

        <div class="field">
            <label class="label">Sijainti <small>(valinnainen)</small></label>
            <p class="control">
                <input class="input" name="location" type="text" value="{{ old('location', $meeting->location) }}" placeholder="Anna tapaamisen sijainti">
            </p>
        </div>

        <div class="field">
            <label class="label">Nimesi</label>
            <p class="control">
                <input class="input" name="organizer" type="text" value="{{ old('organizer', $meeting->organizer) }}" placeholder="Anna nimesi" required>
            </p>
        </div>

        <div class="field">
            <label class="label">Sähköpostisi</label>
            <p class="control">
                <input class="input" name="email" type="email" value="{{ old('email', $meeting->email) }}" placeholder="Anna sähköpostisi" required>
            </p>
        </div>

        <div class="field">
            <p class="control"><button type="submit" class="button is-success">Muokkaa</button></p>
        </div>

    </form>
</div>
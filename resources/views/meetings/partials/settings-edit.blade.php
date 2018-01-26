<div class="box">
    <h3 class="title is-4">Muokkaa asetuksia</h3>

    <form method="post" action="{{ url('/a/'.$meeting->adminslug.'/settings') }}">
        {{ csrf_field() }}
        {{ method_field('patch') }}

        @include('layouts.errors')

        <p class="label">Aseta tapaamiselle salasana <small>(vain salasanan saaneet pääsee ilmoittautumaan)</small></p>
        @if($meeting->settings->password != null)
            <div class="field">
                <p class="control">
                    <button type="submit" name="target" class="button is-warning" value="removePassword">
                        <span>Poista salasana</span>
                    </button>
                </p>
            </div>
        @else
            <div class="field has-addons">
                <p class="control">
                    <input class="input" name="password" type="password" placeholder="Salasanasi">
                </p>
                <p class="control">
                    <button type="submit" name="target" class="button is-warning" value="setPassword">
                        Aseta salasana
                    </button>
                </p>
            </div>
        @endif

        <div class="field">
            <p class="label">Kommentointi</p>
            <p class="control">
                @if($meeting->settings->comments)
                    <button type="submit" name="target" class="button is-warning" value="hideComments">
                        <span>Piilota kommentointi</span>
                    </button>
                @else
                    <button type="submit" name="target" class="button is-success" value="showComments">
                        <span>Näytä kommentointi</span>
                    </button>
                @endif
            </p>
        </div>

        <div class="field">
            <p class="label">Oma sähköposti</p>
            <p class="control">
                @if($meeting->settings->showemail)
                    <button type="submit" name="target" class="button is-warning" value="hideEmail">
                        <span>Piilota oma sähköposti</span>
                    </button>
                @else
                    <button type="submit" name="target" class="button is-success" value="showEmail">
                        <span>Näytä oma sähköposti</span>
                    </button>
                @endif
            </p>
        </div>

        <div class="field">
            <p class="label">Osallistujien nimet</p>
            <p class="control">
                @if($meeting->settings->shownames)
                    <button type="submit" name="target" class="button is-warning" value="hideNames">
                        <span>Piilota osallistujien nimet</span>
                    </button>
                @else
                    <button type="submit" name="target" class="button is-success" value="showNames">
                        <span>Näytä osallistujien nimet</span>
                    </button>
                @endif
            </p>
        </div>

        <div class="field">
            <p class="label">Sosiaalisen median painikkeet</p>
            <p class="control">
                @if($meeting->settings->socialmediabuttons)
                    <button type="submit" name="target" class="button is-warning" value="hideSocialmediabuttons">
                        <span>Piilota sosiaalisen median painikkeet</span>
                    </button>
                @else
                    <button type="submit" name="target" class="button is-success" value="showSocialmediabuttons">
                        <span>Näytä sosiaalisen median painikkeet</span>
                    </button>
                @endif
            </p>
        </div>

    </form>
</div>
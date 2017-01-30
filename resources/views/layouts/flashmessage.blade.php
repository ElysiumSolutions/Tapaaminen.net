@if(session('flashmessage'))
    <div class="message {{ session('flashmessage')['status'] }}" id="flash-message">
        <div class="message-header">
            <p>
                @if(isset(session('flashmessage')['title']))
                    {{ session('flashmessage')['title'] }}
                @else
                    Ilmoitus
                @endif
            </p>
            <button type="button" class="delete" id="flash-message-button"></button>
        </div>
        <div class="message-body">
            {{ session('flashmessage')['message'] }}
        </div>
    </div>

    {{ session()->forget('flashmessage') }}
@endif
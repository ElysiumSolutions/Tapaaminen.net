<div class="message {{ config('tapaaminen.notification_class') }}">
    @if(config('tapaaminen.notification_title') != "")
        <div class="message-header">
            <p>{{ config('tapaaminen.notification_title') }}</p>
        </div>
    @endif
    <div class="message-body">
        {!! config('tapaaminen.notification_text') !!}
    </div>
</div>
<a class="panel-block" href="{{ $notification->data['link'] }}">
    <span class="panel-icon" style="color:#ff3860;">
        <i class="fa fa-heart"></i>
    </span>
    {{ $notification->data['message'] }} <br />
    <small>{{ $notification->created_at->diffForHumans() }}</small>
</a>
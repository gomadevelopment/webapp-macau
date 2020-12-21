<div class="msg-box-content">
    <input hidden type="number" id="unread_user_notifications_count" value="{{ $unread_user_notifications->count() }}">
    <input hidden type="number" id="read_user_notifications_count" value="{{ $read_user_notifications->count() }}">
    <input hidden type="checkbox" id="no_more_user_notifications">
    <!-- Message Block -->
    @if ($unread_user_notifications->count())
        @foreach ($unread_user_notifications as $notification)
            <a href="{{ $notification->url }}" class="unread">
                {{ $notification->text }}
            </a>
            <p class="time text-right d-block mt-0">
                <time class="timeago" datetime="{{ $notification['created_at'] }}"></time>
            </p>
            <hr class="m-0">
        @endforeach
    @else
        <p>Não tem notificações novas.</p>
        @if ($read_user_notifications->count())
            <hr class="m-0">
        @endif
    @endif
    @if ($read_user_notifications->count())
        @foreach ($read_user_notifications as $notification)
            <a href="{{ $notification->url }}">
                {{ $notification->text }}
            </a>
            <p class="time text-right d-block mt-0">
                <time class="timeago" datetime="{{ $notification['created_at'] }}"></time>
            </p>
            @if (!$loop->last)
                <hr class="m-0">
            @endif
        @endforeach
    @else
        <p>Não tem notificações antigas.</p>
    @endif
</div>
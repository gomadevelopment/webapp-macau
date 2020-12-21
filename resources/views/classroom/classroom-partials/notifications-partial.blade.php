<div style="padding: 5px;" class="to_scroll">
    <div class="students_or_colleagues pt-3 pr-3 pl-3">
    <input hidden type="number" id="unread_notifications_count" value="{{ $unread_notifications->count() }}">
    <input hidden type="number" id="read_notifications_count" value="{{ $read_notifications->count() }}">
    <input hidden type="checkbox" id="no_more_notifications">
        <div class="form-group m-0">
            @if($unread_notifications->count())
                @foreach ($unread_notifications as $notification)
                    <div class="">
                        <a href="{{ $notification->url }}" class="classroom_notification unread float-none m-0">
                            {{ $notification->text }}
                        </a>
                        <p class="notification_time_ago text-right d-block mt-0">
                            <time class="timeago" datetime="{{ $notification['created_at'] }}"></time>
                        </p>
                    </div>
                    <hr>
                @endforeach
            @else
                <p class="colleagues_name no_notifications m-0">
                    Não tem notificações novas.
                </p>
                @if($read_notifications->count())
                    <hr>
                @endif
            @endif
            @if($read_notifications->count())
                @foreach ($read_notifications as $notification)
                    <div class="">
                        <a href="{{ $notification->url }}" class="classroom_notification float-none m-0">
                            {{ $notification->text }}
                        </a>
                        <p class="notification_time_ago text-right d-block mt-0">
                            <time class="timeago" datetime="{{ $notification['created_at'] }}"></time>
                        </p>
                    </div>
                    @if (!$loop->last)
                        <hr>
                    @endif
                @endforeach
            @else
                <p class="colleagues_name no_notifications m-0">
                    Não tem notificações antigas.
                </p>
            @endif
        </div>
    </div>
</div>
@if($unread_notifications->count() || $read_notifications->count())
    <hr>
    <div class="form-group">
        <div class="text-center">
            <a href="#" class="notifications_see_more">
                Ver Mais
            </a>
            <a href="#" class="notifications_see_less">
                Ver Menos
            </a>
        </div>
    </div>
@endif
<div class="notifications-drop-menu">
    <div class="notifications-drop__header">
        <span class="notifications-drop__title">Notifications</span>
    </div>

    <div class="notifications-drop__body" id="notification_container">
        @foreach($notifications as $notification)
        <a href="#" class="notifications-drop-item">
            <div class="notifications-drop-item__img mr-14">
                <img src="{{$notification->image}}" alt="">
            </div>
            <div class="notifications-drop-item__text-block">
                <div class="flex justify-between items-center mb-2">
                    <span class="fw-700 ">{{$notification->title}}</span>
                    <span class="opacity-30 fs-12">{{$notification->created_at->diffForHumans()}}</span>
                </div>
                <p class="fw-600">{{$notification->context}}</p>
            </div>
        </a>
        @endforeach
    </div>

    <div class="notifications-drop__footer">
        <span class="opacity-40 fw-600 fs-14" id="unread_notification_count">{{$unread_notifications_count}} unread</span>
        <a href="{{route('main.profile.notification.index')}}" class="btn fw-800 ttu">Show All</a>
    </div>
</div>

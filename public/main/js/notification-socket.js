$(function () {
    const body=$('body');
    const user_id=body.data('user-id');
    const pusher_key=body.data('pusher-key');
    var pusher = new Pusher(pusher_key, {
        cluster: 'ap2',
        authEndpoint: '/broadcasting/auth',
        auth: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }
    });

    const channel = pusher.subscribe('private-notification.'+user_id);
    const notification_container=$("#notification_container");
    channel.bind('notification-event', function(data) {
        notification_container.children('.notifications-drop-item').last().remove()
        notification_container.prepend(`<a href="#" class="notifications-drop-item">
            <div class="notifications-drop-item__img mr-14">
                <img src="${data.image}" alt="">
            </div>
            <div class="notifications-drop-item__text-block">
                <div class="flex justify-between items-center mb-2">
                    <span class="fw-700 ">${data.title}</span>
                    <span class="opacity-30 fs-12">${data.date}</span>
                </div>
                <p class="fw-600">${data.context}</p>
            </div>
        </a>`)
     $("#unread_notification_count").text(`${data.notification_count} unread`)
    })
})

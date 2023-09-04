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

    var channel = pusher.subscribe('private-channel-not-read-message.'+user_id);

    channel.bind('not-read-message-event', function(data) {
        $("#message-notifications").attr('data-messages',data.message_count);
        $("#chat_group_list").load(location.href+ " #chat_group_list");
    })
})

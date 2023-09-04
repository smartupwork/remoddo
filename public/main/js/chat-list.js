$(document).ready(function () {
    const input = $('.message-input');
    const btn = $('.send_btn');
    input.keypress(function (e) {
        // var key = e.which;
        if (e.keyCode === 13 && !e.ctrlKey)  // the enter key code
        {
            btn.click();
            return false;
        }
    });
    const message_body=$('.messages-chat__body');
    btn.on('click', function (e) {
        e.preventDefault();
        const input_val = input.val();

        if (input_val.length > 0) {
            const url = btn.data('url');
            let form = new FormData();
            form.append('message', input_val);
            $.ajax({
                url,
                method: 'POST',
                data: form,
                dataType: 'JSON',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    const last_message=response.data.last_message;
                    window.messInfo = last_message;
                    input.val("");
                    console.log(last_message.message);
                    message_body.append(` <div class="messages-chat__message messages-chat__message--req">
                                            <div class="messages-chat__cloud">
                                                <div class="d-flex justify-content-between mb-3">
                                                <span
                                                    class="messages-chat__name">${last_message.full_name}</span>
                                                    <span class="messages-chat__time">${last_message.hour}</span>
                                                </div>
                                                <p>${last_message.message}</p>
                                            </div>
                                        </div>`)
                    // window.location.href = response.data.url;
                    message_body[0].scrollTo({
                        top: message_body[0].scrollHeight,
                        behavior: "smooth"
                    });
                    $("#chat_group_list").load(location.href+ " #chat_group_list");
                },
                error: function (response) {
                    console.log(response, 'error')
                }
            });
        }
    })


    Pusher.logToConsole = false;

    var pusher = new Pusher(btn.data('key'), {
        cluster: 'ap2',
        authEndpoint: '/broadcasting/auth',
        auth: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }
    });

    var channel = pusher.subscribe('private-message-channel.'+btn.data('order-id'));

    channel.bind('message-event', function(data) {
        const last_message=data.data;
        if ($('#messages').data('user-id')!==data.sender_id){
            message_body.append(`   <div class="messages-chat__message messages-chat__message--res">
                                            <div class="messages-chat__avatar user-avatar-wrpr mr-12">
                                                <img src="${last_message.avatar}" alt="">
                                            </div>
                                            <div class="messages-chat__cloud">
                                                <div class="d-flex justify-content-between mb-3">
                                                <span
                                                    class="messages-chat__name">${last_message.full_name}</span>
                                                    <span class="messages-chat__time">${last_message.hour}</span>
                                                </div>
                                                <p>${last_message.message}</p>
                                            </div>
                                        </div>`);
            message_notification.attr('data-messages',data.notReadMessages)
            $("#chat_group_list").load(location.href+ " #chat_group_list");
        }


    });
    $('.search-chat').keyup(function () {
        const search = $(this).val();
        const search_window = $('.search-window');
        const url = $(this).data('search-url');
        $.ajax({
            url: `${url}?q=${search}`,
            type: 'GET',
            success: function (response) {
                console.log(response.data.chats, 'success');
                search_window.children().remove();
                let chat_list = '';
                response.data.chats.forEach(function (element) {
                    chat_list += `
                            <li>
                                   <a href="${element.url}" class="search-window__item"><span>${element.full_name}</span> </a>
                             </li>`
                });

                search_window.append(chat_list);
            },
            error: function (response) {
                console.log(response, 'error')
            },
        })
    });

    $('textarea.chat-input').keydown(function (e) {
        if (e.keyCode === 13 && e.ctrlKey) {
            $(this).val(function(i,val){
                return val + "\n";
            });
        }
    }
    )

    const message_notification=$('#message-notifications');
    if (message_notification.data('messages')>0){
       const url=message_notification.data('url')
        $.ajax({
            url,
            type:'GET',
            success:function (response){
                if (response.data.messages_count>0){
                    message_notification.attr('data-messages',response.data.messages_count)
                }else{
                    message_notification.removeClass('notification');
                }
            },
            error:function (response){
                console.log(response)
            }
        })
    }

});

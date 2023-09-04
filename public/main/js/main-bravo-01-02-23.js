
$(document).ready(function() {
    const btn = $('.send_btn');
    const message_body = $('.messages-chat__body');
    btn.on('click', function(e) {
        e.preventDefault();
        message_body[0].scrollTo({
            top: message_body[0].scrollHeight,
            behavior: "smooth"
        });
    });
})

let newPostTextAreas = document.querySelectorAll('.chat-input')
for (item of newPostTextAreas) {
    item.addEventListener('input', function() {
        this.style.height = "40px";
        this.style.height = this.scrollHeight + "px";
    })
}
const messagesBody = document.querySelector(".messages-chat__body");
if (messagesBody) {
        messagesBody.scrollTo({
            top: messagesBody.scrollHeight,
            behavior: "smooth"
        });
}
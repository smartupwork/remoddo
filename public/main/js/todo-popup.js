$(function () {

    $('.todo-popup').on('click',function (e) {
        e.preventDefault();
        $('.error-message').text("")
        $('.todo-title').val("");
    })

    $('.add-todo').on('click',function (e) {
        e.preventDefault();
        const form=new FormData();
        const title=$('.todo-title');
        form.append('title',title.val())
        const url=$(this).data('url')
        let todo_list = $('.todo-list')
        let html = ""
        const main_path = 'https://remodo.webstaginghub.com'
        $.ajax({
            url: url,
            method: 'POST',
            data: form,
            dataType: 'JSON',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            contentType: false,
            cache: false,
            processData: false,
            success:function(response)
            {
                // window.location.reload();
                html += `<label class="custom-checkbox mb-16 d-flex justify-content-between align-items-center todo-item">
                <input type="checkbox" id="todo-input${response?.data?.todo?.id}"  class="custom-checkbox__input todo-input"
                       data-url="${main_path}/profile/user/todo/${response?.data?.todo?.id}/update-status">
                <span class="custom-checkbox__input-fake">
            </span>
                <label class="custom-checkbox__label flex-auto pl-14 me-3" for="todo-input${response?.data?.todo?.id}">
                    ${response?.data?.todo?.title}
                </label>
                <a href="#" class="btn radius-3 ttu delete-todo" data-url-delete="${main_path}/profile/user/remove/todo/${response?.data?.todo?.id}" id="removeTodo">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.9523 17.5031H7.04748C6.06732 17.5031 5.2524 16.7485 5.17723 15.7712L4.37256 5.31055H15.6272L14.8226 15.7712C14.7474 16.7485 13.9325 17.5031 12.9523 17.5031V17.5031Z" stroke="#323232" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M16.6695 5.31052H3.33057" stroke="#323232" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.65518 2.49695H12.3446C12.8626 2.49695 13.2825 2.91686 13.2825 3.43484V5.31062H6.71729V3.43484C6.71729 2.91686 7.13719 2.49695 7.65518 2.49695Z" stroke="#323232" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M11.6412 9.06213V13.7516" stroke="#323232" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M8.35873 9.06213V13.7516" stroke="#323232" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </a>
        </label>`
            todo_list.append(html)
            },
            error: function(response) {
                const errors=response.responseJSON.errors;
                const error_texts=[];
                Object.keys(errors).forEach(function (key){
                    $(`.error-${key}`).text(errors[key][0])
                })


            }
        });

    })
})

$(document).ready(function () {
    $('.update-user-password').on('click',function (e) {
        e.preventDefault();
        const current_password_field=$('.password');
        const new_password_field=$('.new_password');
        const new_password_confirmation_field=$('.new_password_confirmation');
        const url=$(this).data('url');

        const form=new FormData();

        form.append('password',current_password_field.val());
        form.append('new_password',new_password_field.val());
        form.append('new_password_confirmation',new_password_confirmation_field.val());

        $('.error-user').each(function (index,element) {
            $(element).text("");
        })

        $.ajax({
            url: url,
            method: 'POST',
            data: form,
            dataType: 'JSON',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            contentType: false,
            cache: false,
            processData: false,
            success:function (response) {
                $('.password-message').addClass('success-message').text(response.message)
                current_password_field.val("");
                new_password_field.val("");
                new_password_confirmation_field.val("");
            },
            error:function (response) {
                console.log(response,'error')
                const errors=response.responseJSON.errors;
                Object.keys(errors).forEach(function (key){
                    $(`.error-${key}`).text(errors[key][0])
                })
            }
        })

    })
})

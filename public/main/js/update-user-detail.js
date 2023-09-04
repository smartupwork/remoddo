$(document).ready(function () {

    $("#avatar").on('change', function () {
        let files=this.files;
        const avatar_section=$('.avatar_section');
        if(files){

            let reader = new FileReader();
            let html_result = '';
            reader.onload = function (event) {
                $('div.avatar_section > div.avatar_wrpr').remove();
                html_result += `<div class="avatar_wrpr">
                                    <img src="${event.target.result}" alt="">
                                </div>`
                avatar_section.prepend(html_result);

            }
            reader.readAsDataURL(files[0]);
        }
    })

    $('.update-user-detail').on('click',function (e) {
        e.preventDefault();
        const name_field=$('.name');
        const surname_field=$('.surname');
        const email_field=$('.email');
        const avatar_file=$('input[name="avatar"]')[0].files;
        const url=$(this).data('url');

        const form=new FormData();

        form.append('name',name_field.val())
        form.append('surname',surname_field.val())
        form.append('email',email_field.val())

        Array.from($('input[name="avatar"]')[0].files).forEach(function (element){
            form.append('avatar',element);
        })

        $('.error-detail').each(function (index,element) {
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
                $('.detail-message').addClass('success-message').text(response.message)
                location.reload(true);
            },
            error:function (response) {
                const errors=response.responseJSON.errors;
                Object.keys(errors).forEach(function (key){
                    $(`.error-${key}`).text(errors[key][0])
                })
            }
        })

    })
})

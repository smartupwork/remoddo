$(function () {
    const error_rating=$('.error-rating');
    $('.rating-popup').on('click',function (e){
        e.preventDefault();
        const url=$(this).data('url');
        error_rating.text("")
        $.ajax({
            url,
            type:'GET',
            success:function (response) {
                const lender=response.data;
                $('.rating-user-fullname').text(lender.full_name);
                $('.rating-user-avatar').attr('src',lender.avatar);
                $('.rating-total-rate').text(lender.rating);
                $('.rating-btn').data('url',lender.rating_url);
            },
            error:function (response) {
                console.log(response.data,'error')
            },
        })
    });
    $('.rating-btn').on('click',function (e) {
        e.preventDefault();
        const index=$('.star--checked').data('index')??0;
        const url=$(this).data('url');
        const form=new FormData();
        form.append('rate_value',index);
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
                window.location.reload()
            },
            error: function(response) {
                error_rating.text(response.responseJSON.message)
            }
        });
    })
})

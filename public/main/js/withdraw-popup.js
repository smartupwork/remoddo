$(function () {
    const amount=$('.amount');
    const available=$('#available');
    const account=$('.account');
    const form=new FormData();
    $('.cancel-btn').on('click',function (e) {
        e.preventDefault();
        amount.val("");
        $('.modal').removeClass('modal--show');
    })
    $('.withdraw-btn').on('click',function (e) {
        e.preventDefault();
        const url=$(this).data('url');

        if (available.is(':checked')){
            amount.val("")
            form.append('amount',0)
            form.append('payment_method','available')
        }else{
            form.append('payment_method','part_amount')
            form.append('amount',parseInt(amount.val()))
        }
        $('.error-message').text("");

        form.append('account_id',account.val())
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
                amount.val("")
                window.location.reload()
            },
            error: function(response) {
                if (response.status===422){
                    const errors=response.responseJSON.errors;
                    Object.keys(errors).forEach(function (key){
                        $(`.error-${key}`).text(errors[key][0])
                    })

                }else{
                    $('.error-amount').text(response.responseJSON.message)
                }

            }
        });
    })
})

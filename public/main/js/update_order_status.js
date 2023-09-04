$(document).ready(function () {
    let change_status_url=null;

    $('.order-status-btn').one('click',function (e){
        e.preventDefault();
        const url=$(this).data('url');
        const status=$(this).data('status');
        sendAjax(url,status)
    });

    $('.order-status-popup').on('click',function () {
        change_status_url=$(this).data('change-status-url')
        const url=$(this).data('url')

        const product_url=$('.product-url')
        const product_image=$('.product-image')
        const product_name=$('.product-name')
        const brand_name=$('.brand-name')

        $.ajax({
            url,
            type:'GET',
            success:function (response) {
                const product=response.data.product;
                product_url.attr('href',product.url)
                product_image.attr('src',product.image)
                product_name.text(product.name)
                brand_name.text(product.brand)
            },
            error:function (response) {
                console.log(response,'error')
            }
        })
    })

    $(document).on('click','.accept-popup-btn',function (e) {
        e.preventDefault();
        sendAjax(change_status_url,'accepted')
    })

    $(document).on('click','.decline-popup-btn',function (e) {
        e.preventDefault();
        sendAjax(change_status_url,'declined')
    })

    function sendAjax(url,status){
      const form=new FormData();
      form.append('status',status)
        $.ajax({
            url,
            method: 'POST',
            data: form,
            dataType: 'JSON',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            contentType: false,
            cache: false,
            processData: false,
            success:function(response)
            {
                window.location.href=response.data.url;
            },
            error: function(response) {
                Swal.fire(
                    'Warning',
                    response.responseJSON.message,
                    'error'
                )
            }
        });
    }
});

$(function () {
    let send_back_url=null;
    $('.send-back-popup').on('click',function (e){
        e.preventDefault();
        const url=$(this).data('url');
        send_back_url=$(this).data('send-back-url');
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
    $(document).on('click','.send-back-btn',function (e) {
        e.preventDefault();
        $.ajax({
            url:send_back_url,
            type: 'GET',
            success:function (response) {
                window.location.href=response.data.url;
            }
        })
    })
})

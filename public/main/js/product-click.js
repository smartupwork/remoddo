$(function () {
    $('.product-click').on('click',function(e){
        e.preventDefault();
        const href=$(this).attr('href');
        const redirect_url=$(this).data('redirect-url')
        const url=$(this).data('url')
        const redirect_title=$(this).data('redirect-title')
        let form = new FormData();
        form.append('redirect_url',redirect_url)
        form.append('redirect_title',redirect_title)
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
                window.location.href=href;
            }
        });
    })
})

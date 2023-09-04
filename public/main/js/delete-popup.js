$(function () {
    let url=null;
    $(document).on('click','.delete-data-btn',function (e) {
        e.preventDefault();
        url=$(this).attr('href')
    })
    $('.delete-data-cancel').on('click',function (e){
        e.preventDefault();
        $('.btn-close').trigger('click')
    })
    $('.delete-data-submit').on('click',function (e) {
        e.preventDefault();
        $.ajax({
            url,
            method: 'DELETE',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            contentType: false,
            cache: false,
            processData: false,
            success:function (response) {
                window.location.reload();
            },
            error:function (response){
                Swal.fire(
                    'Warning',
                    response.responseJSON.message,
                    'error'
                )
            }
        })
    })
})

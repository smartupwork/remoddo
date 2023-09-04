$(document).on('click','.dispute_btn',function (e){
    e.preventDefault();
    const form = new FormData()
    const reason_inp = $('.reason_inp');

    form.append('reason_inp', reason_inp.val());
    const url = $(this).data('url')
    $.ajax({
        url: url,
        method: 'POST',
        data: form,
        dataType: 'JSON',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            location.reload();

        },
        error: function (response) {
            showServerError(response);
        }
    });
})

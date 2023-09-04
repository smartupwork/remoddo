$(document).ready(function () {
    $('.lock-action').on('click',function (e) {
        e.preventDefault();

        const url=$(this).data('url');
        $.ajax({
            url: url,
            method: 'PUT',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        });
    })
});

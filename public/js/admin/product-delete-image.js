$(document).ready(function () {
    $('.delete-image').on('click', function () {
        const url = $(this).data('url');
        $.ajax({
            url,
            type: 'GET',
            success: (response) => {
                $(this).parent().parent().remove();
            },
            error: function (response) {
                console.log(response)
            }
        });
    })
});

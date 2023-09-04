$(document).ready(function () {

    $(document).on('click','.todo-input',function (e) {

        const url=$(this).data('url');
        $.ajax({
            url: url,
            method: 'PUT',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(response)
            {
                console.log(response,'success')
            },
            error: function(response) {
                console.log(response,'error')
            }
        });

    })

    $(document).on('click','#removeTodo',function (e) {
        e.preventDefault();
        const url=$(this).data('url-delete');
        const parent = $(this).parent('.todo-item')
        console.log(parent);
        console.log(this);
        $.ajax({
            url: url,
            method: 'GET',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(response)
            {
                // showServerSuccess(response);
                // location.reload(true);
                console.log(response,'success')
                parent.remove()
            },
            error: function(response) {
                showServerError(response);
                console.log(response,'error')
            }

        });

    })

})

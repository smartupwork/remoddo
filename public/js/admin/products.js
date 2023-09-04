$(document).ready(function () {
    let columns=[
        { data: 'id', name: 'id' },
        { data: 'title', name: 'title' },
        { data: 'brand', name: 'brand' },

    ]
    $('.attribute-cols').each(function (index,column) {
        let column_name=$(column).data('name');
        columns.push({
            data:column_name,name:column_name
        })
    })
    columns.push(
        { data: 'liked', name: 'liked' },
        { data: 'sales_per_month', name: 'sales_per_month' },
        { data: 'trending', name: 'trending' },
        { data: 'brand_confirmation', name: 'brand_confirmation' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    );

    let table = $('#pages-table').DataTable({
        order: [[ 0, "desc" ]],
        serverSide: true,
        ajax: {
			url: window.location.href,
            data: function (d) {
                d.brand_confirmation = $('#brand_confirmation').val()
            }
		},
        columns
    });
    $('#brand_confirmation').change(function(){

        table.draw();

    });

    $(document).on('click', '#pages-table .delete-resource', function (e) {
        e.preventDefault();
        deleteResource(table, $(this).data('link'));
    });
    $(document).on('click', '#remove-user .delete-resource', function (e) {
        e.preventDefault();

        swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: $(this).data('link'),
                    type: 'delete',
                    data: {
                        _token: $("[name='csrf-token']").attr("content")
                    },
                    success: (response)=>{
                        if (response.success) {
                          window.location.href=response.data.url
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        swal.fire("Error!", '', 'error');
                    }
                });
            }
        });
    });

    $(document).on('click', '.add-dynamic-block', function () {
        let $block = $('.card[data-dynamic="' + $(this).data('dynamic') + '"]').first().clone();
        $block.find('input[type="text"]').val('');
        $block.find('input.file-value-input-block').val('');
        $block.find('textarea').val('');
        $block.find('.ck-blurred').html('<p><br data-cke-filler="true"></p>');
        $block.find('.icon_thumbnails').hide();
        $block.find('img').attr('src', '');
        $block.find('.custom-file-label').text('Choose file');
        $('.list-dynamic-blocks[data-dynamic="' + $(this).data('dynamic') + '"]').append($block);

        $("html, body").animate({scrollTop: $block.offset().top - 70}, "fast");
    })

    $(document).on('click', '.remove-dynamic-block', function () {
        if ($('.card[data-dynamic="' + $(this).data('dynamic') + '"]').length <= 1) {
            swal.fire('Error!', 'You cannot delete the last block.', 'error');
            return false;
        }

        $(this).closest('.card[data-dynamic]').remove();
    });
});

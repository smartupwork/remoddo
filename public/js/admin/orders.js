$(document).ready(function () {
    let table = $('#pages-table').DataTable({
        order: [[ 0, "desc" ]],
        serverSide: true,
        ajax: {
			url: window.location.href,
            data: function (d) {
                d.status = $('#status').val()
                d.products = $('#products').val()
                d.brands = $('#brands').val()
                d.renters = $('#renters').val()
                d.lenders = $('#lenders').val()
                d.date_range ={
                    startDate:$('#reservation').data('daterangepicker').startDate.format('YYYY-MM-DD'),
                    endDate:$('#reservation').data('daterangepicker').endDate.format('YYYY-MM-DD'),
                }
            }
		},
        columns: [
            { data: 'id', name: 'id' },
            { data: 'invoice', name: 'invoice' },
            { data: 'product', name: 'product' },
            { data: 'total_price', name: 'total_price' },
            { data: 'status', name: 'status' },
            { data: 'lender', name: 'lender' },
            { data: 'renter', name: 'renter' },
            { data: 'date', name: 'date' },
            { data: 'action', name: 'action', orderable: false, searchable: false, }
        ]
    });
    $('#status').change(function(){
        table.draw();
    });

    $('#products').change(function(){
        table.draw();
    });

    $('#brands').change(function(){
        table.draw();
    });

    $('#renters').change(function(){
        table.draw();
    });

    $('#lenders').change(function(){
        table.draw();
    });

    $('#reservation').daterangepicker().on('apply.daterangepicker', function (e) {
        table.draw();
    })

    $(document).on('click', '#pages-table .delete-resource', function (e) {
        e.preventDefault();
        deleteResource(table, $(this).data('link'));
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

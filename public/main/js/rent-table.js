$(document).ready(function () {
    let rent_row_count = $('.rent-row-count');
    let new_left_rent_row_count = parseInt(rent_row_count.text());
    $('.add_rent').on('click', function (e) {
        e.preventDefault();
        const rent_day = $('.rent_day');
        const rent_price = $('.rent_price');

        const rent_day_value = parseInt(rent_day.val());
        const rent_price_value = parseInt(rent_price.val());
        if (rent_day_value > 0 && rent_price_value > 0) {

            const rent_day_title=rent_day_value>1 ? 'days' : 'day';
            $('.rent_table').find('tbody').append(`<tr>
                                    <td>
                                        ${rent_day_value} ${rent_day_title}
                                    </td>
                                    <td>
                                        £${rent_price_value}
                                    </td>
                                    <td>
                                        <a href="" class="btn btn--outline delete-rent-row btn--sm radius-3 ttu">Delete</a>
                                    </td>
                      </tr>`)
            rent_day.val("");
            rent_price.val("");
            new_left_rent_row_count++
            rent_row_count.text(`${new_left_rent_row_count} left`);
            $('.error-rents').text("");
        }else{
            Swal.fire(
                'Warning',
                'Please, enter only numeric value',
                'error'
            )
        }
    });
    $(document).on('click','.delete-rent-row',function (e) {
        e.preventDefault();
        $(this).parent().parent().remove();
        new_left_rent_row_count--
        rent_row_count.text(`${new_left_rent_row_count} left`);
    })
});

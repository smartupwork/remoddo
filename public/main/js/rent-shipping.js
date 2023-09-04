$(document).ready(function () {
    $('.next_step').on('click',function (e) {
        e.preventDefault();
        let name=$('.rent-name');
        let surname=$('.rent-surname');
        let address_id=$('.rent-address_id');
        let main_location=$('.rent-location');
        let additional_location=$('.rent-additional_location');
        let country=$('.rent-country');
        let city=$('.rent-city');
        let post_code=$('.rent-post_code');
        let phone=$('.rent-phone');
        let total_price=$('#total_price').text().substring(1)
        const form = new FormData()

        form.append('name',name.val())
        form.append('surname',surname.val())
        if (main_location.is(':hidden')){
            form.append('address_id',address_id.val())
        }else{
            form.append('main_location',main_location.val())
            form.append('additional_location',additional_location.val())
            form.append('country',country.val())
            form.append('city',city.val())
            form.append('post_code',post_code.val())
            form.append('phone',phone.val())
        }
        form.append('total_price',total_price)


        $.ajax({
            url: window.location.href,
            method: 'POST',
            data: form,
            dataType: 'JSON',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                window.location.href = response.data.url;
            },
            error: function (response) {
                if (response.status === 422) {
                    const errors = response.responseJSON.errors;
                    $('.error-message').each(function (index, element) {
                        $(element).text("");
                    })

                    Object.keys(errors).forEach(function (key) {
                        $(`.error-rent-${key}`).text(errors[key][0])
                    })
                }
            }
        });
    })
});

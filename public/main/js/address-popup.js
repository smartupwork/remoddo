$(document).ready(function () {

    let url = '';
    let method_type = '';
    const name = $('.address-name');
    const location = $('.address-location');
    const additional_location = $('.address-additional_location');
    const country = $('.address-country');
    const city = $('.address-city');
    const post_code = $('.address-post_code');
    const phone = $('.address-phone');
    const is_main = $('.is_main');

    $('.add-address').on('click', function (e) {
        e.preventDefault();
        url = $(this).data('url');
        method_type = 'POST'
        name.val('')
        country.val('')
        city.val('')
        post_code.val('')
        location.val('')
        phone.val('');
    });

    $('.edit-address').on('click', function (e) {
        e.preventDefault();
        const edit_url = $(this).attr('href');
        $.ajax({
            url: edit_url,
            method: 'GET',
            success: function (response) {
                const address = response.data.address;
                name.val(address.name)
                location.val(address.location)
                additional_location.val(address.additional_location)
                country.val(address.country)
                city.val(address.city);
                post_code.val(address.post_code)
                phone.val(address.phone);
                is_main.attr('selected',true)
                url = response.data.url;
                method_type='PUT'
            },
            error: function (response) {
                console.log(response, 'error')
            },

        })
    })


    $('.save-address').on('click', function (e) {
        e.preventDefault();
        const form = new FormData()

        form.append('name', name.val())
        form.append('location', location.val())
        form.append('country', country.val())
        form.append('city', city.val())
        form.append('post_code', post_code.val())
        form.append('additional_location', additional_location.val())
        form.append('phone', phone.val())
        form.append('is_main', is_main.val())

        if (method_type==='PUT'){
            form.append('_method', method_type)
        }

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
                window.location.href = response.data.url;
            },
            error: function (response) {
                if (response.status === 422) {
                    const errors = response.responseJSON.errors;
                    $('.error-message').each(function (index, element) {
                        $(element).text("");
                    })

                    Object.keys(errors).forEach(function (key) {
                        $(`.error-message-${key}`).text(errors[key][0])
                    })
                }
            }
        });
    })
});

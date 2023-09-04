$(document).ready(function () {
    let data = []
    const priceMinName = 'price[min]';
    const priceMaxName = 'price[max]';
    let priceMinValue = $("#price_min_filter").val();
    let priceMaxValue = $("#price_max_filter").val();
    let sortValue = $('.product_sorting').find(":selected").val() ?? getUrlParameter('sort');
    let page = getUrlParameter('page');
    let search = getUrlParameter('search');
    data.push({
        name: priceMinName,
        value: priceMinValue.trim(),
    });

    data.push({
        name: priceMaxName,
        value: priceMaxValue.trim(),
    })

    if (sortValue) {
        data.push({
            name: 'sort',
            value: sortValue
        })
    }

    if (page) {
        data.push({
            name: 'page',
            value: page
        })
    }
    if (search) {
        data.push({
            name: 'search',
            value: search
        })
    }


    $('.custom-checkbox__input').each(function (index, element) {

        if ($(this).is(':checked')) {
            let name = $(this).attr('name')
            let value = $(this).val();
            data.push({
                name,
                value
            })
        }

    });

    $(document).on('click','.custom-checkbox__input', function () {
        let name = $(this).attr('name')
        let value = $(this).val();
        if ($(this).is(':checked')) {
            data.push({
                name,
                value
            })
        } else {
            removeElementFromArray(data, name, value);
        }
        generateQueryParams(data)
    });

    $('.product_sorting').on('change', function () {
        removeElementFromArray(data, 'sort', sortValue);
        if ($(this).val()) {
            data.push({
                name: 'sort',
                value: $(this).val()
            })
        }
        generateQueryParams(data)
    })
    $('#price_min_filter').change(function () {
        removeElementFromArrayByKey(data, 'price[min]');
        if ($(this).val().trim()) {
            data.push({
                name: 'price[min]',
                value: $(this).val().trim()
            })
        }
        generateQueryParams(data)
    })

    $('#price_max_filter').change(function () {
        removeElementFromArrayByKey(data, 'price[max]');
        if ($(this).val()) {
            data.push({
                name: 'price[max]',
                value: $(this).val().trim()
            })
        }
        generateQueryParams(data)
    })


    $('.reset_filter-btn').on('click', function (e) {
        e.preventDefault();
        data = [];
        if (sortValue) {
            data.push({
                name: 'sort',
                value: sortValue
            })
        }
        if (page) {
            data.push({
                name: 'page',
                value: page
            })
        }

        generateQueryParams(data)
    })


    function generateQueryParams(arr) {
        const params = new URLSearchParams();
        arr.forEach(e => params.append(e.name, e.value));
        console.log('params:', params.toString());


        const params2 = new URLSearchParams(arr.map(e => [e.name, e.value]));
        console.log('params2:', params2.toString())


        const url = new URL(window.location.href.split('?')[0])
        url.search = params

        window.location.href = url.href
    }

    function removeElementFromArray(arr, name, value) {
        const indexOfObject = arr.findIndex(object => {
            return object.name === name && object.value === value;
        });

        arr.splice(indexOfObject, 1);
    }

    function removeElementFromArrayByKey(arr, name) {
        const indexOfObject = arr.findIndex(object => {
            return object.name === name;
        });

        arr.splice(indexOfObject, 1);
    }

    function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return false;
    };

    $('.filter_search_input').keyup(function (e) {
        let search = $(this).val();
        const form = $(this).closest('.filter_search_form');
        let name=$(form).data('name')
        let checkboxes = $(form).siblings('.checkboxes_section');
        let text='';
        $.ajax({
            url: `${$(form).data('url')}?search=${search}`,
            type: 'GET',
            success: function (response) {
                let results = response.data.data;

                checkboxes.children().remove();

                results.forEach(function(value, key, map){

                    let product_count=value.products
                        ? Object.keys(value.products).length
                        : value.products_count;
                    let title=value.title??value.value;
                    text+=`<label class="custom-checkbox mb-4">
                            <input name="${name}"  value="${value.id}" class="custom-checkbox__input" type="checkbox">
                            <span class="custom-checkbox__input-fake "></span>
                            <span class="custom-checkbox__label">${title} (${product_count})</span>
                        </label>`;
                });

                checkboxes.append(text)


            },
            error: function (response) {
                console.log(response, 'error')
            }
        })

    })

});

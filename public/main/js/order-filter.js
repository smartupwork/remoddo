$(function () {
    let data=[]
    let status_checkbox=$('.order-status-checkbox');
    let sortValue = $('.product_sorting').find(":selected").val() ?? getUrlParameter('sort');
    let page = getUrlParameter('page');
    status_checkbox.each(function (index, element) {

        if ($(this).is(':checked')) {
            let name = $(this).attr('name')
            let value = $(this).val();
            data.push({
                name,
                value
            })
        }

    });

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

    status_checkbox.on('change',function (e) {
        let name = $(this).attr('name')
        let value = $(this).val();
        if ($(this).is(':checked')){
            data.push({
                name,
                value
            })
        }else{
            removeElementFromArray(data, name, value);
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
    }
})

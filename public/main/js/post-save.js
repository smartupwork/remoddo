$(document).ready(function () {
    const title_field = $('.title');
    const address_field = $('.address');
    const description_field = $('.description');
    const brand_field = $('.brand_id');
    const gender_field = $('.gender');
    const attributes_field = $('.attribute');
    const tag = $('.tag-item');
    $($('.image-checkbox')[0]).prop('checked',true)
    $('.btn-add-post').on('click', function (e) {
        e.preventDefault();
        const url=$(this).data('url');

        let form = new FormData();


        if($('input[name="category_id[]"]:checked').length>0){
            $('input[name="category_id[]"]:checked').each(function () {
                form.append('category_id[]', parseInt(this.value) )
            });
        }else{
            $('.categories_id').data('categories-id').split(',').forEach(function (category) {
                form.append('category_id[]', parseInt(category) )
            })
        }


        $('.tag-item').each(function (index, element) {
            if($(element).data('tag')){
                form.append('tag[]',$(element).data('tag'));
            }

        })

        $('.rent_table').find('tbody').children().each(function (index, element) {
            const rent_day=parseInt($(element).children().first().text());
            const rent_price=parseInt($(element).children().eq(1).text().trim().substring(1));

            form.append(`rents[${rent_day}]`,rent_price)
        })

        form.append('title', title_field.val())
        form.append('gender', gender_field.val())
        form.append('address', address_field.val())
        form.append('description', description_field.val())
        form.append('brand_id', brand_field.val())

        attributes_field.each(function (index, element) {
            let attr_id = $(element).data('attribute-id')
            let attr_name = $(element).data('attribute-name')
            let attr_arr = $(element).data('is-array') ? '[]' : '';
            if ($(element).val().length){
                form.append(`attribute[${attr_id}][${attr_name}]${attr_arr}`, $(element).val())
            }
        })
        uploaded_images.forEach(function (element){
            form.append('images[]',element);
        })

        $('.image-checkbox').each(function (index) {
            let main_image=''
            if ($(this).is(':checked')){
                 main_image='is_main'
            }
            form.append(`is_main[${index}]`,main_image);
        })

        $.ajax({
            url: url,
            method: 'POST',
            data: form,
            dataType: 'JSON',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            contentType: false,
            cache: false,
            processData: false,
            success:function(response)
            {
                window.location.href=response.data.url;
            },
            error: function(response) {
                const errors=response.responseJSON.errors;
                $('.error').each(function (index,element) {
                    $(element).text("");
                })
                const error_texts=[];
                Object.keys(errors).forEach(function (key){
                    $(`.error-${key.replaceAll('.','-')}`).text(errors[key][0])
                    error_texts.push(`<span class="error-message">${errors[key][0]}</span>`)
                })
                Swal.fire(
                    'Warning',
                    error_texts.join("<br>"),
                    'error'
                )

            }
        });
    });
    $(".input").keyup(function (e) {
        if ($(this).val().length>0){
            $(this).siblings().closest('.error-message').text("")
        }
    })
    $('.choices').on('change',function (e){
            $(this).siblings().closest('.error-message').text("")
    })
    $('.brand_id').on('change',function (e){
        $(this).siblings().closest('.error-message').text("")
    })
    $(document).on('change','input[name="category_id[]"]',function (){
        if ($(this).is(':checked')){
            $('.error-category_id').text("");
        }
    })
    $('.brand_id').select2({
        tags: true
    })
})

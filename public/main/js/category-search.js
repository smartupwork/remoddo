$(function () {
   
    // $('.category-popup').on('click',function (e){
    //     $('.category-search').val("").trigger('keyup')
    // })

    $('.category-search').keyup(function (e) {
        const url=`${$(this).data('url')}?search=${$(this).val()}`;
        let html_result='';
        let search_results = "";
        let search_tag_window_list = $('.search-window');
        let search_val=$(this).val()
        const category_ids=[];

            $.ajax({
                url,
                type:'GET',
                success:function (response){
                    
                    
                    $('.tag-list--categories > .tag-item').each(function (index,element) {
                        category_ids.push($(element).data('tag-id'))
                    })

                    $('.search-window').show();
                    const result=response.data;
                    $('.parent-category').remove();
                    search_tag_window_list.children().remove();
                    result.forEach(parent=>{
                        html_result+=`  <div class="category-accordeon border-bottom parent-category parent-${parent.id}" data-spoller>
                                <div class="category-accordeon__btn"  data-spoller-btn>
                                    <span class="category-accordeon__title">${parent.title}</span>
                                    <div class="category-accordeon__arrow">
                                        <img src="${parent.image}">
                                    </div>
                                </div>
                            <div class="category-accordeon__content accordeon-${parent.id}" style="display: none;" data-spoller-drop>
                               <div class="d-flex flex-column">`;
                        parent.children.forEach(category=>{
                            let is_checked=category.is_checked || category_ids.includes(category.id) ? 'checked' : '';
                            html_result+=`  <label class="custom-checkbox mb-20">
                                <input type="checkbox" name="category_id[]" data-tag-title="${category.title}" data-tag-id="${category.id}" value="${category.id}" ${is_checked}  class="category_id custom-checkbox__input category-children-item category_checkbox_${category.id}">
                                <span class="custom-checkbox__input-fake">
                                </span>
                                <span class="custom-checkbox__label pl-14">${category.title} (${category.product_count})</span>
                            </label>`;
                            if (search_val.length>0){
                                search_results += `<li data-category-title="${category.title}" data-parent-id="${category.parent_id}" data-id="${category.id}" class="category-children-item">
                                                <a href="#" class="search-window__item">
                                                    <span class="name-artis">${category.title}</span>
                                                </a>
                                            </li>`
                            }

                        })
                        html_result+=`</div></div></div>`;
                    })
                    $('.category-list').append(html_result)
                    if (search_val.length>0) {
                        search_tag_window_list.append(search_results)
                    }


                    if (result.length && search_tag_window_list.parent('.input-search-form').hasClass("active") ) {
                        search_tag_window_list.show();
                    } else {
                        search_tag_window_list.hide();
                    }


                }
            })


    })
//     $(document).on('click','.category-children-item',function (e){
//         e.preventDefault();
//         const parent_id=$(this).data('parent-id');
//         const category_title=$(this).data('category-title');
//         const id=$(this).data('id');
//         const category_tag_list=$('.tag-list--categories');
//         const delete_icon=category_tag_list.data('delete-icon');
//         const category_checkbox=$(`.category_checkbox_${id}`);
//         $('.search-window').hide();
//         $(`.parent-${parent_id}`).addClass('active')
//         $(`.accordeon-${parent_id}`).show()

//         if (!category_checkbox.is(':checked')){
//             category_checkbox.prop('checked',true);

//             category_tag_list.append(`
//         <li class="tag-item" data-tag-id="${id}">
//                                             <span class="tag tag-delete">
//                                                 <button class="btn">
//                                                     <img src="${delete_icon}">
//                                                 </button>
//                                                 <span class="info">${category_title}</span>
//                                             </span>
//                                         </li>
//         `);
//         }
// })
    let search_tag_window = $('#category')
        const tag_list = $('.tag-list--categories');
        $(document).on('click','.category-children-item',function (e){
            const parent_id=$(this).data('parent-id');
            const category_title=$(this).data('tag-title') || $(this).data('category-title');
            const id=$(this).data('tag-id') || $(this).data('id');
            let html_tag = ''
            console.log(id);
            const category_tag_list=$('.tag-list--categories');
            const delete_icon=category_tag_list.data('delete-icon');
            const category_checkbox=$(`.category_checkbox_${id}`);
            $('.search-window').hide();
            $(`.parent-${parent_id}`).addClass('active')
            $(`.accordeon-${parent_id}`).show()
            console.log(category_checkbox.is(':checked'));

            if($(this).closest(".search-window").length) {
                category_checkbox.prop('checked', true);
            }

            if (category_checkbox.is(':checked')){
                category_checkbox.prop('checked', true);
                html_tag += `<li class="tag-item" data-tag-id="${id}">
                                <span class="tag tag-delete">
                                    <button class="btn">
                                        <img src="${delete_icon}">
                                    </button>
                                <span class="info">${category_title}</span>
                                </span>
                            </li>`
                category_tag_list.append(html_tag);
                $(this).attr('checked', 'checked');
            } else {
                tag_list.find(`[data-tag-id='${id}']`).remove();
                $(this).removeAttr('checked');
            }
        })
        tag_list.on('click', '.tag-delete .btn', function (e) {
            e.preventDefault();
            $(this).parent().parent().remove();
            const id = $(this).parent().parent().data('tag-id');
            search_tag_window.find(`[data-tag-id='${id}']`).prop( "checked", false);
            search_tag_window.find(`[data-tag-id='${id}']`).removeAttr('checked');
        });

})

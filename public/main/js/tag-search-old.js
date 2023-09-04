$(document).ready(function () {
    let search_tag_window = $('.search-tag-window');
    let tag_count = $('.tag_count');
    let new_left_tag_count = parseInt(tag_count.text());
    const tag_search_input = $('.tag-search');
    const tag_list={}

    tag_search_input.keypress(function (e) {
        if (e.keyCode===13){
            $('.add-tag-btn').trigger('click')
        }
    })


    tag_search_input.keyup(function (e) {
        const search = $(this).val();
        const url = $(this).data('url');
        let tag_list = '';

        $.ajax({
            url: `${url}?search=${search}`,
            type: 'GET',
            success: function (response) {
                search_tag_window.children().remove();
                console.log(response.data.tags)
                response.data.tags.forEach(function (element) {
                    tag_list += `<li>
                            <a href="#"
                                data-tag-id="${element.id}"
                                data-tag-title="${element.title}"
                                  class="search-window__item tag__item">
                                <span>${element.title}</span>
                            </a>
                        </li>`
                });
                if (response.data.tags.length && search_tag_window.parents().find('.input-search-form').hasClass("active")) {
                    search_tag_window.show();
                } else {
                    search_tag_window.hide();
                }
                search_tag_window.append(tag_list);
            },
            error: function (response) {
                console.log(response, 'error')
            },
        })
    })
    $(document).on('click', '.tag__item', function (e) {
        e.preventDefault();
        const title = $(this).data('tag-title');
        const id = $(this).data('tag-id');


        if ($("li.tag-item:contains(" + title + ")", $('ul.tag-list.tag-list--tags')).length === 0) {
            tag_search_input.val(title)
            tag_search_input.data('tag-id', id)
        }


    }).on('click', '.tag-delete .btn', function (e) {
        e.preventDefault();
        $(this).parent().parent().remove();
        new_left_tag_count++;
        tag_count.text(`${new_left_tag_count} left`);
    });

    $('.add-tag-btn').on('click', function (e) {
        e.preventDefault();
        const title = tag_search_input.val();
        const id = tag_search_input.data('tag-id');
        let tag_list = $('.tag-list.tag-list--tags');
        const delete_icon = $(tag_list).data('delete-icon');
        let html_result='';
        if (title.length > 0) {

            if ($("li:contains(" + title + ")", $('ul.search-tag-window')).length > 0 &&
                $("li.tag-item:contains(" + title + ")", $('ul.tag-list.tag-list--tags')).length === 0) {
                html_result+=` <li class="tag-item" data-tag="${id}">
                                                    <span class="tag tag-delete">
                                                        <button class="btn">
                                                       <img  src="${delete_icon}"></button>
                                                        <span class="info">${title}</span>
                                                    </span>
                                            </li>`;
                new_left_tag_count--;
            }else{
               let tag_data=title.split(/,| /);
                tag_data.map(function (tag){
                    if (tag.length>0){
                        html_result+=` <li class="tag-item" data-tag="${tag}">
                                                    <span class="tag tag-delete">
                                                        <button class="btn">
                                                       <img  src="${delete_icon}"></button>
                                                        <span class="info">${tag}</span>
                                                    </span>
                                            </li>`;
                    }
                })
                new_left_tag_count = new_left_tag_count - tag_data.length;
            }
            tag_list.append(html_result);
            tag_search_input.val('')
            tag_count.text(`${new_left_tag_count} left`);
        }
        search_tag_window.hide();
    })

    let search_tag_window_popup = $('#category')
    const tag_list_popup = $('.tag-list--categories');


    search_tag_window_popup.on('click', '.custom-checkbox__input', function (e) {
        const title = $(this).data('tag-title');
        const id = $(this).data('tag-id');
        console.log(title, id);
        let html_result='';
        const delete_icon = $(tag_list_popup).data('delete-icon');
        if ($(this).is(':checked')) {
            console.log($(this).is(':checked'));
            html_result+=`<li class="tag-item" data-tag-id="${id}">
                                <span class="tag tag-delete">
                                    <button class="btn">
                                        <img src="${delete_icon}">
                                    </button>
                                    <span class="info">${title}</span>
                                </span>
                            </li>`;
            tag_list_popup.append(html_result);
        } else {
            tag_list_popup.find(`[data-tag-id='${id}']`).remove();
        }

    })
    tag_list_popup.on('click', '.tag-delete .btn', function (e) {
        e.preventDefault();
        $(this).parent().parent().remove();
        const id = $(this).parent().parent().data('tag-id');
        search_tag_window_popup.find(`[data-tag-id='${id}']`).prop( "checked", false);
    });





})

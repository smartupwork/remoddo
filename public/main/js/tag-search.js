$(function (){
    let tag_search_input=$('.tag-search');
    let tag_list=$('.tag-list--tags');
    let delete_icon=tag_list.data('delete-icon');
    let search_tag_window = $('.search-tag-window');
    tag_search_input.keyup(function (e) {
        $(this).defaultValue='';
        const search = $(this).val();
        const url = $(this).data('url');
        let tag_list = '';

        $.ajax({
            url: `${url}?search=${search}`,
            type: 'GET',
            success: function (response) {
                search_tag_window.show()
                search_tag_window.children().remove();

                response.data.tags.forEach(function (element) {
                    tag_list += `<li data-tag-title="${element.title}"  class="tag__item">
                            <a href="#"
                                  class="search-window__item">
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

    tag_search_input.keypress(function (e) {
        if (e.keyCode===13){
            e.preventDefault();
            addTag()
        }
    })
    $('.add-tag-btn').on('click', function (e) {
        e.preventDefault();
        addTag()
    })
    $(document).on('click', '.tag-delete .btn', function (e) {
        e.preventDefault();
        $(this).parent().parent().remove();
    });

    $(document).on('click', '.tag__item', function (e) {
        e.preventDefault();
        const title = $(this).data('tag-title');
        if ($("li.tag-item:contains(" + title + ")", $('ul.tag-list.tag-list--tags')).length === 0) {
            tag_search_input.val(title)
        }
        search_tag_window.hide()

    })

    function addTag() {
        let html_result='';
        const title = tag_search_input.val();

        if (title.length>0){
            let tag_data=title.split(/,| /);
            tag_data.map(function (tag){
                if (tag.length>0 &&
                    $("li.tag-item:contains(" + tag + ")", $('ul.tag-list.tag-list--tags')).length===0){
                    html_result+=` <li class="tag-item" data-tag="${tag}">
                                                    <span class="tag tag-delete">
                                                        <button class="btn">
                                                       <img  src="${delete_icon}"></button>
                                                        <span class="info">${tag}</span>
                                                    </span>
                                            </li>`;
                }
            })
            tag_list.append(html_result);
            tag_search_input.val('')
        }
    }
})



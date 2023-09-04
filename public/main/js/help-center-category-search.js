$(function () {
    $('.category-search').keyup(function (e) {
        e.preventDefault();
        const url=$(this).data('url');
        const category_search_window=$('.category-search-window');
        let search_list='';
        $.ajax({
            url:`${url}?search=${$(this).val()}`,
            type:'GET',
            success:function (response) {
                category_search_window.find('li').children().remove();
                if (Object.keys(response.data.categories).length>0){
                    response.data.categories.forEach(function (result) {
                        search_list+=`<li>
                                  <a href="/help-center/${result.id}" class="search-window__item">
                                     <span>${result.title}</span>
                                  </a>
                               </li>
                              `;
                    })
                }else {
                    search_list+=`<li class="text-center">
                                     <span class="error-message">Help Center Category not found</span>
                               </li>
                              `;
                }
                category_search_window.append(search_list);
            },
            error:function (response) {
                console.log(response,'error')
            }
        })
    })
})

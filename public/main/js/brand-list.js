$(function () {

    const search__link=$('.search--link');
    const selected_filter=`#${window.location.href.split("#")[1]}`;

    search__link.on('click',function(e){
        $('.selected_filter').removeClass('selected_filter');
        $(this).addClass('selected_filter')
    })


    search__link.each(function (i,filter) {
        $(filter).removeClass('selected_filter')
        if ($(filter).attr('href')===selected_filter){
            $(filter).addClass('selected_filter');
        }
    })

    $('.brand-search').keyup(function (e) {
        e.preventDefault();
        const url=$(this).data('url');
        const brand_search_window=$('.brand-search-window');
        let search_list='';
        $.ajax({
            url:`${url}?search=${$(this).val()}`,
            type:'GET',
            success:function (response) {
                brand_search_window.find('li').children().remove();
                if (Object.keys(response.data.data).length>0){
                    response.data.data.forEach(function (result) {
                        search_list+=`<li>
                                  <a href="/brand-products/${result.id}" class="search-window__item">
                                     <span>${result.title}</span>
                                  </a>
                               </li>
                              `;
                    })
                }else {
                    search_list+=`<li class="text-center">
                                     <span class="error-message">Brand not found</span>
                               </li>
                              `;
                }
                brand_search_window.append(search_list);
            },
            error:function (response) {
                console.log(response,'error')
            }
        })
    })
})

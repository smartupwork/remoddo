$(function () {
    $('.question-search').keyup(function (e) {
        e.preventDefault();
        const url=$(this).data('url');
        const question_search_window=$('.question-search-window');
        let search_list='';
        $.ajax({
            url:`${url}?search=${$(this).val()}`,
            type:'GET',
            success:function (response) {
                question_search_window.find('li').children().remove();
                if (Object.keys(response.data.questions).length>0){
                    response.data.questions.forEach(function (result) {
                        search_list+=`<li>
                                  <a href="/help-center/question/${result.id}" class="search-window__item">
                                     <span>${result.question}</span>
                                  </a>
                               </li>
                              `;
                    })
                }else{
                    search_list+=`<li class="text-center">
                                     <span class="error-message">Help Center Question not found</span>
                               </li>
                              `;
                }

                question_search_window.append(search_list);
            },
            error:function (response) {
                console.log(response,'error')
            }
        })
    })
})

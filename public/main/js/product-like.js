$(document).ready(function () {
   $('.like_product').on('click',function (e) {
       e.preventDefault();
       const button=$(this);
       const url=button.data('product-url')
      $.ajax({
          url,
          type:'GET',
          success:function (response) {
              const image=response.data.image;
              button.children('img').remove();
              button.append(`<img src="${image}" alt="">`)
          },
          error:function (response) {
              if (response.status===401){
                  window.location.href='/login'
              }
          }
      })
   })
});

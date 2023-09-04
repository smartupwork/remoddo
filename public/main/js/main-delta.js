var $ = jQuery.noConflict();

$(document).ready(function () {
      $(".show-more-item").on("click", function(e) {
        e.preventDefault();
        $(this).hide()
        $(this).siblings(".more-items").show()
      })

      $(document).on('scroll', function () {
        if($(document).scrollTop() > 1) {
            $('.header-intro').addClass('header-scroll')
        } else {
            $('.header-intro').removeClass('header-scroll')
        }
      })
      if($(document).scrollTop() > 1) {
          $('.header-intro').addClass('header-scroll')
      } else {
          $('.header-intro').removeClass('header-scroll')
      }

    let accordeon = toggleClicker(
        "[data-accordeon-btn]", // Кликабельный элемент
        "active-accordeon", // Название класса для active
        "[data-accordeon]", // Родитель кликабельного элемента
        false, // Клик вне элемента true | false
        (element, event) => {

            let body = element.querySelector(".accordeon-body");
            event.stopPropagation();
            slideToggle(body, 200);

        },
        false
    );



    var swiper = new Swiper(".intro-swiper", {
      effect: "coverflow",
      centeredSlides: true,
      grabCursor: true,
      slidesPerView: 5,
      spaceBetween: 0,
      initialSlide: 2,
      // observer: true,
      // observeParents: true,
      // watchSlidesVisibility: true,
      // watchSlidesProgress: true,
      loop: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true
      },
      coverflowEffect: {
        rotate: 0,
        stretch: 50,
        depth: 0,
        modifier: 1,
        slideShadows: false,
      },
  });

  var swiper = new Swiper(".intro-swiper-cards", {
    effect: "cards",
    centeredSlides: true,
    initialSlide: 2,
    grabCursor: true,
    cardsEffect: {
      rotate:	true,
      perSlideRotate: 5,
      perSlideOffset: 20,
      slideShadows: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true
    },
    loop: true,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
});


    $(".intro-swiper").mouseenter(function() {
      swiper.autoplay.stop();
    });

    $(".intro-swiper").mouseleave(function() {
      swiper.autoplay.start();
    });

    $('.change_sidebar').on('click',function () {
        const url=$(this).data('url');
        $.ajax({
            url,
            type:'GET',
            success:function (response) {
                window.location.href=response.data.url;
            },
            error:function (response) {
                console.log(response,'error')
            }
        })
    })
    const sidebar_checkbox=$('#checkbox-switcher');
    const role=$(sidebar_checkbox).data('role');

    if (role==='lender'){
        sidebar_checkbox.prop('checked',false)
    }else{
        sidebar_checkbox.prop('checked',true)
    }
    $('.product-search').keyup(function (e) {
        e.preventDefault();
        const url=$(this).data('url');
        const product_search_window=$('.product-search-window');
        let search_list='';
        $.ajax({
            url:`${url}?search=${$(this).val()}`,
            type:'GET',
            success:function (response) {
                product_search_window.find('li').children().remove();
                response.data.data.forEach(function (result) {
                    search_list+=`<li>
                                  <a href="${url}?search=${result}" class="search-window__item">
                                     <span>${result}</span>
                                  </a>
                               </li>
                              `;
                })
                product_search_window.append(search_list);
            },
            error:function (response) {
                console.log(response,'error')
            }
        })
    })


  });
const images=[];
$('.product_detail_images').each(function (index,element){
    const imgPath=$(element).attr('src');
    images.push(imgPath);
})

var swiperVertical = new Swiper(".vertical-swiper", {
  effect: "fade",
  direction: "vertical",
  pagination: {
    el: ".swiper-pagination-images",
    clickable: true,
    renderBullet: (index, className) => {

      return `<img class="${className}" src='${images[index]}'/>`;
    },
  },
});

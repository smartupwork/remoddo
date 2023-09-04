var $ = jQuery.noConflict();

$(document).ready(function () {
    $(document).click(function({target}) {
        if(!target.closest(".sidebar")) {
            $(".sidebar").removeClass('active')
        }
    })
    
    $('.sidebar-open').click(function(e) {
        e.preventDefault()
        $('.messages-sidebar').toggleClass('active')
    })
    $('.sidebar-close').click(function(e) {
        e.preventDefault()
        $('.messages-sidebar').removeClass('active')
    })
})


let init = false;
let messagesSwiper;

const enableSwiper = () => {
    messagesSwiper = new Swiper(".messages-swiper",{
        slidesPerView: 1,
        spaceBetween: 30,
        navigation: {
            nextEl: ".to-messages",
            prevEl: ".to-chatlist",
          },
        noSwipingSelector: '.swiper-slide--no-swipe',
    })
  };

const swiperToggler = () => {
    if(!init && window.innerWidth < 992) {
        enableSwiper()
        init = true
    } else if (init && messagesSwiper && window.innerWidth >= 992) {
        messagesSwiper.destroy()
        init = false
    }
}
if(document.querySelector(".messages-swiper")) {
    swiperToggler()
    window.addEventListener('resize', swiperToggler)
}

// const ellipsis = document.querySelectorAll('.ellipsis')


// const elepsisResize = () => {
//     const ellipsis = document.querySelectorAll('.ellipsis')
//     ellipsis.forEach(el => {
//         const width = el.parentElement.offsetWidth;
//         el.style.width = width;
//         console.log(width);
//     })
// }

// if(ellipsis) {
//     window.addEventListener('resize', elepsisResize)
// }

const sidebar = document.querySelector('.messages-sidebar');
if (sidebar) {
    const options = {
        rootMargin: '0px',
        threshold: 1.0
      };
      const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
    
            if (sidebar && entry.intersectionRatio >= 1) {
                sidebar.classList.add('show')
            } else if (sidebar && sidebar.classList.contains('show')) {
                sidebar.classList.remove('show')
            }
        });
      }, options);
      const element = document.querySelector('#messages')
      observer.observe(element);
}

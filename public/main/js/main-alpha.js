var $ = jQuery.noConflict();

$(document).ready(function () {
    var uaTwo = window.navigator.userAgent;
    var isIETwo = /MSIE|Trident/.test(uaTwo);

    if (isIETwo) {
        document.documentElement.classList.add('ie');
    }

    if (navigator.userAgent.indexOf('Safari') !== -1 &&
        navigator.userAgent.indexOf('Chrome') === -1) {
        $("body").addClass("safari");
    }

    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.scroll_to_top').addClass('active');
        } else {
            $('.scroll_to_top').removeClass('active');
        }
    });

    $('.scroll_to_top').click(function () {
        $("html, body").animate({scrollTop: 0}, "slow");
        return false;
    });


    let Widget_filter = toggleClicker(
        "[data-burger]", // Кликабельный элемент
        "open-menu", // Название класса для active
        "body", // Родитель кликабельного элемента
        false, // Клик вне элемента true | false
        (element, event) => {
            let menu_burger = element.querySelectorAll("[data-burger]");
            for(let i = 0; i < menu_burger.length; i++){
                menu_burger[i].classList.toggle("active");
            }
        },
        false
    );

    




});

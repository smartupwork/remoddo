var $ = jQuery.noConflict();

$(document).ready(function () {
    $(document).on('click',"[data-spoller-btn]",function(){
        var $this = $(this);
        var parent = $this.closest('[data-spoller]');
        var dropDown = parent.find('[data-spoller-drop]');
        parent.toggleClass('active');
        dropDown.slideToggle(200);
    })

});

const searchInput = document.querySelectorAll('.input-search-window');
const baseForm = document.querySelectorAll('.input-search-form')

function clickOutsaid(e) {
    const target = e.target
    if(!target.closest('.input-search-form')){
        for(item of baseForm){
            item.classList.remove('active')
        }
    }
}

function searchWindow(e) {
    const value = e.target.value
    const parent = this.closest('.input-search-form')
    if(value.length > 0) {
        parent.classList.add('active')
    } else {
        parent.classList.remove('active')
    }
}
if(searchInput) {
    for(item of searchInput){
        item.addEventListener('input', searchWindow);
    }
}
document.addEventListener('click', clickOutsaid)



var galleryThumbs = new Swiper(".gallery-thumbs", {
    spaceBetween: 10,
    slidesPerView: 4.4,
  });
  var galleryTop = new Swiper(".gallery-top", {
    spaceBetween: 10,
    slidesPerView: 1,
    thumbs: {
      swiper: galleryThumbs,
    },
  });

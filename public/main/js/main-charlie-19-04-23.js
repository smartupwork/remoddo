var $ = jQuery.noConflict();

$(document).ready(function () {
    $(".notification-btn").click(function(){
        var $this = $(this);
        var parent = $this.closest('.notifications-wrap');
        parent.toggleClass('active');

    })
    $(document).click(function({target}){
        if(!target.closest('.notification-btn') && !target.closest('.notifications-drop-menu')){
            $('.notifications-wrap').removeClass('active');
        }
    })

})

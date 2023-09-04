let uploaded_images=[];
$(document).ready(function () {
    tippy('.main-photo', {
        content: "Main photo",
      });
    const upload_input = $('#upload-post-images');
    $('.upload').on('click', function (e) {
        e.preventDefault();
        upload_input.click()
    });

    upload_input.on('change', function () {
        const big = 'swiper-wrapper-big';
        const small = 'swiper-wrapper-small';
        if (this.files) {
            // $(`.${big}`).children().remove();
            // $(`.${small}`).children().remove();
            var filesAmount = this.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                let big_html_result = '';
                let small_html_result = '';
                reader.onload = function (event) {
                    big_html_result += `<div class="swiper-slide">
                                        <div class="swiper-slide-header">
                                            <label class="custom-checkbox main-photo">
                                                    <input type="radio" name="main-photo" class="custom-checkbox__input image-checkbox">
                                                    <span class="custom-checkbox__input-fake">
                                                </span>
                                            </label>
                                            <a href="#" class="btn radius-3 ttu image-delete" data-image-url="" data-src="${event.target.result}">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.9523 17.5031H7.04748C6.06732 17.5031 5.2524 16.7485 5.17723 15.7712L4.37256 5.31055H15.6272L14.8226 15.7712C14.7474 16.7485 13.9325 17.5031 12.9523 17.5031V17.5031Z" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M16.6695 5.31052H3.33057" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.65518 2.49695H12.3446C12.8626 2.49695 13.2825 2.91686 13.2825 3.43484V5.31062H6.71729V3.43484C6.71729 2.91686 7.13719 2.49695 7.65518 2.49695Z" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M11.6412 9.06213V13.7516" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M8.35873 9.06213V13.7516" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </a>
                                        </div>
                                            <div class="single-slider-big">
                                            <img class="product_detail_images" src="${event.target.result}" alt=""></div>
                                        </div>`

                    // $(`.${big}`).append(big_html_result);
                    galleryTop.appendSlide(big_html_result)
                    // galleryTop.update()
                    // galleryThumbs.update()

                    let big_found = {};
                    $(`.single-slider-big`).each(function (index,element) {
                        let image=$(element).children().closest('img');
                        if(big_found[image.attr('src')]){
                            $(this).closest('.swiper-slide').remove();
                        }else{
                            big_found[image.attr('src')] = true;
                        }
                    })

                    // small_html_result += `<div class="swiper-slide" >
                    //                         <div class="single-slider-small">
                    //                         <img src="${event.target.result}" alt="">
                    //                         </div>
                    //                     </div>
                    //                     `
                    small_html_result += `<div class="swiper-slide">
                                            <div class="single-slider-small">
                                                <img class="product_detail_images" src="${event.target.result}" alt="" >
                                            </div>
                                        </div>`


                    // $(`.${small}`).append(small_html_result);
                    galleryThumbs.appendSlide(small_html_result)
                    let small_found = {};
                    $(`.single-slider-small`).each(function (index,element) {
                        let image=$(element).children().closest('img');
                        if(small_found[image.attr('src')]){
                            $(this).closest('.swiper-slide').remove();
                        }else{
                            small_found[image.attr('src')] = true;
                        }
                    })
                    galleryTop.update()
                    galleryThumbs.update()

                }
                uploaded_images.push(this.files[i])
                reader.readAsDataURL(this.files[i]);
            }
        }
        $('.error-images').text("");
    })

    $(document).on('click', '.image-delete', function(e) {
        e.preventDefault();
        const src = $(this).data('src')
        const delete_image_url=$(this).data('image-url')

        if (delete_image_url.length>0){
            $.ajax({
                url:delete_image_url,
                type:'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (response){
                console.log(response,'success')
            },
            error:function (response){
                console.log(response,'error')
            },
        })
        }
        $(`.single-slider-big`).each(function (index,element) {
            let image=$(element).children().closest('img');
            if(image.attr('src') === src){
                uploaded_images=uploaded_images.filter((image,i)=>{
                    return i!==index;
                })
                $(this).closest('.swiper-slide').remove();
            }
        })
        $(`.single-slider-small`).each(function (index,element) {
            let image=$(element).children().closest('img');
            if(image.attr('src') === src){
                $(this).closest('.swiper-slide').remove();
            }
        })
        galleryThumbs.update()
        galleryTop.update()
    })


});

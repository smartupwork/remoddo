<div class="post-listing__swiper-block pb-30">
    <div class="post-listing__swiper-wrap">

        <div class="swiper gallery-top mb-20">
            <div class="swiper-wrapper swiper-wrapper-big">
                @foreach($product->images as $image)
                    <!-- <div class="swiper-slide" data-image="{{asset($image->image)}}">
                        <img class="product_detail_images" src="{{asset($image->image)}}"
                             alt="{{$product->title}}">
                    </div> -->


                                    <div class="swiper-slide" data-image="{{asset($image->image)}}">
                                        <div class="swiper-slide-header">
                                            <label class="custom-checkbox main-photo">
                                                    <input type="radio" name="main-photo" @if($image->is_main) checked @endif class="custom-checkbox__input image-checkbox">
                                                    <span class="custom-checkbox__input-fake">
                                                </span>
                                            </label>
                                            <a href="#" class="btn radius-3 ttu image-delete" data-image-url="{{route('main.post.delete-image',$image)}}" data-src="{{asset($image->image)}}">
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
                                            <img class="product_detail_images" src="{{asset($image->image)}}" alt="{{$product->title}}">
                                        </div>
                                    </div>



                @endforeach
            </div>

            <!-- Add Arrows
             <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>-->
        </div>

        <div class="swiper gallery-thumbs mb-20" thumbsSlider="">
            <div class="swiper-wrapper swiper-wrapper-small">
                @foreach($product->images as $image)
                    <div class="swiper-slide" data-image="{{asset($image->image)}}">
                        <div class="single-slider-small">
                            <img class="product_detail_images" src="{{asset($image->image)}}" alt="{{$product->title}}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <input type="file" multiple class="d-none" name="images"  id="upload-post-images">
    <a href="#" class="btn btn--warning btn--md upload radius-3 w-100 ttu">Add Photos</a>
    <span class="error error-images error-message"></span>
</div>


@push('scripts')
    <script src="{{asset('main/js/post-multiple-upload.js')}}"></script>
@endpush

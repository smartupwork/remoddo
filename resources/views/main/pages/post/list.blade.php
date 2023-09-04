@extends('main.layouts.main-singleproduct',['prev_url'=>$prev_url])
@section('wrapper_class') pt-header @endsection
@section('main_tag_class') single-page @endsection
@section('title') Post listing @endsection

@section('content')
    @if($product->categories->count()>0)
        <div class="categories_id" data-categories-id="{{$product->categories->pluck('id')->join(',')}}"></div>
    @else
        <div class="categories_id" data-categories-id=""></div>
    @endif
    <div class="container container-1010">
        <div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
            <h3 class="ttu fw-800 pe-4 mb-20"></h3>
            <div class="d-flex align-items-center flex-wrap">
                <a href="" data-url="{{$url}}" class="btn btn--warning btn--md btn-add-post radius-3 ttu mb-20">
                    <span class="fs-14">Post Listing</span>
                </a>
            </div>
        </div>
        <div class="product-column">
            <div class="d-flex single-product-column">
                @include('main.sections.pages.post.images')
                <div class="post-listing__content w-100">
                    <div class="input-wrap mb-30">
                        <label class="label-custom">Title</label>
                        <input class="input title" name="title" value="{{$product->title}}" type="text"
                               placeholder="Add title...">
                        <span class="error error-title error-message"></span>
                    </div>
                    {{-- <div class="input-wrap mb-30">
                        <label class="label-custom">Location</label>
                        <input class="input address" name="address" value="{{$product->address}}" type="text"
                               placeholder="Add Location...">
                        <span class="error error-address error-message"></span>
                    </div> --}}
                    <div class="input-wrap border-bottom pb-30 mb-30">
                        <label class="label-custom">Description</label>
                        <textarea class="input description" name="description" rows="5"
                                  placeholder="Add description...">{{$product->description}}</textarea>
                        <span class="error error-description error-message"></span>
                    </div>
                    <div class="input-colums border-bottom pb-10 mb-30">
                        <div class="input-wrap input-col-6 mb-20">
                            <label class="label-custom">Category</label>
                            <div class="popup-select category-popup mb-8" data-modal="#category">
                                <select class="select-default">
                                    <option value="">Select category</option>
                                </select>
                            </div>
                            <span class="error error-category_id error-message"></span>
                            <ul class="tag-list tag-list--categories"
                                data-delete-icon="{{asset('main/img/icons/icon-delete-tag.svg')}}">
                                @if($product->categories)
                                    @foreach($product->categories as $category)
                                        <li class="tag-item" data-tag-id="{{$category->id}}">
                                            <span class="tag tag-delete">
                                                <button class="btn">
                                                    <img src="{{asset('main/img/icons/icon-delete-tag.svg')}}">
                                                </button>
                                                <span class="info">{{$category->title}}</span>
                                            </span>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <div class="input-wrap input-col-6 mb-20">
                            <label class="label-custom">Gender</label>
                            <select class="select-default gender" name="gender">
                                <option value="">Select gender</option>
                                @foreach($genders as $value=>$key)
                                    <option value="{{$value}}"
                                            @if($product->gender==$value) selected @endif>{{$key}}</option>
                                @endforeach
                            </select>
                            <span class="error error-gender error-message"></span>
                        </div>
                        <div class="input-wrap input-col-6 mb-20">
                            <label class="label-custom">Brand</label>
                            <div class="select2-default">
                                <select class="brand_id w-100" name="brand_id">
                                   <option value="">Select type</option>
                                   @foreach($brands as $id=>$brand)
                                       <option value="{{$id}}"
                                               @if($product->brand_id==$id) selected @endif>{{$brand}}</option>
                                   @endforeach
                               </select>
                            </div>
{{--                            <input class="input brand" name="brand" value="" type="text"--}}
{{--                            placeholder="Add Brand...">--}}
                            <span class="error error-brand_id error-message"></span>
                        </div>

                        @include('main.sections.pages.post.attributes',['attributes'=>$attributes])

                    </div>

                    @include('main.sections.pages.post.tag')

                    @include('main.sections.pages.post.rent_days_table')

                    <div class="d-flex justify-content-end mb-30">
                        <a href="#" data-url="{{$url}}" class="btn btn--warning btn--md btn-add-post radius-3 ttu">Post
                            Listing</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer-popup')
    @include('main.sections.footer-popup')
@endpush
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('main/js/post-save.js')}}"></script>
    <script src="{{asset('main/js/category-search.js')}}"></script>
@endpush
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

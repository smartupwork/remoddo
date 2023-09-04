@extends('main.layouts.main')
@section('wrapper_class') pt-header @endsection

@section('title') Overview @endsection

@section('content')
        <div class="container container-xl">
            <div class="category-page">
                @include('main.sections.pages.profile.user.sidebar')
                <div class="category-page__content">
                    <div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap align-items-center">
                        <h3 class="ttu fw-900 pe-4 mb-4">Overview</h3>
                        <a href="{{route('main.post.list')}}" class="btn btn--dark btn--sm radius-3 -ttu mb-4">
                            <span class="info def-text-1">
                                Post Listing
                            </span>
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 d-flex">
                            <div class="widget-profile">
                                <div class="widget--header">
                                    <div class="widget--option">
                                        <h4 class="def-text-1 fw-800 -ttu mb-12 mr-12">
                                            Stats overview for:
                                        </h4>
                                        <div class="form-group height-34px fs-14px lh-20px mb-12">
                                            <select class="select-default product_sorting" name="range">
                                                <option value="" selected>Today</option>
                                                <option value="week" @if(request()->get('range')=='week') selected @endif>7 days ago</option>
{{--                                                <option value="12 days" @if(request()->get('range')=='12 days') selected @endif>12 days ago</option>--}}
                                                <option value="month" @if(request()->get('range')=='month') selected @endif>30 days ago</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="widget--option">
{{--                                        <a href="" class="btn btn--underline-warninng mb-12">--}}
{{--                                            <span class="fw-700 fs-14 info">--}}
{{--                                                View detailed stats--}}
{{--                                            </span>--}}
{{--                                        </a>--}}
                                    </div>
                                </div>

                                @include('main.sections.pages.profile.lender.stats.statistic')
                            </div>
                        </div>
                        @include('main.sections.pages.profile.lender.stats.chart')
                        <div class="col-lg-6 col-md-6 mt-30 d-flex">
                            <div class="widget-profile">
                                <div class="widget--header">
                                    <div class="widget--option">
                                        <h4 class="def-text-1 fw-800 -ttu mb-12 mr-12">
                                            To do list
                                        </h4>
                                    </div>
                                    <div class="widget--option">
                                        <a href="" class="btn btn--underline-warninng mb-12 todo-popup" data-modal="#todo">
                                            <span class="fw-700 fs-14 info">
                                                + Add Item
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="widget--body"> <!-- style="overflow-y: scroll;height: 300px" -->
                                    <div class="widget-element p-16" style="max-height:257px; overflow: auto;">
                                        <div class="d-flex flex-column todo-list">
                                           @foreach($todos as $todo)
                                            <label class="custom-checkbox mb-16 d-flex justify-content-between align-items-center todo-item">
                                                    <input type="checkbox" id="todo-input{{$todo->id}}"  class="custom-checkbox__input todo-input"
                                                           data-url="{{route('main.profile.user.lender.update-status',['todo'=>$todo->id])}}"
                                                           @if($todo->is_done) checked @endif>
                                                    <span class="custom-checkbox__input-fake"></span>
                                                    <label class="custom-checkbox__label flex-auto pl-14 me-3" for="todo-input{{$todo->id}}">
                                                        {{$todo->title}}
                                                    </label>
                                                <a href="#" class="btn radius-3 ttu delete-todo" data-url-delete="{{route('main.profile.user.lender.remove-todo',['todo'=>$todo])}}" id="removeTodo">
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.9523 17.5031H7.04748C6.06732 17.5031 5.2524 16.7485 5.17723 15.7712L4.37256 5.31055H15.6272L14.8226 15.7712C14.7474 16.7485 13.9325 17.5031 12.9523 17.5031V17.5031Z" stroke="#323232" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M16.6695 5.31052H3.33057" stroke="#323232" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.65518 2.49695H12.3446C12.8626 2.49695 13.2825 2.91686 13.2825 3.43484V5.31062H6.71729V3.43484C6.71729 2.91686 7.13719 2.49695 7.65518 2.49695Z" stroke="#323232" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M11.6412 9.06213V13.7516" stroke="#323232" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M8.35873 9.06213V13.7516" stroke="#323232" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </a>
                                                <!-- <div>
                                                    <a href="#" data-url-delete="{{route('main.profile.user.lender.remove-todo',['todo'=>$todo])}}" id="removeTodo">
                                                        <svg  width="8" height="8" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M13 1L1 13" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M1 1L13 13" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                </div> -->
                                            </label>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 mt-30 d-flex">
                            <div class="widget-profile">
                                <div class="widget--header">
                                    <div class="widget--option">
                                        <h4 class="def-text-1 fw-800 -ttu mb-12 mr-12">
                                            Best Performing item
{{--                                            <a href="" class="btn btn--underline-warninng">--}}
                                                <span class="fw-800 fs-14 info">
                                                    (last {{$selectedDay}})
                                                </span>
{{--                                            </a>--}}
                                        </h4>
                                    </div>
                                </div>
                                <div class="widget--body">
                                    <div class="widget-element p-16">
                                        <div class="posts-row">
                                            @foreach($bestPerforms as $product)
                                            <a href="{{route('main.product.detail',['product'=>$product->id])}}" class="post-row">
                                                <div class="wrapper-image mr-20 radius-3">
                                                    <img src="{{asset($product->image)}}" alt="{{$product->title}}"/>
                                                </div>
                                                <div class="post-info">
                                                    <h4 class="def-text-1 fw-800 -ttu opacity-04">
                                                        {{$product->brand->title}}
                                                    </h4>
                                                    <p class="mt-8 fw-600">
                                                        {{$product->title}}
                                                    </p>
                                                </div>
                                            </a>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 mt-30 d-flex">
                            <div class="widget-profile">
                                <div class="widget--header">
                                    <div class="widget--option">
                                        <h4 class="def-text-1 fw-800 -ttu mb-12 mr-12">
                                            Latest reviews
                                        </h4>
                                    </div>
                                </div>
                                <div class="widget--body">
                                    <div class="widget-element p-16">
                                        <div class="posts-row">
                                            <?php
                                            for($i = 0; $i < 3; $i++){ ?>
                                            
                                            <a href="#" class="post-row">
                                                <div class="wrapper-image mr-20 radius-3">
                                                    <img src="{{asset("main/img/images/post_row_img-$i.jpg")}}"/>
                                                </div>
                                                <div class="post-info">
                                                    <h4 class="def-text-1 fw-800 -ttu">
                                                        Jesica Smith
                                                    </h4>
                                                    <p class="mt-8 fw-600">
                                                        Item Name, Size 123
                                                    </p>
                                                </div>
                                            </a>
                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @include('main.sections.pages.overview.todo-popup')
@endsection
@push('scripts')
    <script src="{{asset('main/js/product_sorting.js')}}"></script>
    <script src="{{asset('main/js/todo-update-status.js')}}"></script>
    <script src="{{asset('main/js/todo-popup.js')}}"></script>
@endpush

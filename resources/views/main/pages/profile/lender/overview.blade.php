@extends('main.layouts.main')
@section('wrapper_class') pt-header @endsection
@if(['role'=>'lender'])
@section('title') Overview @endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    @import url(http://fonts.googleapis.com/css?family=Maven+Pro);
.tab-wrap {
	-webkit-transition: 0.3s box-shadow ease;
	transition: 0.3s box-shadow ease;
	border-radius: 6px;
	max-width: 100%;
	display: -webkit-box;
	display: -webkit-flex;
	display: -ms-flexbox;
	display: flex;
	-webkit-flex-wrap: wrap;
	  -ms-flex-wrap: wrap;
		  flex-wrap: wrap;
	position: relative;
	list-style: none;
	background-color: #fff;
	margin: 40px 0;
	/* box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24); */
}
/* .tab-wrap:hover {
	box-shadow: 0 12px 23px rgba(0, 0, 0, 0.23), 0 10px 10px rgba(0, 0, 0, 0.19);
} */

.tab {
	display: none;
}
.tab:checked:nth-of-type(1) ~ .tab__content:nth-of-type(1) {
	opacity: 1;
	-webkit-transition: 0.5s opacity ease-in, 0.2s transform ease;
	transition: 0.5s opacity ease-in, 0.2s transform ease;
	position: relative;
	top: 0;
	z-index: 100;
	-webkit-transform: translateY(0px);
		  transform: translateY(0px);
	text-shadow: 0 0 0;
}
.tab:checked:nth-of-type(2) ~ .tab__content:nth-of-type(2) {
	opacity: 1;
	-webkit-transition: 0.5s opacity ease-in, 0.2s transform ease;
	transition: 0.5s opacity ease-in, 0.2s transform ease;
	position: relative;
	top: 0;
	z-index: 100;
	-webkit-transform: translateY(0px);
		  transform: translateY(0px);
	text-shadow: 0 0 0;
}
.tab:checked:nth-of-type(3) ~ .tab__content:nth-of-type(3) {
	opacity: 1;
	-webkit-transition: 0.5s opacity ease-in, 0.2s transform ease;
	transition: 0.5s opacity ease-in, 0.2s transform ease;
	position: relative;
	top: 0;
	z-index: 100;
	-webkit-transform: translateY(0px);
		  transform: translateY(0px);
	text-shadow: 0 0 0;
}
.tab:checked:nth-of-type(4) ~ .tab__content:nth-of-type(4) {
	opacity: 1;
	-webkit-transition: 0.5s opacity ease-in, 0.2s transform ease;
	transition: 0.5s opacity ease-in, 0.2s transform ease;
	position: relative;
	top: 0;
	z-index: 100;
	-webkit-transform: translateY(0px);
		  transform: translateY(0px);
	text-shadow: 0 0 0;
}
.tab:first-of-type:not(:last-of-type) + label {
	border-top-right-radius: 0;
	border-bottom-right-radius: 0;
}
.tab:not(:first-of-type):not(:last-of-type) + label {
  border-radius: 0;
}
.tab:last-of-type:not(:first-of-type) + label {
	border-top-left-radius: 0;
	border-bottom-left-radius: 0;
}
.tab:checked + label {
	background-color: #fff;
	box-shadow: 0 -1px 0 #fff inset;
	cursor: default;
    border-bottom: 2px solid grey;
}
.tab:checked + label:hover {
	box-shadow: 0 -1px 0 #fff inset;
	background-color: #fff;
}
.tab + label {
    border-bottom: 2px solid #ccc;
	width:100%;	  
	/* box-shadow: 0 -1px 0 #eee inset; */
	border-radius: 6px 6px 0 0;
	cursor: pointer;
	display: block;
	text-decoration: none;
	color: #333;
	-webkit-box-flex: 3;
	-webkit-flex-grow: 3;
	  -ms-flex-positive: 3;
		  flex-grow: 3;
	text-align: center;
	/* background-color: #f2f2f2; */
	-webkit-user-select: none;
	 -moz-user-select: none;
	  -ms-user-select: none;
		  user-select: none;
	text-align: center;
	-webkit-transition: 0.3s background-color ease, 0.3s box-shadow ease;
	transition: 0.3s background-color ease, 0.3s box-shadow ease;
	height: 50px;
	box-sizing: border-box;
	padding: 15px;
}
@media (min-width:768px) {
		
	.tab + label {
		width:auto;
	}
}
.tab + label:hover {
	background-color: #f9f9f9;
	box-shadow: 0 1px 0 #f4f4f4 inset;
}
.tab__content {
    border: 1px solid #dfdfdf;

	padding: 10px 25px;
	background-color: transparent;
	position: absolute;
	width: 100%;
	z-index: -1;
	opacity: 0;
	left: 0;
	-webkit-transform: translateY(-3px);
		  transform: translateY(-3px);
	/* border-radius: 6px; */
    border-top:none;
	
}

/* Boring Styles */
*,
*:before,
*:after {
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
	body {
	
	padding: 30px 0;
	min-width:350px;
}
h1,
h2 {
	margin: 0;
	color: #444;
	text-align: center;
}

h2 {
	font-size: 1em;
	margin-bottom: 30px;
}

p {
	line-height: 1.6;
	margin-bottom: 20px;
}
.container {
	max-width:1150px;
	margin:0 auto;
}
.testimonial-box-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            width: 100%;
        }

        .testimonial-box {
            border-bottom: 1px solid lightgray;
            width: 100%;
            /* box-shadow: 2px 2px 30px rgba(0, 0, 0, 0.1); */
            background-color: #ffffff;
            padding: 20px;
            /* margin: 15px; */
            cursor: pointer;
        }

        .profile-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 10px;
        }

        .profile-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .profile {
            display: flex;
            align-items: center;
        }

        .name-user {
            display: flex;
            flex-direction: column;
        }

        .name-user strong {
            color: #3d3d3d;
            font-size: 2.1rem;
            letter-spacing: 0.5px;
        }

        .name-user span {
            color: #979797;
            font-size: 0.8rem;
        }

        .reviews {
            color: #f9d71c;
        }

        .box-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .client-comment p {
            padding-left: 69px;
            font-weight: 400;
            color: #4b4b4b;
        }


        @media(max-width:1060px) {
            .testimonial-box {
                width: 45%;
                padding: 10px;
            }
        }

        @media(max-width:790px) {
            .testimonial-box {
                width: 100%;
            }

            .testimonial-heading h1 {
                font-size: 1.4rem;
            }
        }

        @media(max-width:340px) {
            .box-top {
                flex-wrap: wrap;
                margin-bottom: 10px;
            }

            .reviews {
                margin-top: 10px;
            }
        }

        ::selection {
            color: #ffffff;
            background-color: #252525;
        }

</style>
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
                                    <div class="widget-element p-16" style="padding: 97px;">
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
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-6 mt-30 d-flex">
                            <div class="widget-profile">
                                <div class="widget--header">
                                    <div class="widget--option">
                                        <h4 class="def-text-1 fw-800 -ttu mb-12 mr-12" >
                                            Reviews
                                        </h4>
                                    </div>
                                </div>
                                <div class="widget--body">
                                    <div class="widget-element p-16" style="border:none;">
                                        <div class="tab-wrap">
		
                                            <input type="radio" id="tab1" name="tabGroup1" class="tab" checked style="display:none;">
                                            <label for="tab1">Rented</label>
                                
                                            <input type="radio" id="tab2" name="tabGroup1" class="tab" style="display:none;">
                                            <label for="tab2">Lend</label>
                                
                                            <div class="tab__content">
                                                <div class="testimonial-box">
                                                    <div class="box-top">
                                                        <div class="profile">
                                                            <div class="profile-img">
                                                                <img src="" alt="User Image">
                                                            </div>
                                                            <div class="name-user">
                                                                <strong>John Honk</strong>
                                                            </div>
                                                        </div>
                                                        <div class="reviews">
                                                            {{-- @php
                                                                $starRating = $feed->star_rating; // Get the star rating from the review
                                                            @endphp --}}
                                    
                                                            {{-- @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $starRating) --}}
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                {{-- @else --}}
                                                                {{-- @endif
                                                            @endfor --}}
                                                        </div>
                                                    </div>
                                                    <div class="client-comment">
                                                        <p>Renter Review</p>
                                                    </div>
                                                </div>
                                                                                              
                                                <div class="testimonial-box">
                                                    <div class="box-top">
                                                        <div class="profile">
                                                            <div class="profile-img">
                                                                <img src="" alt="User Image">
                                                            </div>
                                                            <div class="name-user">
                                                                <strong>John Honk</strong>
                                                            </div>
                                                        </div>
                                                        <div class="reviews">
                                                            {{-- @php
                                                                $starRating = $feed->star_rating; // Get the star rating from the review
                                                            @endphp --}}
                                    
                                                            {{-- @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $starRating) --}}
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                {{-- @else --}}
                                                                    <i class="fa fa-star-o"></i>
                                                                {{-- @endif
                                                            @endfor --}}
                                                        </div>
                                                    </div>
                                                    <div class="client-comment">
                                                        <p>Renter Review</p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="tab__content">
                                                <div class="testimonial-box">
                                                    <div class="box-top">
                                                        <div class="profile">
                                                            <div class="profile-img">
                                                                <img src="" alt="User Image">
                                                            </div>
                                                            <div class="name-user">
                                                                <strong>John Honk</strong>
                                                            </div>
                                                        </div>
                                                        <div class="reviews">
                                                            {{-- @php
                                                                $starRating = $feed->star_rating; // Get the star rating from the review
                                                            @endphp --}}
                                    
                                                            {{-- @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $starRating) --}}
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                {{-- @else --}}
                                                                    <i class="fa fa-star-o"></i>
                                                                {{-- @endif
                                                            @endfor --}}
                                                        </div>
                                                    </div>
                                                    <div class="client-comment">
                                                        <p>Lender review</p>
                                                    </div>
                                                </div>
                                            </div>
                                
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
@endif
@push('scripts')
    <script src="{{asset('main/js/product_sorting.js')}}"></script>
    <script src="{{asset('main/js/todo-update-status.js')}}"></script>
    <script src="{{asset('main/js/todo-popup.js')}}"></script>
@endpush

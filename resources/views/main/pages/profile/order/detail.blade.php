@extends('main.layouts.main')
@section('wrapper_class') pt-header @endsection

@section('title',"Order $order->id")


@section('content')
    <div class="container container-xl">
        <div class="category-page">
            @include('main.sections.pages.profile.user.sidebar')
            <div class="category-page__content">
                <div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
                    <a href="{{route('main.profile.lender.lending') }}"
                       class="btn btn--dark btn--md radius-3 ttu mb-4 me-3">
                            <span class="btn-ico w-20">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.6663 6.66675L8.33301 10.0001L11.6663 13.3334" stroke="white"
                                          stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        <span class="fs-14 ms-3">Back</span>
                    </a>
                    <div class="d-flex align-items-center flex-wrap">
                        @if(auth()->id()==$order->lender_id && $order->status==\App\Enums\OrderStatus::SHIPPED_BACK)
                        <a href="{{route('main.profile.lender.confirm-ship',$order)}}" class="btn btn--warning btn--md radius-3 ttu mb-4 me-3">
                            <span class="info">Confirm postal code receipt</span>
                        </a>
                        @endif
                        <a href="{{route('main.profile.lender.order-print',$order)}}"
                           class="btn btn--dark btn--md radius-3 ttu mb-4 me-3">
                            <span class="fs-14">Print Invoice</span>
                            <span class="btn-ico ms-3 w-20">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5.5 7.5V4.16667C5.5 3.24619 6.24619 2.5 7.16667 2.5H12.8333C13.7538 2.5 14.5 3.24619 14.5 4.16667V7.5"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"/>
                                        <rect x="5.5" y="11.5" width="9" height="6" rx="1" stroke="white"
                                              stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path
                                            d="M5.5 15H4.70492C3.86431 15 3.09585 14.5251 2.71992 13.7732V13.7732C2.57528 13.4839 2.49999 13.165 2.5 12.8415V9.16667C2.5 8.24619 3.24619 7.5 4.16667 7.5H15.8333C16.7538 7.5 17.5 8.24619 17.5 9.16667V12.7432C17.5 13.1313 17.4096 13.5141 17.2361 13.8612V13.8612C16.8871 14.5591 16.1738 15 15.3934 15H14.5"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"/>
                                    </svg>
                                </span>
                        </a>
                        @if(auth()->id()==$order->lender_id && $order->status==\App\Enums\OrderStatus::CONFIRM_SHIPPED_BACK)
                            <a href="{{route('main.profile.lender.completed',$order)}}"
                               class="btn btn--dark btn--md radius-3 ttu mb-4 me-3">
                                <span class="fs-14">Finish Order</span>
                                {{--                            <span class="btn-ico ms-3 w-20">--}}
                                {{--                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
                                {{--                                        <path d="M13.3337 15.3807V11.0417" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
                                {{--                                        <path d="M6.66667 15.386V11.0417" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
                                {{--                                        <path d="M4.23609 6.66675L2.90461 7.46566C2.6536 7.61625 2.50001 7.88751 2.5 8.18023V16.2366C2.49999 16.5368 2.66148 16.8138 2.92273 16.9617C3.18398 17.1097 3.50461 17.1056 3.76206 16.9512L6.18617 15.4967C6.4767 15.3224 6.84387 15.3413 7.11492 15.5447L9.5 17.3334C9.79629 17.5557 10.2037 17.5557 10.5 17.3334L12.8851 15.5446C13.1561 15.3413 13.5233 15.3224 13.8138 15.4967L16.238 16.9512C16.4954 17.1056 16.816 17.1097 17.0773 16.9617C17.3385 16.8138 17.5 16.5368 17.5 16.2366V8.18023C17.5 7.88751 17.3464 7.61625 17.0954 7.46565L15.7639 6.66675" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
                                {{--                                        <path d="M9.99967 12.7083V17.4986" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
                                {{--                                        <path d="M6.66699 5.00008V5.00008C6.66699 3.15913 8.15938 1.66675 10.0003 1.66675V1.66675C11.8413 1.66675 13.3337 3.15913 13.3337 5.00008V5.00008" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
                                {{--                                        <path d="M6.66699 5C6.66699 6.50547 8.32808 8.11238 9.30497 8.92757C9.71323 9.24622 10.2859 9.24637 10.6943 8.92792C11.6721 8.11287 13.3337 6.50571 13.3337 5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
                                {{--                                        <path d="M10.0005 4.69906C10.1155 4.69952 10.2083 4.793 10.208 4.90795C10.2077 5.0229 10.1143 5.11588 9.9994 5.11573C9.88445 5.11557 9.79134 5.02235 9.79134 4.90739C9.79105 4.85191 9.81302 4.79862 9.85233 4.75946C9.89165 4.7203 9.94502 4.69855 10.0005 4.69906" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
                                {{--                                    </svg>--}}
                                {{--                                </span>--}}
                            </a>
                        @endif
                    </div>
                </div>
                <div class="border-card order-details">

                    <h3 class="fw-800 fs-24 ttu mb-24">Order Details</h3>
                    <div class="order-details__item">
                        <span class="order-details__item-title">Order number</span>
                        <span class="order-details__item-info">#{{$order->id}}</span>
                    </div>
                    <div class="order-details__item mb-20 pb-10 border-bottom">
                        <span class="order-details__item-title">Order Date</span>
                        <span class="order-details__item-info">{{$order->start_date}}</span>
                    </div>
                    <div class="order-details__item">
                        <span class="order-details__item-title">Item</span>
                        <div class="order-details__item-info d-flex align-items-center">
                            <span class="">{{$order->product->title}}</span>
                            <div class="ml-14">
                                <div class="sm_square_image">
                                    <img src="{{$order->product->image}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-details__item">
                        <span class="order-details__item-title">Rental price paid</span>
                        <span class="order-details__item-info">£{{$order->total_price_without_fee}}</span>
                    </div>
                    <li class="detail-item">
                        <span class="detail-info mb-10 fw-800 ttu">Late dispatch Fee</span>
                        <span class="detail-info mb-10 fw-600">
                            @if($order->late_dispatch_fee>0)
                                @if(auth()->id()==$order->renter_id)
                                    -£{{$order->late_dispatch_fee}}
                                @else
                                    £{{$order->late_dispatch_fee}}
                                @endif
                            @else
                                £0
                            @endif
                                        </span>
                    </li>
                    <li class="detail-item">
                        <span class="detail-info mb-10 fw-800 ttu">Total</span>
                        <span class="detail-info mb-10 fw-800">
                            @if($order->payed_price>0)
                                £{{$order->payed_price}}
                            @else
                                -£{{$order->payed_price*-1}}
                            @endif

                                        </span>
                    </li>
                    <div class="order-details__item">
                        <span class="order-details__item-title">Rental period</span>
                        <span class="order-details__item-info">{{$order->rent->day}}</span>
                    </div>
                    <div class="order-details__item mb-20 pb-10 border-bottom">
                        <span class="order-details__item-title">Return date</span>
                        <span class="order-details__item-info">{{$order->exp_date}}</span>
                    </div>
                    <div class="order-details__item">
                        <span class="order-details__item-title">Lender name</span>
                        <span class="order-details__item-info">{{$order->lender->info->name}}</span>
                    </div>
                    <div class="order-details__item">
                        <span class="order-details__item-title">Lender Address</span>
                        <span class="order-details__item-info">{{$order->product->address}}</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@extends('main.layouts.main')
@section('wrapper_class')
    pt-header
@endsection

@section('title','Chat')

@section('content')
    <div class="container container-xl">
        <div class="message-wrapper">
            <div class="swiper messages-swiper">
                <div class="messages swiper-wrapper">
                    <aside class="messages-aside messages-chatlist swiper-slide--no-swipe swiper-slide">
                        <div class="messages-chatlist__header">
                            <form class="input-search-form w-100">
                                <label class="relative">
                                    <input type="text" class="input-search-window w-100 search-chat"
                                           data-search-url="{{route('main.profile.chat.search')}}"
                                           placeholder="Search messages...">
                                    <button type="submit" class="form-search__btn">
                                        <img src="{{asset('main/img/icons/icon-search.svg')}}">
                                    </button>
                                </label>
                                <ul class="search-window">
                                </ul>
                            </form>
                        </div>
                        <div class="messages-chatlist__body">
                                @foreach($chats as $chat)
                                    @if($chat->last_message)
                                        <a href="{{route('main.profile.chat.edit',['order'=>$chat->order_id])}}"
                                           class="messages-chatlist__item to-messages">
                                            <div class="messages-chatlist__avatar user-avatar-wrpr mr-12">
                                                <img src="{{$chat->last_message->user->info->avatar}}" alt="">
                                            </div>
                                            <div class="d-flex flex-column justify-content-between flex-auto">
                                                <div class="d-flex justify-content-between">
                                            <span
                                                class="messages-chatlist__name">{{$chat->last_message->user->info->full_name}}</span>
                                                    <span
                                                        class="messages-chatlist__time">{{$chat->last_message->hour}}</span>
                                                </div>
                                                <p class="messages-chatlist__message ellipsis">
                                                    {{$chat->last_message->message}}
                                                </p>
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                        </div>
                    </aside>
{{--                    <div class="messages-chat swiper-slide" id="messages">--}}
{{--                        <div class="d-flex justify-content-between w-100 d-lg-none">--}}
{{--                                <span class="h-40 w-40 to-chatlist">--}}
{{--                                    <img src="img/icons/arrow-slider-prev.svg" alt="">--}}
{{--                                </span>--}}
{{--                            <!-- <span class="h-40 w-40 to-messages">--}}
{{--                                <img src="img/icons/arrow-slider-next.svg" alt="">--}}
{{--                            </span> -->--}}
{{--                        </div>--}}
{{--                        <div class="messages-chat__body">--}}
{{--                            <div class="messages-chat__message messages-chat__message--res">--}}
{{--                                <div class="messages-chat__avatar user-avatar-wrpr mr-12">--}}
{{--                                    <img src="./img/images/user-avatar-2.png" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="messages-chat__cloud">--}}
{{--                                    <div class="d-flex justify-content-between mb-3">--}}
{{--                                        <span class="messages-chat__name">Name Surname</span>--}}
{{--                                        <span class="messages-chat__time">3:27 AM</span>--}}
{{--                                    </div>--}}
{{--                                    <p>--}}
{{--                                        Lorem ipsum dolor sit amet consectetur.--}}
{{--                                        Pulvinar ullamcorper ut sed faucibus in.--}}
{{--                                        Aliquam quis vitae at ut commodo sed--}}
{{--                                        pharetra risus sed. A sem senectus congue--}}
{{--                                        ultrices nec viverra nisl. Eu nullam turpis--}}
{{--                                        libero euismod. Odio aliquam dis mattis pulvinar.--}}
{{--                                        Massa condimentum egestas gravida ut scelerisque--}}
{{--                                        mus ultricies adipiscing libero. Egestas purus erat sed vehicula.--}}
{{--                                    </p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="messages-chat__message messages-chat__message--req">--}}
{{--                                <div class="messages-chat__cloud">--}}
{{--                                    <div class="d-flex justify-content-between mb-3">--}}
{{--                                        <span class="messages-chat__name">Jane Smith</span>--}}
{{--                                        <span class="messages-chat__time">3:27 AM</span>--}}
{{--                                    </div>--}}
{{--                                    <p>--}}
{{--                                        Lorem ipsum dolor sit amet consectetur.--}}
{{--                                        Pulvinar ullamcorper ut sed faucibus in.--}}
{{--                                        Aliquam quis vitae at ut commodo sed pharetra--}}
{{--                                        risus sed. A sem senectus congue ultrices nec viverra nisl.--}}
{{--                                    </p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="messages-chat__footer">--}}
{{--                            <div class="input-wrap mr-12 d-flex flex-auto">--}}
{{--                                <textarea class="input chat-input" placeholder="Your message..."--}}
{{--                                          style="resize: none; height: 40px;"></textarea>--}}
{{--                            </div>--}}
{{--                            <a href="#" class="btn btn--warning btn--sm radius-3 ttu uppercase send_btn">Send</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="messages-chat swiper-slide" id="messages" data-user-id="{{auth()->user()->id}}">
                        <div class="d-flex justify-content-between w-100 d-lg-none">
                                <span class="h-40 w-40 to-chatlist">
                                    <img src="{{asset('main/img/icons/arrow-slider-prev.svg')}}" alt="">
                                </span>
                            <!-- <span class="h-40 w-40 to-messages">
                                <img src="img/icons/arrow-slider-next.svg" alt="">
                            </span> -->
                        </div>

                        <div class="messages-chat__body">
                            @if($selected_chat)
                                @foreach($selected_chat->messages as $message)
                                    @if($message->user_id!==auth()->user()->id)
                                        <div class="messages-chat__message messages-chat__message--res">
                                            <div class="messages-chat__avatar user-avatar-wrpr mr-12">
                                                <img src="{{$message->user->info->avatar}}" alt="">
                                            </div>
                                            <div class="messages-chat__cloud">
                                                <div class="d-flex justify-content-between mb-3">
                                                <span
                                                    class="messages-chat__name">{{$message->user->info->full_name}}</span>
                                                    <span class="messages-chat__time">{{$message->hour}}</span>
                                                </div>
                                                <p>
                                                    {{$message->message}}
                                                </p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="messages-chat__message messages-chat__message--req">
                                            <div class="messages-chat__cloud">
                                                <div class="d-flex justify-content-between mb-3">
                                                <span
                                                    class="messages-chat__name">{{$message->user->info->full_name}}</span>
                                                    <span class="messages-chat__time">{{$message->hour}}</span>
                                                </div>
                                                <p>
                                                    {{$message->message}}
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        @if($order)
                            <div class="messages-chat__footer">
                                <div class="input-wrap mr-12 d-flex flex-auto">
                                    <input type="text" class="input message-input" placeholder="Your message...">
                                </div>
                                <a data-key="{{$pusher_key}}" data-order-id="{{$order->id}}" data-url="{{route('main.profile.chat.store',$order)}}"
                                   href="#" class="btn btn--warning btn--sm radius-3 ttu uppercase send_btn">Send</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <aside class="messages-aside messages-sidebar">
                @if($renter)
                    <a href="" class="btn sidebar-open d-lg-none">
                        <div class="user_avatar_wrpr">
                            <img src="{{$renter->info->avatar}}" alt="">
                        </div>
                    </a>
                    <a href="" class="btn sidebar-close  d-lg-none"><img
                            src="{{asset('main/img/icons/icon-close.svg')}}"></a>
                    <div class="messages-sidebar__header">
                        <div class="messages-sidebar__avatar user-avatar-wrpr mr-12">
                            <img src="{{$renter->info->avatar}}" alt="">
                        </div>
                        <h5 class="messages-sidebar__name">
                            {{$renter->info->full_name}}
                        </h5>
                    </div>
                    <div class="messages-sidebar__body">
                        <h5 class="mb-3">Rented Clothes</h5>
                        <div class="row gutters-15">

                            <div class="col-4">
                                <div class="messages-sidebar__item">
                                    <img src="{{$order->product->image}}" alt="">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="message-sidebar__footer">
                        @if($order && in_array($order->status,['canceled','failed']))
                            <a href="{{route('main.profile.chat.delete',$order)}}"
                               class="btn btn--outline btn--sm radius-3 ttu uppercase w-100">Delete Chat</a>
                        @endif
                    </div>
                @endif
            </aside>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="{{asset('main/js/chat-list.js')}}"></script>
@endpush

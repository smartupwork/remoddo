@extends('main.layouts.main-support-agent')
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
                                           data-search-url="{{route('main.profile.chat.dispute-search')}}"
                                           placeholder="Search messages...">
                                    <button type="submit" class="form-search__btn">
                                        <img src="{{asset('main/img/icons/icon-search.svg')}}">
                                    </button>
                                </label>
                                <ul class="search-window">
                                </ul>
                            </form>
                        </div>
                        <div class="messages-chatlist__body" id="chat_group_list">
                            @if($chats->count() > 0)
                            @foreach($chats as $chat)
                                    <a href="{{route('support.chatsProblems',['chat'=>$chat->id])}}"
                                       class="messages-chatlist__item to-messages">
                                        <div class="messages-chatlist__avatar user-avatar-wrpr mr-12">
                                            <img src="{{$chat->last_message->opposite_side_user->info->avatar}}" alt="">
                                        </div>
                                        <div class="d-flex flex-column justify-content-between flex-auto">
                                            <div class="d-flex justify-content-between">
                                            <span
                                                class="messages-chatlist__name">{{$chat->last_message->opposite_side_user->info->full_name}}</span>
                                                <span
                                                    class="messages-chatlist__time">{{$chat->last_message->hour}}</span>
                                            </div>
                                            <p class="messages-chatlist__message ellipsis">
                                                @if($chat->last_message->recipient_id!==auth()->id())
                                                    You:{{$chat->last_message->message}}
                                                @else
                                                    {{$chat->last_message->message}}
                                                @endif
                                            </p>
                                        </div>
                                    </a>
                            @endforeach
                            @endif
                        </div>
                    </aside>
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
                                    @if($message->type == \App\Enums\ConversationType::CHAT)
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
                                    @else
                                        <div class="messages-chat__message messages-chat__message--res bot-answer">
                                            <div class="messages-chat__avatar user-avatar-wrpr mr-12">
                                                <img src="{{asset('main/img/headphones-support-chat.svg')}}" alt="">
                                            </div>
                                            <div class="messages-chat__cloud">
                                                <div class="d-flex justify-content-between mb-3">
                                                    <span class="messages-chat__name">{{$message->disputes->first()->pivot->full_name_agent}} <span class="pill btn--warning radius-300 fs-12 ms-3">Support Manager</span></span>
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
                        <div class="messages-chat__footer">
                            <div class="input-wrap mr-12 d-flex flex-auto">
{{--                                <input type="text" class="input message-input" placeholder="Your message...">--}}
                                <textarea class="input chat-input message-input" placeholder="Your message..." style="resize: none; height: 40px;"></textarea>
                            </div>
                            @if($selected_chat)
                            <a data-key="{{$pusher_key}}" data-order-id="{{$selected_chat->order->id}}" data-url="{{route('main.profile.chat.store',$selected_chat->order)}}"
                               href="#" class="btn btn--warning btn--sm radius-3 ttu uppercase send_btn">Send</a>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            <aside class="messages-aside messages-sidebar">
                @if($selected_chat)
                    <a href="" class="btn sidebar-open d-lg-none">
                        <div class="user_avatar_wrpr">
                            <img src="{{$selected_chat->order->renter->info->avatar}}" alt="">
                        </div>
                    </a>
                    <a href="" class="btn sidebar-close  d-lg-none"><img
                            src="{{asset('main/img/icons/icon-close.svg')}}"></a>
                    <div class="messages-sidebar__header">
                        <div class="messages-sidebar__avatar user-avatar-wrpr mr-12">
                            <img src="{{$selected_chat->order->renter->info->avatar}}" alt="">
                        </div>
                        <h5 class="messages-sidebar__name">
                            {{$selected_chat->order->renter->info->full_name}}
                        </h5>
                    </div>
                    <div class="messages-sidebar__body">
                        <h5 class="mb-3">Rented Clothes</h5>
                        <div class="row gutters-15">

                            <div class="col-4">
                                <div class="messages-sidebar__item">
                                    <img src="{{$selected_chat->order->product->image}}" alt="">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="message-sidebar__footer">
{{--                        <a href="" class="btn btn--outline btn--sm radius-3 ttu uppercase w-100 mb-12" data-modal="#open-dispute">--}}
{{--                            <span class="d-flex me-4">--}}
{{--                                <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M18.0031 10C18.0031 14.1439 14.6439 17.5031 10.5 17.5031" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>--}}
{{--                                    <path d="M2.99658 10C2.99658 5.85615 6.35585 2.49689 10.4997 2.49689" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>--}}
{{--                                    <path d="M2.99658 9.99999C2.9967 10.8789 3.15302 11.7507 3.45824 12.5749C3.59783 12.9577 3.99139 13.1856 4.39288 13.1163L5.21505 12.9713C5.87955 12.8542 6.33127 12.2309 6.23585 11.563L5.98839 9.8308C5.94049 9.49547 5.75859 9.19393 5.48433 8.99514C5.21006 8.79635 4.86688 8.71733 4.5333 8.77614L3.06553 9.03494" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>--}}
{{--                                    <path d="M18.0031 10C18.0031 5.85615 14.6439 2.49689 10.5 2.49689" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>--}}
{{--                                    <path d="M18.003 9.99999C18.0028 10.8789 17.8465 11.7507 17.5413 12.5749C17.4017 12.9577 17.0081 13.1856 16.6067 13.1163L15.7845 12.9713C15.12 12.8542 14.6683 12.2309 14.7637 11.563L15.0111 9.8308C15.0591 9.49547 15.2409 9.19393 15.5152 8.99514C15.7895 8.79635 16.1327 8.71733 16.4662 8.77614L17.934 9.03494" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>--}}
{{--                                    <path d="M11.744 10.4093C11.7415 10.4093 11.7392 10.4108 11.7382 10.4132C11.7373 10.4155 11.7378 10.4182 11.7396 10.42C11.7414 10.4217 11.744 10.4223 11.7464 10.4213C11.7487 10.4204 11.7502 10.4181 11.7502 10.4156C11.7503 10.4139 11.7497 10.4122 11.7485 10.411C11.7473 10.4099 11.7457 10.4092 11.744 10.4093" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>--}}
{{--                                    <path d="M9.25571 10.4118C9.25318 10.4118 9.25091 10.4134 9.24995 10.4157C9.24898 10.418 9.24952 10.4207 9.2513 10.4225C9.25308 10.4243 9.25576 10.4248 9.25809 10.4238C9.26042 10.4229 9.26193 10.4206 9.26193 10.4181C9.26204 10.4164 9.26142 10.4147 9.26023 10.4135C9.25904 10.4123 9.25738 10.4117 9.25571 10.4118" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>--}}
{{--                                </svg>--}}
{{--                            </span>--}}
{{--                            Open Dispute--}}
{{--                        </a>--}}
{{--                        @if($selected_chat->order && in_array($selected_chat->order->status,['canceled','failed']))--}}
{{--                            <a href="{{route('main.profile.chat.delete',$order)}}"--}}
{{--                               class="btn btn--outline btn--sm radius-3 ttu uppercase w-100">Delete Chat</a>--}}
{{--                        @endif--}}
                    </div>
                @endif
            </aside>
        </div>
    </div>
{{--    @include('main.pages.profile.chat.popup.dispute-popup')--}}
@endsection
@push('scripts')
    <script src="{{asset('main/js/chat-list.js')}}"></script>
{{--    <script src="{{asset('main/js/dispute.js')}}"></script>--}}
@endpush

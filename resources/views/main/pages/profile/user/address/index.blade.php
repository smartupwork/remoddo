@extends('main.layouts.main')
@section('wrapper_class') pt-header @endsection

@section('title') Address Book @endsection

@section('content')

    <div class="container container-xl">
        <div class="category-page">
            @include('main.sections.pages.profile.user.sidebar')
            <div class="category-page__content">
                <div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
                    <h3 class="ttu fw-800 pe-4 mb-4">Address Book</h3>
                    <div class="d-flex align-items-center flex-wrap">
                        <a href="#" data-url="{{$url}}"
                           class="btn btn--dark btn--sm -ttu radius-3 mb-20 mr-10 add-address"
                           data-modal="#add-address">
                            <span class="info">Add Address</span>
                        </a>
                    </div>
                </div>
                @if($addresses->count())
                    <div class="table-wrapper">
                        <table class="table table-stick">
                            <thead class="fsz-12">
                            <tr>
                                <th class="text-start">
                                    Name
                                </th>
                                <th class="text-start w-100">
                                    address
                                </th>
                                <th class="text-start">
                                    Phone
                                </th>
                                <th class="text-start">
                                    Status
                                </th>
                                <th class="text-start">
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($addresses as $address)
                                <tr>
                                    <td>
                                        {{$address->name}}
                                    </td>
                                    <td>
                                        {{$address->location}}
                                    </td>
                                    <td>
                                        {{$address->phone}}
                                    </td>
                                    <td class="text-center">
                                        @if($address->is_main)
                                            <span class="pill btn--warning radius-3">Main Address</span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown dropdown__action" data-dropdown="dropdown"
                                             data-position="bottom-end">
                                            <button class="btn btn--dark btn--sm radius-3 ttu" data-role="button">
                                                <span class="dropdown-text-btn mr-8">Actions</span>
                                                <span class="dropdown-arrow">
                                                    <img src="{{asset('main/img/icons/select-arrow-white.svg')}}">
                                                </span>
                                            </button>
                                            <div class="dropdown__body dropdown__action" data-role="dropdown">
                                                <ul class="dropdown__action-list">
                                                    <li class="dropdown__item">
                                                        <a data-modal="#add-address"
                                                           href="{{route('main.profile.user.address.edit',['address'=>$address->id])}}"
                                                           class="dropdown__action-item edit-address">Edit</a>
                                                    </li>
                                                    <li class="dropdown__item">
                                                        <a href="{{route('main.profile.user.address.destroy',['address'=>$address->id])}}" class="dropdown__action-item delete-data-btn"
                                                           data-modal="#data-delete"
                                                        >Delete
                                                        </a>

                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div>
                        <h4 class="error-message">NOT FOUND</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(function () {
                $('.dropdown__action').on('click',function (e) {
                    e.preventDefault();
                    if ($(this).hasClass('dropdown-open')){
                        $(this).removeClass('dropdown-open')
                        $(this).children().closest('.dropdown__body').removeClass('is-open')
                    }else{
                        $(this).addClass('dropdown-open')
                        $(this).children().closest('.dropdown__body').addClass('is-open')
                    }
                })
            })
        });
    </script>
    @include('main.sections.pages.address.popup')
    @include('components.main.common.popup_delete')
@endsection
@push('scripts')
    <script src="{{asset('main/js/address-popup.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('main/js/delete-popup.js')}}"></script>
@endpush

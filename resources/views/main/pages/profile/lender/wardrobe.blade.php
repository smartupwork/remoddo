@extends('main.layouts.main')
@section('wrapper_class')
    pt-header
@endsection
@section('title') My Wardrobe @endsection

@section('content')

    <main class="content ">
        <div class="container container-xl">
            <div class="category-page">
                @include('main.sections.pages.profile.user.sidebar')
                <div class="category-page__content">
                    <div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
                        <h3 class="ttu fw-800 pe-4 mb-4">My Wardrobe</h3>
                        <div class="d-flex align-items-center flex-wrap">
                            <a href="{{route('main.post.list')}}"
                               class="btn btn--warning btn--md radius-3 ttu mb-4 me-3">
                                <span class="info">+ Add New Item</span>
                            </a>
                            @include('main.sections.pages.wardrobe.sorting')
                        </div>
                    </div>
                    @if($products->count())
                        <div class="table-wrapper">
                            <table class="table table-stick">
                                <thead class="fsz-12">
                                <tr>
                                    <th class="text-start">
                                        Item Id
                                    </th>
                                    <th class="text-start">
                                        Name
                                    </th>

                                    <th class="text-start" style="width: 30%">
                                        Status
                                    </th>
                                    <th class="text-start">
                                        Date
                                    </th>
                                    <th class="text-start" style="width: 10px">
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>
                                            #{{$product->id}}
                                        </td>
                                        <td>
                                            <div class="item-name-group">
                                                <div class="sm_square_image mr-12">
                                                    <img src="{{asset($product->image)}}">
                                                </div>
                                                <span class="ws-nowrap fw-600 pl-12"> {{$product->title}}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @if($product->status=='active' && !$product->is_not_available)
                                                @php
                                                    $status_title='HIDE'
                                                @endphp
                                                <span class="pill btn--green radius-3">Active</span>
                                            @else
                                                @php
                                                    $status_title='ACTIVE'
                                                @endphp
                                                <span class="pill btn--warning radius-3">Hide</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="fw-600">{{$product->craeted_at}}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                @if(!$product->is_not_available)
                                                    <a href="{{route('main.profile.lender.wardrobe.is-not-available',$product)}}"
                                                       class="btn btn--outline p-7 fs-14 radius-3 ttu mr-10">Not Available</a>
                                                @else
                                                    <a href="{{route('main.profile.lender.wardrobe.is-not-available',$product)}}"
                                                       class="btn btn--outline p-7 fs-14 radius-3 ttu mr-10">Available</a>
                                                @endif
                                                <a href="{{route('main.profile.lender.wardrobe.edit',$product)}}"
                                                   class="btn btn--outline p-7 fs-14 radius-3 ttu mr-10">Edit</a>


                                                <a href="{{route('main.profile.lender.wardrobe.update-status',$product)}}"
                                                   class="btn btn--outline p-7 fs-14 radius-3 ttu mr-10">{{$status_title}}</a>
                                                <a href="{{route('main.profile.lender.wardrobe.destroy',$product)}}"
                                                   data-modal="#data-delete"
                                                   class="btn btn--outline p-7 radius-3 ttu delete-data-btn">
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                              d="M12.9523 17.5031H7.04748C6.06732 17.5031 5.2524 16.7485 5.17723 15.7712L4.37256 5.31055H15.6272L14.8226 15.7712C14.7474 16.7485 13.9325 17.5031 12.9523 17.5031V17.5031Z"
                                                              stroke="#323232" stroke-width="1.5" stroke-linecap="round"
                                                              stroke-linejoin="round"/>
                                                        <path d="M16.6695 5.31052H3.33057" stroke="#323232"
                                                              stroke-width="1.5" stroke-linecap="round"
                                                              stroke-linejoin="round"/>
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                              d="M7.65518 2.49695H12.3446C12.8626 2.49695 13.2825 2.91686 13.2825 3.43484V5.31062H6.71729V3.43484C6.71729 2.91686 7.13719 2.49695 7.65518 2.49695Z"
                                                              stroke="#323232" stroke-width="1.5" stroke-linecap="round"
                                                              stroke-linejoin="round"/>
                                                        <path d="M11.6412 9.06213V13.7516" stroke="#323232"
                                                              stroke-width="1.5" stroke-linecap="round"
                                                              stroke-linejoin="round"/>
                                                        <path d="M8.35873 9.06213V13.7516" stroke="#323232"
                                                              stroke-width="1.5" stroke-linecap="round"
                                                              stroke-linejoin="round"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$products->links('vendor.pagination.main.remodo')}}
                    @else
                        <div>
                            <h4 class="error-message">NOT FOUND</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
    @include('components.main.common.popup_delete')
@endsection
@push('scripts')
    <script src="{{asset('main/js/product_sorting.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('main/js/delete-popup.js')}}"></script>
@endpush

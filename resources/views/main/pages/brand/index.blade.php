@extends('main.layouts.main')
@section('title','Brands')
@section('wrapper_class')
    pt-header
@endsection
@section('content')
    <div class="container container-xl">
        <div class="category-page">
            <div class="category-page__content d-flex flex-column mw-100">
                <div class="brand-header">
                    <div class="mw-350">
                        <form class="input-search-form w-100">
                            <label class="relative">
                                <input type="text" data-url="{{route('main.brand.search')}}" class="input-search-window w-100 brand-search" placeholder="Search for brand...">
                                <button type="submit" class="form-search__btn">
                                    <img src="{{asset('main/img/icons/icon-search.svg')}}">
                                </button>
                            </label>
                            <ul class="search-window brand-search-window">

                            </ul>
                        </form>
                    </div>
                    <div class="brand-heading">
                        <h3 class="ttu fw-900">
                            Brands
                        </h3>
                    </div>
                </div>

                <div class="brand-body mt-16">

                    <div class="search-panel">
                        <div class="search-panel--head">
                            <ul class="search--list">
                                <?php
                                for($i = 0; $i < count($filter_list); $i++){
                                $str_attr = str_replace(" ", '', $filter_list[$i]);
                                ?>
                                <li class="search--item">
                                    <?php if($i == 0){ ?>
                                    <a href="#filter-<?php echo $str_attr; ?>" class="search--link"
                                       data-filter="filter-<?php echo $str_attr; ?>">
                                                <span class="info">
                                                    <?php echo $filter_list[$i]; ?>
                                                </span>
                                    </a>
                                    <?php }else{ ?>
                                    <a href="#filter-<?php echo $str_attr; ?>" class="search--link"
                                       data-filter="filter-<?php echo $str_attr; ?>">
                                                <span class="info">
                                                    <?php echo $filter_list[$i]; ?>
                                                </span>
                                    </a>
                                    <?php } ?>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="search-panel--body">
                            <ul class="search-find">
                                <?php
                                for($j = 0; $j < count($filter_list); $j++){
                                $str_attr = str_replace(" ", '', $filter_list[$j]);
                                ?>
                                <li class="find-item" id="filter-<?php echo $str_attr; ?>">
                                    <div class="find-item--head"><?php echo $filter_list[$j]; ?></div>
                                    <div class="find-item--body">
                                        <div class="custom-columns custom-columns--16">
                                            @foreach(array_chunk($brand_list[$str_attr],7) as $brands)
                                            <div class="custom-col--3 custom-col--6-768 custom-col--12-576">
                                                <ol class="find--list">
                                                   @foreach($brands as $brand)
                                                    <li class="find--item">
                                                        <a href="{{route('main.brand.product',$brand)}}" class="find--link">
                                                                    <span>{{$brand->title}}</span>
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ol>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                                <?php } ?>

                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('main/js/brand-list.js')}}"></script>
@endpush

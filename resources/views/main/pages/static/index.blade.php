@extends('main.layouts.main')
@section('wrapper_class')
    pt-header
@endsection

@section('title',$page->meta_title)
@section('description',$page->meta_description)
@section('keywords',$page->meta_title)



<div class="wrapper">
    <main class="content mt-header ">
        <section class="section">
            <div class="container container-xl">
                <div class="d-flex align-items-center flex-wrap justify-content-between flex-md-nowrap">
                    <ul class="breadcrambs mb-2">
                        <li>
                            <a href="{{route('main.home')}}">Home</a>
                        </li>
                        <li>
                            <a>{{$page->title}}</a>
                        </li>
                    </ul>

                </div>
            </div>
        </section>
        <section class="section">
            <div class="container container-xl">
                <div class="question-page">

                    <div class="question-page-content">
                        <div class="mw-800" style="max-width: 800px">
                            <h3 class="ttu fw-900 mb-4">{{$page->title}}</h3>

                            <div class="mb-40 lh-28">{!! $page->content !!}</div>
                            <div class="d-flex align-items-center">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" class="btn me-4">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M22 12C22 6.48 17.52 2 12 2C6.48 2 2 6.48 2 12C2 16.84 5.44 20.87 10 21.8V15H8V12H10V9.5C10 7.57 11.57 6 13.5 6H16V9H14C13.45 9 13 9.45 13 10V12H16V15H13V21.95C18.05 21.45 22 17.19 22 12Z"
                                            fill="black"/>
                                    </svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{url()->current()}}" class="btn me-4">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M22.46 6C21.69 6.35 20.86 6.58 20 6.69C20.88 6.16 21.56 5.32 21.88 4.31C21.05 4.81 20.13 5.16 19.16 5.36C18.37 4.5 17.26 4 16 4C13.65 4 11.73 5.92 11.73 8.29C11.73 8.63 11.77 8.96 11.84 9.27C8.28004 9.09 5.11004 7.38 3.00004 4.79C2.63004 5.42 2.42004 6.16 2.42004 6.94C2.42004 8.43 3.17004 9.75 4.33004 10.5C3.62004 10.5 2.96004 10.3 2.38004 10V10.03C2.38004 12.11 3.86004 13.85 5.82004 14.24C5.19077 14.4122 4.53013 14.4362 3.89004 14.31C4.16165 15.1625 4.69358 15.9084 5.41106 16.4429C6.12854 16.9775 6.99549 17.2737 7.89004 17.29C6.37367 18.4904 4.49404 19.1393 2.56004 19.13C2.22004 19.13 1.88004 19.11 1.54004 19.07C3.44004 20.29 5.70004 21 8.12004 21C16 21 20.33 14.46 20.33 8.79C20.33 8.6 20.33 8.42 20.32 8.23C21.16 7.63 21.88 6.87 22.46 6Z"
                                            fill="black"/>
                                    </svg>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

</div>


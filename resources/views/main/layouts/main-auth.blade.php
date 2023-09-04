<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}} - @yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.min.css"
          integrity="sha512-qveKnGrvOChbSzAdtSs8p69eoLegyh+1hwOMbmpCViIwj7rn4oJjdmMvWOuyQlTOZgTlZA0N2PXA7iA8/2TUYA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{asset('main/css/plagins/choices.css')}}"/>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="{{asset('main/css/bootstrap-grid.css')}}">
    <link rel="stylesheet" href="{{asset('main/css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('main/css/global.css')}}">
    <link rel="stylesheet" href="{{asset('main/css/components/components.css')}}">
    <link rel="stylesheet" href="{{asset('main/css/main-alpha.css')}}">
    <link rel="stylesheet" href="{{asset('main/css/main-bravo.css')}}">
    <link rel="stylesheet" href="{{asset('main/css/main-charlie.css')}}">
    <link rel="stylesheet" href="{{asset('main/css/main-delta.css')}}">
    <link rel="stylesheet" href="{{asset('main/css/main-foxtrot.css')}}">
    <link rel="stylesheet" href="{{asset('main/css/media-alpha.css')}}">
    <link rel="stylesheet" href="{{asset('main/css/media-bravo.css')}}">
    <link rel="stylesheet" href="{{asset('main/css/media-charlie.css')}}">
    <link rel="stylesheet" href="{{asset('main/css/media-delta.css')}}">
    <link rel="stylesheet" href="{{asset('main/css/main-bravo-161222-auth.css')}}">
</head>
<body>


<div class="wrapper ">
    <main class="content ">
        @yield('content')
    </main>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<!-- swiper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.min.js"
        integrity="sha512-1mDhG//LAjM3pLXCJyaA+4c+h5qmMoTc7IuJyuNNPaakrWT9rVTxICK4tIizf7YwJsXgDC2JP74PGCc7qxLAHw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<!-- select -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<!-- tippy -->
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
<!-- custom -->
<!-- chart -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.0-beta.5/chart.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>-->

<script src="{{asset('main/js/helpers.js')}}"></script>
<script src="{{asset('main/js/main-alpha.js')}}"></script>
<script src="{{asset('main/js/main-bravo.js')}}"></script>
<script src="{{asset('main/js/main-charlie.js')}}"></script>
<script src="{{asset('main/js/main-delta.js')}}"></script>
</body>
</html>

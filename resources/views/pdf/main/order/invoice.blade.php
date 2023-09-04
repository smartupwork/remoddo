<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ public_path('main/css/pdf.css') }}" rel="stylesheet">
</head>

<body>
<header class="clearfix">
    <div id="logo">
        <img src="{{$order->product->image}}">
    </div>
    <h1>ORDER {{$order->id}}</h1>
    <div class="content-header">
        <div id="company">
            <h4>LENDER</h4>
            <div><span>FULLNAME</span> {{$order->lender->info->full_name}}</div>
            <div><span>EMAIL</span> <a href="mailto:{{$order->lender->email}}">{{$order->lender->email}}</a>
            </div>
        </div>
        <div id="project">
            <h4>RENTER</h4>
            <div><span>FULLNAME</span> {{$order->renter->info->full_name}}</div>
            <div><span>ADDRESS</span> {{$order->shipping->address->location}}</div>
            <div><span>EMAIL</span> <a href="mailto:{{$order->renter->email}}">{{$order->renter->email}}</a>
            </div>
            <div><span>DATE</span> {{$order->start_date}}</div>
            <div><span>EXP DATE</span>{{$order->exp_date}} </div>
        </div>
    </div>
</header>
<main>
    <table>
        <thead>
        <tr>
            <th class="service">PRODUCT NAME</th>
            <th>RENT PRICE</th>
            <th>RENT DAY</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="service">{{$order->product->title}}</td>
            <td class="desc">£{{$order->total_price}}</td>
            <td class="unit">{{$order->rent->day}}</td>
        </tr>
        </tbody>
    </table>
</main>

</body>
</html>

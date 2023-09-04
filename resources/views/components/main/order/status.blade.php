@php
    $className='';
@endphp
@if($order->status==='new')
    @php
        $className='pill btn--warning radius-3';
    @endphp
@elseif($order->status==='accepted')
    @php
        $className='pill btn--success radius-3';
    @endphp
@elseif($order->status==='in_wardrobe')
    @php
        $className='pill btn--dark radius-3';
    @endphp
@elseif($order->status==='declined')
    @php
        $className='pill btn--reject radius-3';
    @endphp
@elseif($order->status==='failed')
    @php
        $className='pill btn--reject radius-3';
    @endphp
@elseif($order->status==='completed')
    @php
        $className='pill radius-3 bg-primary-100';
    @endphp
@elseif($order->status==='shipped_back')
    @php
        $className='pill btn--warning radius-3';
    @endphp
@elseif($order->status==='is_coming')
    @php
        $className='pill btn--success radius-3';
    @endphp
@endif
<span class="{{$className}}">{{$order->status}}</span>

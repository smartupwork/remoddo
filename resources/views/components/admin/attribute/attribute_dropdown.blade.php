@php
   $array='';
   $multiple='';
@endphp
@if($attribute->is_multiple)
    @php
        $array='[]';
        $multiple='multiple';
    @endphp

@endif

<div class="col-lg-6">
    <div class="form-group">
        <label>{{$attribute->title}}</label>
        <select class="form-control select2" {{$multiple}}
        name="attribute[{{$attribute->id}}][{{$attribute->name}}]{{$array}}"
                style="width: 100%;">
            @if(!$attribute->is_multiple)
                <option value="" selected>Select--{{$attribute->title}}</option>
            @endif
            @foreach($attribute->values as $value)

                <option value="{{$value->id}}"  @if(in_array($value->id,$values)) selected @endif >{{$value->value}}</option>
            @endforeach
        </select>
    </div>
    @error("attribute.$attribute->id.$attribute->name")
         <span class="text-danger">{{$message}}</span>
    @enderror
</div>

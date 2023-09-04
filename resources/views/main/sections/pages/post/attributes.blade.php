@foreach($attributes as $attribute)

    @php
        $array=false;
        $multiple='';
        $values=array_keys($product_attributes,$attribute->id);
    @endphp
    @if($attribute->is_multiple)
        @php
            $array=true;
            $multiple='multiple';
        @endphp

    @endif



    <div class="input-wrap input-col-6 mb-20">
        <label class="label-custom">{{$attribute->title}}</label>
        <select class="select-default attribute" {{$multiple}}
            data-attribute-id="{{$attribute->id}}"
            data-attribute-name="{{$attribute->name}}"
            data-is-array="{{$array}}"
        name="attribute[{{$attribute->id}}][{{$attribute->name}}]{{$array}}"
        >
            @if(!$attribute->is_multiple)
                <option value="" selected>Select {{$attribute->title}}</option>
            @endif
            @foreach($attribute->values as $value)
                <option value="{{$value->id}}" @if(in_array($value->id,$values)) selected @endif>{{$value->value}}</option>
            @endforeach
        </select>
        <span class="error error-attribute-{{$attribute->id}}-{{$attribute->name}} error-message"></span>
    </div>
@endforeach

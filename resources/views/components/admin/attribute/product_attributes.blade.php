@foreach($attributes as $attribute)
    @php
      $values_ids= $product->values->where('attribute_id', '=', $attribute->id)->pluck('id')->toArray();
    @endphp

    @include('components.admin.attribute.attribute_dropdown',['$attribute'=>$attribute,'values'=>$values_ids])
@endforeach

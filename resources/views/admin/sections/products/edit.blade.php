@extends('admin.layouts.admin')

@section('title', "Edit product")

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <form action="{{route('admin.products.update',['product'=>$product->id])}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h3 class="mb-3">Product images</h3>
                <div class="row">
                    @foreach($product->images as $image)
                        <div class="col-lg-3 mb-3">
                            <div class="product-image-wrap">
                                <img src="{{$image->image}}" class="product-image" alt="Product Image">
                                <button type="button"
                                        data-url="{{route('admin.product.image-remove',['image'=>$image->id])}}"
                                        class="btn btn-danger delete-image"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <h3 class="mb-3">Product Params</h3>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Item name</label>
                            <input type="text" name="title" class="form-control" value="{{$product->title}}">
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Minimal rental period (days)</label>
                            <input type="text" name="period_day" class="form-control"
                                   value="{{$product->period_day}}">
                            @error('period_day')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Rent price (per day)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input type="text" name="price" class="form-control" value="{{$product->price}}">
                            </div>
                            @error('price')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group status-checked">
                            <label>Brand confirmation
                                <span class="popover-icon" data-tooltip="popover" data-placement="top"
                                      data-content="if the lender wants to add his product to the Brands category on the site then when adding the product, he puts a check mark in the checkbox opposite this Brands category. in order for the product to fall into this category, It is checked by the administrator and only after its confirmation does the product fall into the category. After the lender places the Brands category, the product in the admin panel at the admin with the Pending status, after checking the product and confirmation, it acquires the Confirmed status and falls into the category on the site."
                                      data-original-title="" title="" style="display: inline-flex;">
                                 <img src="{{asset('main/img/images/icon-tippy.svg')}}">
                </span>
                                <i class="fas fa-exclamation-triangle pending-icon text-warning"></i>
                                (REVIEW)
                            </label>
                            <select class="form-control select2 " name="brand_confirmation" style="width: 100%;">
                                @foreach($brandConfirmations as $type)
                                    <option value="{{$type}}">{{$type}}</option>
                                @endforeach
                            </select>
                            @error('brand_confirmation')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" name="address" class="form-control" value="{{$product->address}}">
                            @error('address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Images</label>
                            <input type="file" name="images[]" class="form-control" multiple>
                            @error('images')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <h3 class="mb-3">Category Filters:</h3>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Categories</label>
                            <select multiple class="form-control select2" name="category_id[]" style="width: 100%;">
                                @foreach($categories as $category)
                                    <option disabled>{{$category->title}}</option>
                                    @foreach($category->children as $child)
                                        <option
                                            @if(in_array($child->id,$product->categories()->pluck('category_id')->toArray()) ||
                                               (old('category_id') && in_array($child->id,old('category_id'))))
                                            selected
                                            @endif value="{{$child->id}}">-{{$child->title}}</option>
                                    @endforeach
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Brands</label>
                            <select class="form-control select2" name="brand_id" style="width: 100%;">
                                @foreach($brands as $id=>$title)
                                    <option @if($id==$product->brand->id || $id==old('brand_id')) selected
                                            @endif value="{{$id}}">{{$title}}</option>
                                @endforeach
                            </select>

                            @error('brand_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    @include('components.admin.attribute.product_attributes',['attributes'=>$attributes])

                </div>
                <h3 class="mb-3">Description</h3>
                <div class="form-group">
                    <textarea id="summernote" name="description">{{$product->description}}</textarea>
                </div>
                @error('description')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <div class="d-flex align-items-center justify-content-between">
                    <a href="{{route('admin.products.index')}}" class="btn btn-secondary mb-3">Cancel</a>
                    <input type="submit" value="Save" class="btn btn-success mb-3">
                </div>
            </form>

            <h3 class="mb-3">Product Lender/Renters info</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">
                            Lender
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>{{$product->lender->info->fullName}}</b></h2>
                                    <p class="text-muted text-sm"><b>About: </b> {{$product->lender->info->about}}</p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i
                                                    class="fas fa-lg fa-building"></i></span>
                                            Address: {{$product->lender->info->address}}
                                        </li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-envelope"></i></i></span>
                                            Email: {{$product->lender->email}}
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="{{$product->lender->info->avatar}}" alt="user-avatar"
                                         class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a href="#" class="btn btn-sm bg-teal">
                                    <i class="fas fa-comments"></i>
                                </a>
                                <a href="{{route('admin.lenders.edit',['lender'=>$product->lender->id])}}"
                                   class="btn btn-sm btn-primary">
                                    <i class="fas fa-user"></i> View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Renters list</h3>
                        </div>
                        <div class="card-body p-0">
                            <table id="renters-table" data-url="{{route('admin.product.renter-list',['product'=>$product->id])}}" class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Period</th>
                                    <th>Violations</th>
                                    <th>Paid Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@push('scripts')
    <script src="{{asset('js/admin/product-delete-image.js')}}"></script>
    <script src="{{asset('js/admin/product-renters.js')}}"></script>
@endpush

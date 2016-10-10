@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @include('common.errors')

        <!-- New Product Form -->
        <form action="/product/{{ $product->id }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <!-- Product Name -->
            <div class="form-group">
                <label for="product_name" class="col-sm-3 control-label">Name</label>

                <div class="col-sm-6">
                    <input type="text" name="product_name" id="product_name" class="form-control" value="{{ $product->product_name }}">
                </div>
            </div>

            <!-- Product Description -->
            <div class="form-group">
                <label for="product_description" class="col-sm-3 control-label">Description</label>

                <div class="col-sm-6">
                    <input type="text" name="product_description" id="product_description" class="form-control" value="{{ $product->product_description }}">
                </div>
            </div>

            <!-- Product Category -->
            <div class="form-group">
                <label for="product_category" class="col-sm-3 control-label">Category</label>

                <div class="col-sm-3">
                    <select name="product_category" id="product_category" class="form-control">

                        @foreach ($categories as $category)

                            <option value="{{$category->id}}" 
                                @if ($product->category_id == $category->id)
                                    selected
                                @endif
                            >{{$category->category_name}}</option>

                        @endforeach
                        
                    </select>
                </div>

            </div>



            <!-- Add Product Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Edit Product
                    </button>
                </div>
            </div>
        </form>

    </div>    

</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <br><strong>Name</strong><br>
        {!! nl2br(e($product->product_name)) !!}
        <br><strong>Desc</strong><br>
        {!! nl2br(e($product->product_description)) !!}
        <br><strong>Category</strong><br>
        {!! nl2br(e($product->category->category_name)) !!}
        <br>
        @if (Auth::user()->id == $product->user_id)
            <a href="/product/{{$product->id}}/edit">Edit</a>
            <form action="/product/{{$product->id}}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <!-- Add Product Button -->
                <div class="form-group">
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-plus"></i> Delete Product
                        </button>
                    </div>
                </div>
             </form>
        @endif
    </div>

</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	@if ($products != null)
        	@foreach ($products as $product)

            	<div class="col-sm-6">
                	<h3><a href="/product/{{$product->id}}">{{$product->product_name}}</a></h3>
                    {{$product->product_description}}
            	</div>

        	@endforeach
        @else
        	<div class="col-sm-12">
            	<a href="/product/create">No Product found, please create one</a>
        	</div>
        @endif
        
    </div>

</div>
@endsection

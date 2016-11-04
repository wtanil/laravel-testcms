@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	@if ($categories != null)
	        @foreach ($categories as $category)

	        <div class="col-sm-6">
	            <a href="/category/{{$category->category_name_slug}}">{{$category->category_name}}</a>
	        </div>

	        @endforeach
        @else
        	<div class="col-sm-12">
            	<a href="/category/create">No categories found, please create one</a>
        	</div>
        @endif
        

    </div>

</div>
@endsection

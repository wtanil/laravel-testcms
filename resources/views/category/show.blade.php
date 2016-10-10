@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<br><strong>Name</strong><br>
		{!! nl2br(e($category->category_name)) !!}
		<br><strong>Description</strong><br>
		{!! nl2br(e($category->category_description)) !!}
		<br>
		<a href="/category/{{$category->category_name_slug}}/edit">Edit</a>
		<form action="/category/{{$category->category_name_slug}}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <!-- Add Category Button -->
            <div class="form-group">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-plus"></i> Delete Category
                    </button>
                </div>
            </div>

         </form>


	</div>

</div>
@endsection

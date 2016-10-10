@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

       @include('common.errors')

        <!-- New Category Form -->
        <form action="/category/{{$category->category_name_slug}}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <!-- Category Name -->
            <div class="form-group">
                <label for="category_name" class="col-sm-3 control-label">Name</label>

                <div class="col-sm-6">
                    <input type="text" name="category_name" id="category_name" class="form-control" value="{{$category->category_name}}">
                </div>
            </div>

            <!-- Category Description -->
            <div class="form-group">
                <label for="category_description" class="col-sm-3 control-label">Description</label>

                <div class="col-sm-6">
                    <!-- <input type="text" name="category_description" id="category_description" class="form-control" value="{{$category->category_description}}"> -->
                    <textarea name="category_description" id="category_description" class="form-control" rows="5" id="comment">{{ $category->category_description }}</textarea>
                </div>
            </div>

            <!-- Add Category Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Edit Category
                    </button>
                </div>
            </div>
        </form>

    </div>    

</div>
@endsection
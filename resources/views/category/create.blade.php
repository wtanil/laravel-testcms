@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @include('common.errors')

        <!-- New Category Form -->
        <form action="/category" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Category Name -->
            <div class="form-group">
                <label for="category_name" class="col-sm-3 control-label">Name</label>

                <div class="col-sm-6">
                    <input type="text" name="category_name" id="category_name" class="form-control" value="{{ old('category_name') }}">
                </div>
            </div>

            <!-- Category Description -->
            <div class="form-group">
                <label for="category_description" class="col-sm-3 control-label">Description</label>

                <div class="col-sm-6">
                    <!-- <input type="text" name="category_description" id="category_description" class="form-control" value="{{ old('category_description') }}"> -->
                    <textarea name="category_description" id="category_description" class="form-control" rows="5" id="comment">{{ old('category_description') }}</textarea>
                </div>
            </div>

            <!-- Add Category Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Category
                    </button>
                </div>
            </div>
        </form>

    </div>    

</div>
@endsection

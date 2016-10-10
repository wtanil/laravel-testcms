@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @foreach ($categories as $category)

        <div class="col-sm-6">
            <a href="/category/{{$category->category_name_slug}}">{{$category->category_name}}</a>
        </div>

        @endforeach

        

    </div>

</div>
@endsection

@extends('layout.default.main')

@section('central')

        <form class="form-horizontal" method="post" onsubmit="return Main.formSubmit(this);" action="{{ action('GalleryController@postStore',['id'=>Route::current()->parameter('id')]) }}">
            @include($controller.'.form')
        </form>

@endsection
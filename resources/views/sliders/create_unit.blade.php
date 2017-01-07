@extends('layout.default.main')

@section('central')

        <form class="form-horizontal" method="post" onsubmit="return Main.formSubmit(this);" action="{{ action('SlidersController@postStoreUnit',['id'=>Route::current()->parameter('id')]) }}">
            @include($controller.'.form_unit')
        </form>

@endsection
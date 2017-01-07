@extends('layout.default.main')

@section('central')

        <form class="form-horizontal" method="post" onsubmit="return Main.formSubmit(this);" action="{{ action('ConstantsController@postStore') }}">
            @include($controller.'.form_'.$type)
        </form>

@endsection
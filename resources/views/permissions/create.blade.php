@extends('layout.default.main')

@section('central')

        <form class="form-horizontal" method="post" onsubmit="return Main.formSubmit(this);" action="{{ action('PermissionsController@postStore') }}">
            @include($controller.'.form')
        </form>

@endsection
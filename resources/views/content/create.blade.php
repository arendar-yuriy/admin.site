@extends('layout.default.main')

@section('central')

        <form class="form-horizontal" method="post" onsubmit="return Main.formSubmit(this);" action="{{ action('ContentController@postStore',['structure_id'=>$structure_id]) }}">
            @include('content.form_'.$oStructure->controller)
        </form>

@endsection
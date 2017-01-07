@extends('layout.default.main')

@section('central')

        <form class="form-horizontal" method="post" onsubmit="return Main.formSubmit(this);" action="{{ Route('update_'.$controller, ['id'=>$content->id]) }}">
            @include($controller.'.form')
        </form>

@endsection
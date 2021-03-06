@extends('layout.default.main')

@section('central')
    @if(Auth::user()->can([$controller.'-add-delete',$controller.'-edit']))
        <form class="form-horizontal" method="post" onsubmit="return Main.formSubmit(this);" action="{{ Route('update_'.$controller, ['id'=>$content->id]) }}">
            @include($controller.'.form')
        </form>
    @else
        <form class="form-horizontal">
            @include($controller.'.view')
        </form>
    @endif

@endsection
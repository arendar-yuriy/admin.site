@extends('layout.default.main')

@section('central')

    @if(Auth::user()->can([$controller.'-add-delete',$controller.'-edit']))

        <form class="form-horizontal" method="post" onsubmit="return Main.formSubmit(this);" action="{{ Route('update_sliders_unit',['id'=>Route::current()->parameter('id')]) }}">
            @include($controller.'.form_unit')
        </form>

    @else
        <form class="form-horizontal" >
            @include($controller.'.view_unit')
        </form>
    @endif

@endsection
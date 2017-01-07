@extends('layout.default.layout')

@section('content')
    <div class="panel panel-flat border-grey">
        <div class="panel-heading">
            <h5 class="panel-title pull-left">{{ $title }}</h5>

            <div class="pull-right">
                @include('layout.default.inc.content_lang')
                @if(view()->exists($controller.'.inc.add'))
                    @include($controller.'.inc.add')
                @endif
            </div>

        </div>
        <div class="panel-body">
            <legend class="text-bold"></legend>
            @yield('central')
        </div>
    </div>
@endsection
@extends('layout.comments.layout')

@section('content')
    <div class="container-detached" >
        <div class="content-detached">

            @yield('central')

        </div>

    </div>

    @include('layout.comments.inc.list-content')
@endsection


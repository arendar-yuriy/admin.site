@extends('layout.default.layout')

@section('content')

        <div class="container-detached" >
                <div class="content-detached">

                        {!! \App\Helpers\Comments::instance()->getView($content_id,$type) !!}

                </div>

        </div>

        @include('layout.default.inc.list-content')





@endsection
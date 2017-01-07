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

        <div class="col-md-12 " style="margin-top: 30px;">
            <div class="panel panel-default border-grey">
                <div class="panel-heading">
                    <h6 class="panel-title">{{ trans('app.content') }}</h6>

                </div>

                <div class="panel-body">
                    {!! $table_content !!}
                </div>
            </div>
        </div>


@endsection
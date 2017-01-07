@extends('layout.default.main')

@section('central')

    @if(Auth::user()->can([$controller.'-add-delete',$controller.'-edit']))
        <div class="tabbable nav-tabs-vertical nav-tabs-left">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="active"><a href="#left-tab1" data-toggle="tab"><i class=" icon-pen2 position-left"></i> {{ trans('app.edit') }}</a></li>
                <li><a href="#left-tab3" data-toggle="tab"><i class="icon-mention position-left"></i> {{ trans('app.meta') }}</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active has-padding" id="left-tab1">
                    <form class="form-horizontal" method="post" onsubmit="return Main.formSubmit(this);" action="{{ Route('update_'.$controller, ['id'=>$content->id]) }}">
                        @include($controller.'.form')
                    </form>
                </div>

                <div class="tab-pane has-padding" id="left-tab3">
                    @include('inc.form_meta')
                </div>
            </div>
        </div>
    @else
        <form class="form-horizontal" >
            @include($controller.'.view')
        </form>
    @endif

@endsection
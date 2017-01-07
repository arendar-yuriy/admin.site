@extends('layout.default.main')

@section('central')
    @if(Auth::user()->can([$controller.'-add-delete',$controller.'-edit']))
        <div class="tabbable nav-tabs-vertical nav-tabs-left">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="active"><a href="#left-tab1" data-toggle="tab"><i class=" icon-pen2 position-left"></i> {{ trans('app.edit') }}</a></li>
                @if($content->children->isEmpty())
                    <li><a href="#left-tab2" data-toggle="tab"><i class="icon-images2 position-left"></i> {{ trans('app.images') }}</a></li>
                @endif
                <li><a href="#left-tab3" data-toggle="tab"><i class="icon-mention position-left"></i> {{ trans('app.meta') }}</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active has-padding" id="left-tab1">
                    <form class="form-horizontal" method="post" onsubmit="return Main.formSubmit(this);" action="{{ Route('update_'.$controller, ['id'=>$content->id]) }}">
                        @include($controller.'.form')
                    </form>
                </div>

                @if($content->children->isEmpty())
                    <div class="tab-pane has-padding" id="left-tab2">
                        @include('inc.dropzone')
                    </div>
                @endif

                <div class="tab-pane has-padding" id="left-tab3">
                   @include('inc.form_meta')
                </div>
            </div>
        </div>
    @else
        <form class="form-horizontal">
            @include($controller.'.view')
        </form>
    @endif

    @if(!$content->units->isEmpty())
        <div class="panel panel-flat border-top-xlg border-top-info">
            <div class="panel-heading">
                <h6 class="panel-title"><span class="text-semibold">{{ trans('app.Images') }}</span> </h6>
            </div>

            <div class="panel-body">

                {!! $table_image !!}

            </div>
        </div>
    @elseif(!$content->children->isEmpty())
        <div class="panel panel-flat border-top-xlg border-top-info">
            <div class="panel-heading">
                <h6 class="panel-title"><span class="text-semibold">{{ trans('app.Folders') }}</span> </h6>
            </div>

            <div class="panel-body">

                {!! $table_folders !!}

            </div>
        </div>
    @endif

@endsection
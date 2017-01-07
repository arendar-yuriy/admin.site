@extends('layout.default.layout')


@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-3">

                <div class="panel bg-indigo-300">
                    <div class="panel-body">
                        <a href="{{ route('structure') }}"  class="bg-indigo-300">
                            <span class="btn border-slate btn-flat btn-rounded btn-icon btn-lg valign-text-bottom pull-left" style="margin: 6px 30px 0 0">
                            <i class="icon-tree7"></i>
                        </span>

                            <h2 class="no-margin">

                                <span>{{ trans('app.structure') }}</span>
                            </h2>
                            {{ trans('app.items') }} {{ \App\Structure::count() }}
                        </a>
                    </div>
                </div>

            </div>

            <div class="col-lg-3">
                <div class="panel bg-pink-400">
                    <div class="panel-body">

                        <a href="{{ route('content') }}"  class="bg-pink-400">
                            <span class="btn border-slate btn-flat btn-rounded btn-icon btn-lg valign-text-bottom pull-left" style="margin: 6px 30px 0 0">
                            <i class="icon-files-empty"></i>
                        </span>

                            <h2 class="no-margin">

                                <span>{{ trans('app.content') }}</span>
                            </h2>
                            {{ trans('app.items') }} {{ \App\Content::where('type','<>','block')->count() }}
                        </a>
                    </div>

                    <div id="server-load"></div>
                </div>
                <!-- /current server load -->

            </div>

            <div class="col-lg-3">

                <!-- Today's revenue -->
                <div class="panel bg-slate">
                    <div class="panel-body">
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>

                        <h3 class="no-margin">$18,390</h3>
                        Today's revenue
                        <div class="text-muted text-size-small">$37,578 avg</div>
                    </div>

                    <div id="today-revenue"></div>
                </div>
                <!-- /today's revenue -->

            </div>

            <div class="col-lg-3">

                <!-- Today's revenue -->
                <div class="panel bg-slate">
                    <div class="panel-body">
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>

                        <h3 class="no-margin">$18,390</h3>
                        Today's revenue
                        <div class="text-muted text-size-small">$37,578 avg</div>
                    </div>

                    <div id="today-revenue"></div>
                </div>
                <!-- /today's revenue -->

            </div>
        </div>
    </div>

@endsection
@extends('layout.default.main')

@section('central')


    <div class="row">
        <div class="col-lg-9">

            <div class="timeline timeline-left content-group">
                <div class="timeline-container">

                    @foreach($logs as $item)
                        <div class="timeline-date text-muted">
                            <i class="icon-history position-left"></i> <span class="text-semibold">{{ dateLocale('l',strtotime($item->created_at),LaravelLocalization::getCurrentLocale()) }}</span>, {{ dateLocale('F',strtotime($item->created_at),LaravelLocalization::getCurrentLocale()) }} {{ dateLocale('d',strtotime($item->created_at)) }}
                        </div>

                        <div class="timeline-row">
                            <div class="timeline-icon">
                                {!! getImage($content->socials()->where('name', $content->social_network)->first()->photo,40,40) !!}
                            </div>

                            <div class="panel panel-flat border-top-xlg border-top-info  border-bottom-info border-left-info border-right-info">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><span class="text-semibold">{{ trans('activity.Daily Activity') }}</span></h6>
                                </div>

                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>{{ trans('activity.action') }}</th>
                                                <th>{{ trans('activity.date') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($item->items as $value)
                                                    <tr>
                                                        <td>{{ $value->action }}</td>
                                                        <td>{{ date('d-m-Y H:i:s',strtotime($value->created_at)) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>


        </div>

        @include('siteusers.inc.sidebar')

    </div>




@endsection
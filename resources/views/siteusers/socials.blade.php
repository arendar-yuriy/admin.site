@extends('layout.default.main')

@section('central')


    <div class="row">
        <div class="col-lg-9">

            <table id="table-main" class="table   datatable-sorting ">
                <thead>
                <tr>
                    <th>{{ trans('app.id') }}</th>
                    <th>{{ trans('app.Photo') }}</th>
                    <th>{{ trans('app.firstname') }}</th>
                    <th>{{ trans('app.lastname') }}</th>
                    <th>{{ trans('app.Social network') }}</th>

                </tr>
                </thead>
                <tbody>
                @foreach($content->socials()->get() as $value)
                    <tr>
                        <td>{{ $value->social_id }}</td>
                        <td>
                            @if($value->photo)
                                <a href="{{ Config::get('admin.image_url').$value->photo }}" data-popup="lightbox">
                                    {!! MediaImage::getImage($value->photo,94,null,['class'=>'img-rounded']) !!}
                                </a>
                            @else
                                {!! MediaImage::getImage('',94,null,['class'=>'img-rounded']) !!}
                            @endif
                         </td>
                        <td>{{ $value->firstname }}</td>
                        <td>{{ $value->lastname }}</td>
                        <td><a href="{{ $value->link }}" target="_blank" class="label bg-blue-800"><i class="{{ Config::get('admin.social_icons.'.$value->name) }}"></i> {{ $value->name }}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>

        @include('siteusers.inc.sidebar')

    </div>

@endsection
@extends('layout.default.main')

@section('central')

    <div class="table-responsive">
        <table class="table table-lg">

            <?php $colspan = (Auth::user()->can([$controller.'-add-delete',$controller.'-edit']))? 6 : 5;?>

            @foreach($groups as $group)
                <tr>
                    <th colspan="{{ $colspan }}" class="active">{{ trans('constant.'.Config::get('admin.constants_group.'.$group->group)) }}</th>
                </tr>
                @foreach($group->items as $value)
                    @include($controller.'.inc.field_'.$value->type,compact('value'))
                @endforeach
            @endforeach
        </table>
    </div>

@endsection
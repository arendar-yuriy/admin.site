@permission($controller.'-add-delete')
    <div class="btn-group heading-btn">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><i class=" icon-add position-left"></i> {{ trans('app.Add constant') }} <span class="caret"></span></button>
        <ul class="dropdown-menu dropdown-menu-right">
            @foreach(Config::get('admin.constants_type') as $key=>$name)
                <li><a href="{{ route('constants_add',['type'=>$key,'group'=>Route::current()->parameter('group')]) }}">{{ trans('constant.'.$name) }}</a></li>
            @endforeach
        </ul>
    </div>
@endpermission

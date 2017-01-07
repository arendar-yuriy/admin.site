@permission($controller.'-add-delete')
    <div class="btn-group">
        <a href="{{ LaravelLocalization::getLocalizedURL( LaravelLocalization::getCurrentLocale(),'/blocks/add') }}" class="btn btn-primary" ><i class=" icon-add position-left"></i>{{ trans('app.add_block') }}</a>
    </div>
@endpermission
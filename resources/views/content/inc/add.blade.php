@permission($controller.'-add-delete')
    @if($oStructure && $oStructure->controller == 'list' )
        <div class="btn-group">
            <a href="{{ Route('content_add', ['structure_id'=>$structure_id]) }}" class="btn btn-primary" ><i class=" icon-add position-left"></i>{{ trans('app.content') }}</a>
        </div>
    @endif
@endpermission
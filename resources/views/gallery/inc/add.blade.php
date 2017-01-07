@permission($controller.'-add-delete')
    @if(!isset($content) || (isset($content->units) && $content->units->isEmpty()) )
        <div class="btn-group">
            <a href="{{ route('gallery_add',['id'=>Route::current()->parameter('id')]) }}" class="btn btn-primary" ><i class=" icon-add position-left"></i>{{ trans('app.add_gallery_folder') }}</a>
        </div>
    @endif
@endpermission
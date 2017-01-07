<div class="col-lg-3">

    <div class="thumbnail">
        <div class="thumb thumb-rounded thumb-slide">
            @if($content->image)
                {!! MediaImage::getImage($content->image,211,211,['id'=>'avatar','crop'=>$content->is_crop,'alt'=>$content->name.' '.$content->lastname]) !!}
            @else
                <img id="avatar" src="/img/placeholder.jpg" alt="{{ $content->name }} {{ $content->lastname }}">
            @endif
            @permission([$controller.'-add-delete',$controller.'-edit'])
                <input type="hidden" id="base_img_url" value="{{ Config::get('admin.image_url') }}">
                <div class="caption">
                    <span>
                        <a href="#" id="add-file" class="btn bg-success-400 btn-icon btn-xs"><i class="icon-plus2"></i></a>
                        <a href="{{ route('users_crop_view',['id'=>$content->id]) }}" @if(!$content->image) style="display: none;" id="link-crop" @endif class="btn bg-success-400 btn-icon btn-xs"><i class="icon-crop"></i></a>
                    </span>
                </div>
            @endpermission
        </div>

        <div class="caption text-center">
            <h6 class="text-semibold no-margin">{{ $content->name }} {{ $content->lastname }}</h6>
        </div>
    </div>

    <div class="panel panel-flat pb-5">
        <div class="media-body">

            <div class="list-group no-border no-padding-top">
                <a href="{{ route('edit_users',['id'=>Route::current()->parameter('id')]) }}" class="list-group-item"><i class=" icon-cogs"></i> {{ trans('app.settings') }}</a>
                @permission([$controller.'-add-delete',$controller.'-edit'])
                    <a href="{{ route('edit_users_passwords',['id'=>Route::current()->parameter('id')]) }}" class="list-group-item"><i class=" icon-lock2"></i> {{ trans('app.Change password') }}</a>
                @endpermission
                <a href="{{ route('users_activity',['id'=>Route::current()->parameter('id')]) }}" class="list-group-item"><i class=" icon-sort-time-desc"></i> {{ trans('activity.User activity') }}</a>
            </div>
        </div>

    </div>


</div>

@permission([$controller.'-add-delete',$controller.'-edit'])
    <script>
        $(document).on('click','#add-file',function (event) {
            event.preventDefault();
            var updateID = $(this).attr('data-inputid'); // Btn id clicked
            var elfinderUrl = '/elfinder/popup/';

            // trigger the reveal modal with elfinder inside
            var triggerUrl = elfinderUrl + updateID;
            $.colorbox({
                href: triggerUrl,
                fastIframe: true,
                iframe: true,
                width: '90%',
                height: '80%'
            });

        });
        // function to update the file selected by elfinder
        function processSelectedFile(filePath, requestingField) {

            var file = filePath;
            $.ajax({
                url: '{{ route('update_users_avatar',['id'=> $content->id ]) }}',
                dataType:'json',
                method:'post',
                data: {value:filePath},
                success: function(data){
                    console.log($('#base_img_url').val()+file);
                    $('#avatar').attr('src',$('#base_img_url').val()+filePath);
                    $('#link-crop').show();
                }
            });
        }
    </script>
@endpermission
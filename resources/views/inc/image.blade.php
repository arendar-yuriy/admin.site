<div class="form-group ">
    <label class="control-label col-lg-2 text-semibold">{{ $title }}</label>
    <div class="col-lg-2">
        <div class="thumbnail">
            <div class="thumb">
                @if($image!='')
                    {!! MediaImage::getImage($image,218,null,['id'=>'img-'.$name,'crop'=>$is_crop]) !!}

                @else
                    <img id="img-{{ $name }}"  src="/img/placeholder.jpg" alt="">
                @endif

                <div class="caption-overflow">
                        <span>
                            {!! Form::hidden($name,$image,['id'=>$name]) !!}
                            <input type="hidden" id="base_img_url" value="{{ Config::get('admin.image_url') }}">
                            <input type="hidden" id="full_img_url" value="{{ Config::get('admin.image_url').$image }}">

                            <a href="#" data-inputid="{{ $name }}" class="btn border-white text-white btn-flat btn-icon btn-rounded popup_selector"><i class="icon-plus3"></i></a>
                            @if(Route::current()->getName() != $controller.'_add' && Route::current()->getName() != $controller.'_add_unit')
                            <a href="#" class="btn border-white text-white btn-flat btn-icon btn-rounded crop_modal crop-modal-{{ $name }}" style="display:none;"><i class="icon-crop"></i></a>
                            @endif
                                <a href="#" style="display: none;" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5 remove-image-{{ $name }}"><i class="icon-cross2"></i></a>
                        </span>
                </div>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function(){
            @if(Route::current()->getName() != $controller.'_add')
            $('.crop-modal-{{ $name }}').on('click',function(e){
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: '{{ route($controller.'_crop_view_post',['id'=>Route::current()->parameter('id')]) }}',
                    data:{_token:$('meta[name="csrf-token"]').attr('content'),image:$('#{{ $name }}').val(),filed:'{{ $name }}'},
                    dataType: "json",
                    success: function(data){
                        Main.actionData(data);
                    }
                });
            });
            @endif

            $('.remove-image-{{ $name }}').on('click',function(e){
                e.preventDefault();
                $('#img-{{ $name }}').attr('src','/img/placeholder.jpg');
                $('#{{ $name }}').val('');
                $('.crop-modal-{{ $name }}').hide();
                $('.remove-image-{{ $name }}').hide();
            });

            if($('#{{ $name }}').val()!=''){
                $('.crop-modal-{{ $name }}').show();
                $('.remove-image-{{ $name }}').show();
            }


        });
    </script>
</div>
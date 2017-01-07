@if(Auth::user()->can([$controller.'-add-delete',$controller.'-edit']))
    <td class="text-center">
        <ul class="icons-list">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-menu9"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="{{ route('edit_image_gallery',['id'=>$aRow['id']]) }}"><i class="icon-pencil7"></i> {{ trans('app.Edit') }}</a></li>
                    <li><a href="{{ route('gallery_unit_crop',['id'=>$aRow['id']]) }}"><i class="icon-crop"></i> {{ trans('app.Crop') }}</a></li>
                    <li class="divider"></li>
                    <li><a class="remove-image-{{ $aRow['id'] }}" href="#"><i class=" icon-trash"></i> {{ trans('app.delete') }}</a></li>
                </ul>
            </li>
        </ul>
    </td>

    <script>
        $(document).ready(function(){

            $('.remove-image-{{ $aRow['id'] }}').on('click',function(e){
                e.preventDefault();
                var url = '{{ route('delete_image_'.$controller,['id'=>$aRow['id']]) }}';

                bootbox.confirm("{{ trans('app.remove_confirm') }}", function(result) {
                    if(result){
                        $.ajax({
                            type: "GET",
                            url: url,
                            data: {},
                            dataType: "json",
                            success: function(data){
                                Main.actionData(data);
                            }
                        });
                    }
                });
            });
        });
    </script>
@else
    <td class="text-center">
        <a class="alert-danger "><i class=" icon-lock"></i></a>
    </td>
@endif
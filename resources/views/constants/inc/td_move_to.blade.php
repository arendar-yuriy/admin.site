@permission([$controller.'-add-delete',$controller.'-edit'])
    <td>

        <div class="form-group">
            <label>{{ trans('app.move_to') }}:</label>
            <select class="select" id="move-{{ $id }}" data-width="100%">
                @foreach(Config::get('admin.constants_group') as $key=>$value)
                    <option @if(Route::current()->parameter('group') ==$key) selected @endif value="{{ $key }}">{{ trans('constant.'.$value) }}</option>
                @endforeach
            </select>
        </div>

        <script>
            $(document).ready(function(){
                $('#move-{{ $id }}').on('change',function(){
                    var  val = $(this).val();
                    $.ajax({
                        method: 'post',
                        url: '{{ route('change_group_constants',['id'=>$id]) }}',
                        data:{group:val},
                        dataType:'json',
                        success: function(data){
                            Main.actionData(data);
                        }
                    });
                });
            });
        </script>

    </td>
@endpermission
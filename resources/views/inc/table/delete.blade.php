@if(Auth::user()->can([$controller.'-add-delete']))
    <td class="text-center">
        <a href="#" class="alert-danger remove-button-{{ $aRow['id'] }}"><i class="icon-bin"></i></a>
    </td>
    <script>
        $(document).ready(function(){

            $('.remove-button-{{ $aRow['id'] }}').on('click',function(e){
                e.preventDefault();
                var url = '{{ route('delete_'.$controller,['id'=>$aRow['id']]) }}';

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
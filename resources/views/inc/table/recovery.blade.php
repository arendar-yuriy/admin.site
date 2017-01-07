@if(Auth::user()->can([$controller.'-add-delete',$controller.'-edit']))
    <td class="text-center">
        <a href="#" class="label label-success label-icon recovery-button-{{ $aRow['id'] }}"><i class=" icon-undo2"></i></a>
    </td>
    <script>
        $(document).ready(function(){

            $('.recovery-button-{{ $aRow['id'] }}').on('click',function(e){
                e.preventDefault();
                var url = '{{ route('basket_restore',['id'=>$aRow['id']]) }}';

                bootbox.confirm("{{ trans('basket.recovery_confirm') }}", function(result) {
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
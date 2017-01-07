@if($count > 0)
    @permission(['basket-add-delete','basket-edit'])
        <div class="btn-group">
            <a href="#" class="label label-success label-icon recovery-button-all"><i class="icon-reply-all"></i> {{ trans('basket.Recovery all items') }}</a>
            @permission('basket-add-delete')
                <a href="#" class="label label-warning label-icon remove-button-all"><i class="icon-bin"></i> {{ trans('basket.Delete all items') }}</a>
                <script>
                    $(document).ready(function(){

                        $('.remove-button-all').on('click',function(e){
                            e.preventDefault();
                            var url = '{{ route('delete_basket_all') }}';

                            bootbox.confirm("{{ trans('basket.basket_remove_confirm_all') }}", function(result) {
                                if(result){
                                    $.ajax({
                                        type: "POST",
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
            @endpermission
        </div>
    <script>
        $(document).ready(function(){

            $('.recovery-button-all').on('click',function(e){
                e.preventDefault();
                var url = '{{ route('basket_restore_all') }}';

                bootbox.confirm("{{ trans('basket.basket_recovery_all') }}", function(result) {
                    if(result){
                        $.ajax({
                            type: "POST",
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

    @endpermission
@endif
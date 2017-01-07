<table id="table-main" class="table   datatable-sorting ">
    <thead>
    <tr>
        <th><input type="checkbox" id="main-ckecker" class="styled"></th>
        @foreach($data['header'] as $name=>$column)
            <th>{{ trans('app.'.$name) }}</th>
        @endforeach

    </tr>
    </thead>
    <tbody>
        @foreach($data['data'] as $value)
            <tr id="{{ $value['id'] }}">
                <td><input type="checkbox" class="styled"></td>
                @foreach($data['header'] as $key=>$item)
                    @include('inc.table.'.$item['type'],['aRow'=>$value,'aColumns'=>$data['header'],'key'=>$key])
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
<div class="row" id="group-action-conteiner" style="display: none;">
    <div class="col-lg-4">
        <div class="form-group">
            <div class="form-group">
                <label>{{ trans('app.Select action') }}</label>
                <select class="select" id="group-action">
                    <option value="">{{ trans('app.select') }}</option>
                    @if($data['delete'])
                        <option value="drop">{{ trans('app.Delete') }}</option>
                    @endif
                    @if($data['active'])
                        <option value="set_active">{{ trans('app.set active') }}</option>
                    @endif
                    @if( $data['de_active'] )
                        <option value="deselect_active">{{ trans('app.Remove activity') }}</option>
                    @endif
                    @if( $data['recovery'] )
                        <option value="recovery">{{ trans('app.Recovery') }}</option>
                    @endif
                </select>
            </div>
        </div>
    </div>

</div>

<script>

    function initCheckers() {
        $('.styled').uniform({
            radioClass: 'choice',
            wrapperClass: 'border-primary text-primary'
        });

        $('tbody td input.styled[type=checkbox]').on('change', function () {

            $('tbody td input.styled[type=checkbox]').each(function () {
                if ($(this).is(':checked')) {
                    $('#group-action-conteiner').show();
                    return false;
                }

                $('#group-action-conteiner').hide();
            });

            if ($(this).is(':checked')) {
                $(this).parents('tr').addClass('success');
                $.uniform.update();
            }
            else {
                $(this).parents('tr').removeClass('success');
                $.uniform.update();
            }
        });

        $('#main-ckecker').on('change', function () {

            $('tbody td input.styled[type=checkbox]').each(function () {
                if ($(this).is(':checked')) {
                    $('#group-action-conteiner').show();
                    return false;
                }

                $('#group-action-conteiner').hide();
            });

            if ($(this).is(':checked')) {
                $('tbody td input.styled[type=checkbox]').each(function () {
                    $(this).prop( "checked", true );
                    $(this).parents('tr').addClass('success');
                });

                $.uniform.update();
            }
            else {
                $('tbody td input.styled[type=checkbox]').each(function () {
                    $(this).removeAttr('checked','checked');
                    $(this).parents('tr').removeClass('success');
                });

                $.uniform.update();
            }
        });

        $('tbody td input.styled[type=checkbox]').each(function () {
            if ($(this).is(':checked')) {
                $('#group-action-conteiner').show();
                return false;
            }

            $('#group-action-conteiner').hide();
        });

    }

    $(document).ready(function(){

        $.extend( $.fn.dataTable.defaults, {
            autoWidth: false,
            "columns": [
                {
                    orderable: false,
                    width: '20px',
                    targets: 0
                },
                    @foreach($data['header'] as $name=>$column)
                {"name": "{{ $name }}", @if(!empty($column['width'])) "width": "{{ $column['width'] }}", @endif "orderable": {{ ($column['order'])?'true':'false' }}},
                @endforeach
            ],
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            @if($data['by_position'])
                paging: false,
            @endif
            language: {
                search: '<span>{{ trans('app.filter') }}:</span> _INPUT_',
                lengthMenu: '<span>{{ trans('app.Show') }}:</span> _MENU_ {{ trans('app.entries') }}',
                paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' },
                info:           "{{ trans('app.Showing') }} _START_ - _END_ {{ trans('app.of') }} _TOTAL_ {{ trans('app.entries') }}",
                emptyTable: "{{ trans('app.No data available in table') }}"
            },
            drawCallback: function () {
                $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
            },
            preDrawCallback: function() {
                initCheckers();
                $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
            },
            initComplete: function () {
                initCheckers();
            }
        });

        $('.datatable-sorting').dataTable();

        $('.dataTables_filter input[type=search]').attr('placeholder','{{ trans('app.Type to filter') }}...');

        $('.dataTables_length').find('select').select2({
            minimumResultsForSearch: "-1"
        });

        @if($data['isImage'])

            $('#group-action').on('change',function (e) {
                e.preventDefault();



                if($(this).val()){

                    var data = [];

                    var action = $(this).val();

                    @if($data['delete'])
                        if(action == 'drop'){
                            var url = '{{ route('group_delete_'.$controller) }}';

                            var message = '{{ trans('app.remove_confirm_selected') }}';
                        }

                    @endif
                    @if($data['active'])
                        if(action == 'set_active'){
                            var url = '{{ route('group_active_'.$controller) }}';

                            var message = '{{ trans('app.set_active_confirm_selected') }}';
                        }
                    @endif
                    @if( $data['de_active'] )
                        if(action == 'deselect_active'){
                            var url = '{{ route('group_deselect_active_'.$controller) }}';
                            var message = '{{ trans('app.deselect_confirm_selected') }}';
                        }

                    @endif

                    @if( $data['recovery'] )
                        if(action == 'recovery'){
                            var url = '{{ route('group_recovery_'.$controller) }}';
                            var message = '{{ trans('app.recovery_confirm_selected') }}';
                        }

                    @endif

                    if(url){
                        $('tbody td input.styled[type=checkbox]').each(function () {
                            if ($(this).is(':checked')) {
                                var id = $(this).closest('tr').attr('id');
                                console.log(id);
                                data[data.length] = id;
                            }
                        });

                        bootbox.confirm(message, function(result) {
                            if(result){
                                $.ajax({
                                    type: "POST",
                                    url: url,
                                    data: {data: data, action :action },
                                    dataType: "json",
                                    success: function(data){
                                        Main.actionData(data);
                                    }
                                });
                            }
                        });
                    }


                }

            });

        @else
            $('#group-action').on('change',function (e) {
                e.preventDefault();



                if($(this).val()){

                    var data = [];

                    var action = $(this).val();

                    @if($data['delete'])
                        if(action == 'drop'){
                            var url = '{{ route('group_delete_'.$controller) }}';
                            var message = '{{ trans('app.remove_confirm_selected') }}';
                        }

                    @endif
                    @if($data['active'])
                        if(action == 'set_active'){
                            var url = '{{ route('group_active_'.$controller) }}';
                            var message = '{{ trans('app.set_active_confirm_selected') }}';
                        }

                    @endif
                    @if( $data['de_active'] )
                        if(action == 'deselect_active'){
                            var url = '{{ route('group_deselect_active_'.$controller) }}';
                            var message = '{{ trans('app.deselect_confirm_selected') }}';
                        }

                    @endif

                    @if( $data['recovery'] )
                        if(action == 'recovery'){
                            var url = '{{ route('group_recovery_'.$controller) }}';
                            var message = '{{ trans('app.recovery_confirm_selected') }}';
                        }

                    @endif

                    if(url){
                        $('tbody td input.styled[type=checkbox]').each(function () {
                            if ($(this).is(':checked')) {
                                var id = $(this).closest('tr').attr('id');
                                console.log(id);
                                data[data.length] = id;
                            }
                        });

                        bootbox.confirm(message, function(result) {
                            if(result){
                                $.ajax({
                                    type: "POST",
                                    url: url,
                                    data: {data: data, action :action },
                                    dataType: "json",
                                    success: function(data){
                                        Main.actionData(data);
                                    }
                                });
                            }
                        });
                    }


                }

            });


        @endif

        @if($data['by_position'])

                $('tbody').sortable({
                stop: function( event, ui ) {
                    var data = $(this).sortable('serialize');
                    var mas = [];
                    var i=0;
                    $('#table-main').find('tbody').find('tr').each(function (e) {
                        i++;
                        id = $(this).attr('id');
                        mas[mas.length] = {id:id,position:i};
                    });

                    $.ajax({
                        method: 'POST',
                        data: {data : JSON.stringify(mas) },
                        dataType:'json',
                        url: '{{ route('update_position_'.$controller,['id'=>(isset($structure_id)) ? $structure_id : Route::current()->parameter('id')]) }}',
                        success: function (data) {
                            console.log(data);
                        }
                    });
                }
            });

        @endif
    });
</script>
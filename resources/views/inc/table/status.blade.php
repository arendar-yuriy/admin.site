<td>
    <div class="btn-group">
        <a href="#" class="label {{ Config::get('admin.status_'.$controller)[$aRow['status']]['bg'] }} dropdown-toggle label-control-{{ $aRow['id'] }}"  data-toggle="dropdown"><span  class="text-status-{{ $aRow['id'] }}">{{ trans('app.'.Config::get('admin.status_'.$controller)[$aRow['status']]['name']) }}</span> <span class="caret"></span></a>

        <ul class="dropdown-menu dropdown-menu-right ">
            @foreach(Config::get('admin.status_'.$controller) as $name=>$val)
                <li>
                    <a class="change-status-row-{{ $aRow['id'] }}" data-status="{{ $name }}" data-bg="{{ $val['bg'] }}">
                        <span class="status-mark {{ $val['bg'] }} position-left"></span>
                        <span class="txt-name">{{ trans('app.'.$val['name']) }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</td>

<script>
    $(document).ready(function(){
        $('.change-status-row-{{ $aRow['id'] }}').on('click',function(e){
            e.preventDefault();
            var url = '{{ route('status_'.$controller,['id'=>$aRow['id']]) }}';
            var status = $(this).data('status');
            var bg = $(this).data('bg');
            var text = $(this).find('.txt-name').html();
            var status_b_list = [@foreach(Config::get('admin.status_'.$controller) as $name=>$val) '{{ $val['bg']  }}', @endforeach ];

            $.ajax({
                type: "GET",
                url: url,
                data: {status:status},
                dataType: "json"
            }).done(function(data) {

                for(i in status_b_list){
                    $('.label-control-{{ $aRow['id'] }}').removeClass(status_b_list[i]);
                }

                $('.label-control-{{ $aRow['id'] }}').addClass(bg);


                $('.text-status-{{ $aRow['id'] }}').html(text);
            });

        });
    });
</script>
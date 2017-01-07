<div class="media">
    <div class="media-left">
        <a href="#"><img src="{avatar}" class="img-circle img-sm" alt="{user_name}"></a>
    </div>

    <div class="media-body">
        <div class="media-heading">
            <a href="#" class="text-semibold">{user_name}</a>
            <span class="media-annotation dotted">{date}</span>
        </div>

        <p>{comment}</p>

        <ul class="list-inline list-inline-separate text-size-small">
            <li>{id}
                @permission(['comments-edit','comments-add-delete'],true)
                    <div class="btn-group">
                        <a href="#" class="label {status_bg} dropdown-toggle label-control-{id}"  data-toggle="dropdown"><span  class="text-status-{id}">{status_name}</span> <span class="caret"></span></a>

                        <ul class="dropdown-menu dropdown-menu-right ">
                            @foreach(Config::get('admin.status_comments') as $name=>$val)
                                <li>
                                    <a class="change-status-row-{id}" data-status="{{ $name }}" data-bg="{{ $val['bg'] }}">
                                        <span class="status-mark {{ $val['bg'] }} position-left"></span>
                                        <span class="txt-name">{{ trans('app.'.$val['name']) }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endpermission
            </li>
            @permission('comments-add-delete')
                <li><a class="reply-link" data-id="{id}" href="#comment-reply">{{ trans('app.reply') }}</a></li>
                <li><a href="#comment-reply" class="edit-link"  data-id="{id}">{{ trans('app.edit') }}</a></li>
                <li><a href="#" class="alert-danger remove-button-{id}"><i class="icon-bin"></i></a></li>
            @endpermission
        </ul>
        @permission('comments-edit')
            <script>
                $(document).ready(function(){
                    $('.change-status-row-{id}').on('click',function(e){
                        e.preventDefault();
                        var url = Main.getLangLink('/comments/status/{id}');
                        var status = $(this).data('status');
                        var bg = $(this).data('bg');
                        var text = $(this).find('.txt-name').html();
                        var status_b_list = [@foreach(Config::get('admin.status_comments') as $name=>$val) '{{ $val['bg']  }}', @endforeach];

                        $.ajax({
                            type: "GET",
                            url: url,
                            data: {status:status},
                            dataType: "json"
                        }).done(function(data) {

                            for(i in status_b_list){
                                $('.label-control-{id}').removeClass(status_b_list[i]);
                            }

                            $('.label-control-{id}').addClass(bg);


                            $('.text-status-{id}').html(text);
                        });

                    });
                    @permission('comments-add-delete')
                       $('.remove-button-{id}').on('click',function(e){
                            e.preventDefault();
                            var url = Main.getLangLink('/comments/delete/{id}');

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
                    @endpermission
                });
            </script>
        @endpermission

        {|}

    </div>
</div>


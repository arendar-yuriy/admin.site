@extends('layout.default.main')

@section('central')

    @if(Auth::user()->can([$controller.'-add-delete',$controller.'-edit']))
        <div class="dd" id="nestable">

            {!! $view !!}

        </div>
    @else
        <div class="dd">

            {!! $view !!}

        </div>
    @endif

    <script>
        $(document).ready(function(){

            $('.remove-button-category').on('click',function(e){
                e.preventDefault();
                var url = Main.getLangLink('/structure/delete/'+$(this).data('id'));

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

            $('.change-active-row').on('change',function(){
                var url = Main.getLangLink('/structure/active/'+$(this).data('id'));
                var checked = $(this).prop('checked');
                if(typeof checked != 'undefined'){
                    checked = (checked) ? 1 : 0;
                    $.ajax({
                        type: "GET",
                        url: url,
                        data: {checked:checked},
                        dataType: "json"
                    });
                }
            });

        });
    </script>

@endsection
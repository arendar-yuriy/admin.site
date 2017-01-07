<tr>
    <td style="width: 20%;">{{ $value->name }}</td>

    @include('constants.inc.td_published',['value'=>$value])

    <td>
        @if(Auth::user()->can([$controller.'-add-delete',$controller.'-edit']))
            <input type="text" name="value" class="form-control" id="value-time-{{ $value->id }}" value="{{ $value->value }}">
            <script>
                $(document).ready(function(){

                    $('#value-time-{{ $value->id }}').AnyTime_picker({
                        format: "%d-%m-%Z %H:%i:%s"
                    });

                    $('#value-time-{{ $value->id }}').on('change',function(){
                        var url = '{{ route('update_constants',['id'=> $value->id ]) }}';
                        var val = $(this).val();

                        $.ajax({
                            type: "GET",
                            url: url,
                            method: 'post',
                            data: {value:val},
                            dataType: "json"
                        });

                    });
                });
            </script>
        @else
            <p>{{ $value->value }}</p>
        @endif
    </td>
    @include('constants.inc.td_move_to',['id'=>$value->id])
    <td>{{ $value->description }}</td>
    @include('constants.inc.td_delete',['id'=>$value->id])
</tr>
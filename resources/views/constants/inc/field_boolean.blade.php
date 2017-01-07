<tr>
    <td style="width: 20%;">{{ $value->name }}</td>

    <td></td>

    <td>
        @if(Auth::user()->can([$controller.'-add-delete',$controller.'-edit']))
            <div class="checkbox checkbox-switchery switchery-sm">
                <label>
                    <input type="checkbox" class="switchery change-value-row-{{ $value->id }}" @if($value->value == 1)checked="checked"@endif>
                </label>
            </div>

            <script>
                $(document).ready(function(){
                    $('.change-value-row-{{ $value->id }}').on('change',function(){
                        var url = '{{ route('update_constants',['id'=> $value->id ]) }}';
                        var checked = $(this).prop('checked');

                        checked = (checked) ? 1 : 0;

                        $.ajax({
                            type: "GET",
                            url: url,
                            method: 'post',
                            data: {value:checked},
                            dataType: "json"
                        });

                    });
                });
            </script>
        @else
            <div class="checkbox checkbox-switchery switchery-sm">
                <label>
                    <input type="checkbox" readonly class="switchery change-value-row-{{ $value->id }}" @if($value->value == 1)checked="checked"@endif>
                </label>
            </div>
        @endif
    </td>
    @include('constants.inc.td_move_to',['id'=>$value->id])
    <td>{{ $value->description }}</td>
    @include('constants.inc.td_delete',['id'=>$value->id])
</tr>
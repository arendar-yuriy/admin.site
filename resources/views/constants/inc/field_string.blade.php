<tr>
    <td style="width: 20%;">{{ $value->name }}</td>

    @include('constants.inc.td_published',['value'=>$value])

    <td>
        @if(Auth::user()->can([$controller.'-add-delete',$controller.'-edit']))
            <a id="text-field-{{ $value->id }}" data-type="text" data-inputclass="form-control" data-pk="1" >{{ $value->value }}</a>
            <script>
                $(document).ready(function(){
                    $('#text-field-{{ $value->id }}').editable({
                        url: '{{ route('update_constants',['id'=> $value->id ]) }}'
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
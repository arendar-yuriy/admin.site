<tr>
    <?php $values = explode(',',$value->values)?>
    <?php $val = array(); foreach($values as $i) $val[$i] = $i;?>
    <td style="width: 20%;">{{ $value->name }}</td>

    @include('constants.inc.td_published',['value'=>$value])

    <td>
        @if(Auth::user()->can([$controller.'-add-delete',$controller.'-edit']))
            <a id="select-field-{{ $value->id }}" data-type="select" data-value="{{ $value->value }}" data-source="{{ json_encode($val) }}" data-inputclass="form-control" data-pk="1" >{{ $value->value }}</a>
            <script>
                $(document).ready(function(){

                    $('#select-field-{{ $value->id }}').editable({
                        url: '{{ route('update_constants',['id'=> $value->id ]) }}'

                    });

                });
            </script>
        @else
            <p>
                {{ $value->value }}
            </p>
        @endif
    </td>
        @include('constants.inc.td_move_to',['id'=>$value->id])
        <td>{{ $value->description }}</td>
        @include('constants.inc.td_delete',['id'=>$value->id])
</tr>


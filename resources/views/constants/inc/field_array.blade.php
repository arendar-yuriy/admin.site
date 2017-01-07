<tr>
    <td style="width: 20%;">{{ $value->name }}</td>

    @include('constants.inc.td_published',['value'=>$value])

    <td>
        @if(Auth::user()->can([$controller.'-add-delete',$controller.'-edit']))
            @foreach(json_decode($value->value) as $key => $val)
                <p>
                    <b>{{ $key }} :</b>&nbsp;
                    <a  id="{{ $key }}" data-type="textarea" class="mass-edit-{{ $value->id }}" data-inputclass="form-control" data-pk="1" >{{ $val }}</a>
                </p>
            @endforeach

            <script>
                $(document).ready(function(){
                    $('.mass-edit-{{ $value->id }}').each(function() {
                        $(this).editable({
                            url: '{{ route('update_constants',['id'=> $value->id ]) }}'
                        });
                    });
                });
            </script>

        @else
            @foreach(json_decode($value->value) as $key => $val)
                <p>
                    <b>{{ $key }} :</b>&nbsp;
                    <span>{{ $val }}</span>
                </p>
            @endforeach
        @endif
    </td>
    @include('constants.inc.td_move_to',['id'=>$value->id])
    <td>{{ $value->description }}</td>
    @include('constants.inc.td_delete',['id'=>$value->id])
</tr>
@if(Auth::user()->can([$controller.'-add-delete',$controller.'-edit']))

<td class="text-center">
    <span style="display: none;">{{ $value->published }}</span>
    <span class="checkbox checkbox-switchery switchery-xs active-button">
        <input type="checkbox" data-id="{{ $value->id }}" class="switchery-primary change-active-row-{{ $value->id }}" @if($value->published)checked="checked"@endif>
    </span>
</td>
<script>
    $(document).ready(function(){
        $('.change-active-row-{{ $value->id }}').on('change',function(){
            var url = '{{ route('active_'.$controller,['id'=>$value->id]) }}';
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

@else
    <td class="text-center">
        <span style="display: none;">{{ $value->published }}</span>
        <span class="checkbox checkbox-switchery switchery-xs active-button">
            <input type="checkbox" disabled data-id="{{ $value->id }}" class="switchery-primary change-active-row-{{ $value->id }}" @if($value->published)checked="checked"@endif>
        </span>
    </td>
@endif
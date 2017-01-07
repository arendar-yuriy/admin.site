<tr>
    <?php $values = explode(',',$value->values)?>
    <?php $val = array(); foreach($values as $i) $val[$i] = $i;?>

    <td>{{ $value->name }}</td>

    @include('constants.inc.td_published',['value'=>$value])

    <td>
        @if(Auth::user()->can([$controller.'-add-delete',$controller.'-edit']))
            <a href="#" id="checkbox-unordered-list-{{ $value->id }}" data-value="{{ $value->value }}" data-source="{{ json_encode($val) }}" data-type="checklist" data-pk="1" >[{{ trans('app.Edit') }}]</a>
            <div id="list{{ $value->id }}"></div>
            <script>
                $(document).ready(function(){
                    $('#checkbox-unordered-list-{{ $value->id }}').editable({
                        url: '{{ route('update_constants',['id'=> $value->id ]) }}',
                        display: function(value, sourceData) {
                            var $el = $('#list{{ $value->id }}'),
                                    checked, html = '';
                            if(!value) {
                                $el.empty();
                                return;
                            }

                            checked = $.grep(sourceData, function(o){
                                return $.grep(value, function(v){
                                    return v == o.value;
                                }).length;
                            });

                            $.each(checked, function(i, v) {
                                html+= '<li>'+$.fn.editableutils.escape(v.text)+'</li>';
                            });

                            if(html) html = '<ul class="list list-unstyled" style="margin-top: 10px;">'+html+'</ul>';
                            $el.html(html);
                        },
                        showbuttons: 'bottom',
                        tpl: '<div class="checkbox"></div>'
                    });

                    $('#checkbox-unordered-list-{{ $value->id }}').on('shown', function(e, editable) {
                        editable.input.$input.uniform();
                    });

                });
            </script>
        @else
            <div id="list{{ $value->id }}">
                <ul class="list list-unstyled" style="margin-top: 10px;">
                    @foreach(explode(',',$value->value) as $x)
                        <li>{{ $x }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </td>
        @include('constants.inc.td_move_to',['id'=>$value->id])
    <td>{{ $value->description }}</td>
        @include('constants.inc.td_delete',['id'=>$value->id])
</tr>



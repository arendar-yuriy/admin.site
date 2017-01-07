<tr>
    <td style="width: 20%;">{{ $value->name }}</td>

    @include('constants.inc.td_published',['value'=>$value])

    <td>
        @if(Auth::user()->can([$controller.'-add-delete',$controller.'-edit']))
            <a id="add-file{{ $value->id }}" data-type="text" data-inputid="add-file{{ $value->id }}" data-inputclass="form-control" data-pk="1" data-title="Simple text field">{{ $value->value }}</a>
            <script>
                $(document).on('click','#add-file{{ $value->id }}',function (event) {
                    event.preventDefault();
                    var updateID = $(this).attr('data-inputid'); // Btn id clicked
                    var elfinderUrl = '/elfinder/popup/';

                    // trigger the reveal modal with elfinder inside
                    var triggerUrl = elfinderUrl + updateID;
                    $.colorbox({
                        href: triggerUrl,
                        fastIframe: true,
                        iframe: true,
                        width: '90%',
                        height: '80%'
                    });

                });
                // function to update the file selected by elfinder
                function processSelectedFile(filePath, requestingField) {
                    $('#'+requestingField).html(filePath);
                    $.ajax({
                        url: '{{ route('update_constants',['id'=> $value->id ]) }}',
                        dataType:'json',
                        method:'post',
                        data: {value:filePath}
                    });
                }
            </script>
        @else
            <p>{{ $value->value }}</p>
        @endif
    </td>
    @include('constants.inc.td_move_to',['id'=>$value->id])
    <td>{{ $value->description }}</td>
    @include('constants.inc.td_delete',['id'=>$value->id])
</tr>
@if(Auth::user()->can([$controller.'-add-delete',$controller.'-edit']))
    <td class="text-center"><a href="{{ Route('edit_'.$controller, ['id'=>$aRow['id']]) }}"><i class="icon-pen"></i></a></td>
@else
    <td class="text-center"><a href="{{ Route('edit_'.$controller, ['id'=>$aRow['id']]) }}"><i class=" icon-eye"></i></a></td>
@endif
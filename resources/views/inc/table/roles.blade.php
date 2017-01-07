<td class="text-center">
    @foreach(\App\User::find($aRow['id'])->roles as $role)
        <span class="label label-info">{{ $role->display_name }}</span>
    @endforeach
</td>

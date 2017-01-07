<?php $status = Config::get('admin.')?>
<td><span class="label label-{{ Config::get('admin.content_type.'.$aRow['type'].'.label') }}">{{ trans('app.'.$aRow['type']) }}</span></td>
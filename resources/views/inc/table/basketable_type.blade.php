<?php
$name = explode('\\',$aRow[$key]);
$name = end($name);
?>
<td>{{ trans('basket.'.$name) }}</td>
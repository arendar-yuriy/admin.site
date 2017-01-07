<form class="form-horizontal" method="post" onsubmit="return Main.formSubmit(this);" action="{{ route('comments_add') }}">
    @include($controller.'.form')
</form>
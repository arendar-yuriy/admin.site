@if(Auth::user() !== null)
    <li class="dropdown dropdown-user">
        <a class="dropdown-toggle" data-toggle="dropdown">
            @if(!Auth::user()->image)
                {!! MediaImage::getImage('',28,28) !!}
            @else
                {!! MediaImage::getImage(Auth::user()->image,28,28,['crop'=>Auth::user()->is_crop]) !!}
            @endif
            <span>{{ Auth::user()->name }}</span>
            <i class="caret"></i>
        </a>

        <ul class="dropdown-menu dropdown-menu-right">
            <li><a href="{{ route('edit_users',['id'=>Auth::user()->id]) }}"><i class="icon-user"></i>{{ trans('app.My profile') }} </a></li>
            <li><a href="{{ route('edit_users_passwords',['id'=>Auth::user()->id]) }}"><i class=" icon-lock2"></i> {{ trans('app.Change password') }}</a></li>
            <li><a href="{{ route('users_activity',['id'=>Auth::user()->id]) }}"><i class="icon-sort-time-desc"></i> {{ trans('activity.User activity') }}</a></li>
            <li class="divider"></li>
            <li><a href="{{ url('/logout') }}"><i class="icon-switch2"></i> {{ trans('app.Logout') }}</a></li>
        </ul>
    </li>
@endif
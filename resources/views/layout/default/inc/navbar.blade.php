<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.html"><img src="/img/logo_light.png" alt=""></a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
            <li>
                <a href="{{ route('basket') }}" title="{{ trans('app.Basket') }}" >
                    <i class="icon-bin"></i>
                    <span class="visible-xs-inline-block position-right">{{ trans('app.Basket') }}</span>
                    <span class="badge bg-warning-400">{{ \App\Basket::count() }}</span>
                </a>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">

            @include('layout.default.inc.select_lang')

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class=" icon-bubble-lines4"></i>
                    <span class="visible-xs-inline-block position-right">{{ trans('app.feedback') }}</span>
                    <span class="badge bg-warning-400">{{ \App\Feedback::where('status','new')->count() }}</span>
                </a>

                <div class="dropdown-menu dropdown-content width-350">
                    <div class="dropdown-content-heading">
                        {{ trans('app.feedback') }}
                    </div>

                    <ul class="media-list dropdown-content-body">
                        @foreach(\App\Feedback::where('status','new')->orderBy('created_at','desc')->limit(5)->get() as $item)
                            <li class="media">

                                <div class="media-body">
                                    <a href="{{ route('edit_feedback',['id'=>$item->id]) }}" class="media-heading">
                                        <span class="text-semibold">{{ $item->name }}</span>
                                        <span class="media-annotation pull-right">{{ $item->created_at->diffForHumans() }}</span>
                                    </a>

                                    <span class="text-muted">{{ cutText($item->content,100) }}</span>
                                </div>
                            </li>
                        @endforeach

                    </ul>

                    <div class="dropdown-content-footer">
                        <a href="{{ route('feedback') }}" data-popup="tooltip" title="{{ trans('app.feedback') }}"><i class="icon-menu display-block"></i></a>
                    </div>
                </div>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-bubbles4"></i>
                    <span class="visible-xs-inline-block position-right">{{ trans('app.comments') }}</span>
                    <span class="badge bg-warning-400">{{ \App\Comments::where('status','new')->count() }}</span>
                </a>

                <div class="dropdown-menu dropdown-content width-350">
                    <div class="dropdown-content-heading">
                        {{ trans('app.comments') }}
                    </div>

                    <ul class="media-list dropdown-content-body">
                        @foreach(\App\Comments::where('status','new')->orderBy('created_at','desc')->limit(5)->get() as $item)
                            <li class="media">
                                <div class="media-left">
                                    @if($item->user_id === null)
                                        <img src="{{ \Config::get('app.site_url').'/img/design/rs-avatar-64x64.jpg' }}" class="img-circle img-sm" alt="">
                                    @else
                                        @if($item->user !== null)
                                            {!! getImage($item->user->socials()->where('name', $item->user->social_network)->first()->photo,64,64,['class'=>'img-circle img-sm','alt'=>$item->user->name]) !!}
                                        @else
                                            <img src="{{ \Config::get('app.site_url').'/img/design/rs-avatar-64x64.jpg' }}" class="img-circle img-sm" alt="">
                                        @endif
                                    @endif

                                    @if($item->user !== null)
                                        <span class="badge bg-danger-400 media-badge">{{ $item->user->comments->count() }}</span>
                                    @endif
                                </div>

                                <div class="media-body">
                                    <a href="{{ route('comments',['id'=>$item->content_id,'type'=>$item->type]) }}" class="media-heading">
                                        <span class="text-semibold">{{ $item->name }}</span>
                                        <span class="media-annotation pull-right">{{ $item->created_at->diffForHumans() }}</span>
                                    </a>

                                    <span class="text-muted">{{ cutText($item->comment,100) }}</span>
                                </div>
                            </li>
                        @endforeach

                    </ul>

                    <div class="dropdown-content-footer">
                        <a href="{{ route('comments',['type'=>'content']) }}" data-popup="tooltip" title="{{ trans('app.comments content') }}"><i class="icon-menu display-block"></i></a>
                    </div>
                    <div class="dropdown-content-footer">
                        <a href="{{ route('comments',['type'=>'gallery']) }}" data-popup="tooltip" title="{{ trans('app.comments gallery') }}"><i class="icon-menu display-block"></i></a>
                    </div>
                </div>
            </li>

            @include('layout.default.inc.user_menu')
        </ul>
    </div>
</div>
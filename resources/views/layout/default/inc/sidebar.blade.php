<div class="sidebar sidebar-main sidebar-fixed">
    <div class="sidebar-content">
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">
                    <li><a href="{{ Config::get('app.site_url') }}" target="_blank"><i class="icon-arrow-up-right32"></i> <span>{{ trans('app.Open site') }}</span></a></li>
                    <li class="navigation-header"><span>{{ trans('app.Home') }}</span> <i class="icon-menu" title="" data-original-title="{{ trans('app.Home') }}"></i></li>
                    <li @if($classController == 'IndexController') class="active" @endif><a href="{{ LaravelLocalization::getLocalizedURL( LaravelLocalization::getCurrentLocale(),'/') }}"><i class="icon-home4"></i> <span>{{ trans('app.dashboard') }}</span></a></li>

                    @permission(['content-view','structure-view','blocks-view','gallery-view','tags-view'])
                        <li class="navigation-header"><span>{{ trans('app.content') }}</span> <i class="icon-menu" title="" data-original-title="{{ trans('app.content') }}"></i></li>
                    @endpermission

                    @permission('structure-view')
                        <li @if($classController == 'StructureController') class="active" @endif><a href="{{ LaravelLocalization::getLocalizedURL( LaravelLocalization::getCurrentLocale(),'/structure') }}"><i class="icon-tree7"></i> <span>{{ trans('app.structure') }}</span></a></li>
                    @endpermission

                    @permission('blocks-view')
                        <li @if($classController == 'BlocksController') class="active" @endif><a href="{{ LaravelLocalization::getLocalizedURL( LaravelLocalization::getCurrentLocale(),'/blocks') }}"><i class="icon-newspaper"></i> <span>{{ trans('app.blocks') }}</span></a></li>
                    @endpermission

                    @permission('content-view')
                        {!! $tree_structure !!}
                    @endpermission

                    @permission('gallery-view')
                        {!! $tree_folders !!}
                    @endpermission

                    @permission('tags-view')
                        <li @if($classController == 'TagsController') class="active" @endif><a href="{{ LaravelLocalization::getLocalizedURL( LaravelLocalization::getCurrentLocale(),'/tags') }}"><i class="icon-price-tags"></i> <span>{{ trans('app.tags') }}</span></a></li>
                    @endpermission


                    @permission('sliders-view')
                    <li @if($classController == 'SlidersController') class="active" @endif ><a href="{{ route('sliders') }}"><i class=" icon-film"></i> <span>{{ trans('app.Sliders') }}</span></a></li>
                    @endpermission

                    @permission(['feedback-view','comments-view'])
                        <li class="navigation-header"><span>{{ trans('app.feedback') }}</span> <i class="icon-menu" title="" data-original-title="{{ trans('app.feedback') }}"></i></li>
                    @endpermission

                    @permission('feedback-view')
                        <li @if($classController == 'FeedbackController') class="active" @endif><a href="{{ LaravelLocalization::getLocalizedURL( LaravelLocalization::getCurrentLocale(),'/feedback') }}"><i class=" icon-bubble-lines4"></i> <span>{{ trans('app.feedback') }} </span><span class="label bg-danger-400">{{ \App\Feedback::where('status','new')->count() }}</span></a></li>
                    @endpermission

                    @permission('comments-view')
                        <li @if($classController == 'CommentsController' && Route::current()->parameter('type')=='content') class="active" @endif><a href="{{ route('comments',['type'=>'content']) }}"><i class="  icon-bubbles4"></i> <span>{{ trans('app.comments content') }} </span><span class="label bg-danger-400">{{ \App\Comments::where('status','new')->where('type','content')->count() }}</span></a></li>
                        <li @if($classController == 'CommentsController' && Route::current()->parameter('type')=='gallery') class="active" @endif><a href="{{ route('comments',['type'=>'gallery']) }}"><i class="  icon-bubbles4"></i> <span>{{ trans('app.comments gallery') }} </span><span class="label bg-danger-400">{{ \App\Comments::where('status','new')->where('type','gallery')->count() }}</span></a></li>
                    @endpermission

                    @permission(['constants-view','roles-view','permissions-view'])
                    <li class="navigation-header"><span>{{ trans('app.settings') }}</span> <i class="icon-menu" title="" data-original-title="{{ trans('app.settings') }}"></i></li>
                    @endpermission

                    @permission('constants-view')
                        <li @if($classController == 'ConstantsController')class="active" @endif><a href="#"><i class=" icon-cog3"></i><span>{{ trans('app.constants') }}</span></a>
                            <ul>
                                @foreach(Config::get('admin.constants_group') as $key=>$group)
                                    <li @if(Route::current() !== null && Route::current()->parameter('group') == $key) class="active" @endif ><a href="{{ route('constants',['group'=>$key]) }}">{{ trans('constant.'.$group) }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endpermission

                    @permission('roles-view')
                    <li @if($classController == 'RolesController') class="active" @endif><a href="{{ route('roles') }}"><i class=" icon-user-check"></i> <span>{{ trans('app.Roles') }}</span> </a></li>
                    @endpermission

                    @permission('permissions-view')
                    <li @if($classController == 'PermissionsController') class="active" @endif><a href="{{ route('permissions') }}"><i class="icon-user-lock"></i> <span>{{ trans('app.Permissions') }} </span> </a></li>
                    @endpermission

                    @permission(['users-view'])
                    <li class="navigation-header"><span>{{ trans('app.users') }}</span> <i class="icon-menu" title="" data-original-title="{{ trans('app.users') }}"></i></li>
                    @endpermission

                    @permission('users-view')
                    <li @if($classController == 'UsersController') class="active" @endif ><a href="{{ route('users') }}"><i class=" icon-users4"></i> <span>{{ trans('app.Users') }}</span></a></li>
                    @endpermission

                    @permission('siteusers-view')
                    <li @if($classController == 'SiteUsersController') class="active" @endif ><a href="{{ route('siteusers') }}"><i class=" icon-users2"></i> <span>{{ trans('app.Site Users') }}</span></a></li>
                    @endpermission


                </ul>
            </div>
        </div>
    </div>
</div>
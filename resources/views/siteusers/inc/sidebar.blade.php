<div class="col-lg-3">

    <div class="thumbnail">
        <div class="thumb thumb-rounded thumb-slide">
            <?php
                $socials = $content->socials()->where('name', $content->social_network)->first();
                if ($socials !== null)
                    $photo = $socials->photo;
            ?>
            @if(!empty($photo))
                {!! getImage($photo,211,211,['id'=>'avatar','crop'=>$content->is_crop,'alt'=>$content->name.' '.$content->lastname]) !!}
            @else
                <img id="avatar" src="/img/placeholder.jpg" alt="{{ $content->name }} {{ $content->lastname }}">
            @endif

        </div>

        <div class="caption text-center">
            <h6 class="text-semibold no-margin">{{ $content->name }} {{ $content->lastname }}</h6>

            <ul class="icons-list mt-15">
                @foreach($content->socials()->get() as $item)
                    <li><a target="_blank" href="{{ $item->link }}" data-popup="tooltip" title="{{ $item->name }}"><i class="{{ Config::get('admin.social_icons.'.$item->name) }}"></i></a></li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="panel panel-flat pb-5">
        <div class="media-body">

            <div class="list-group no-border no-padding-top">
                <a href="{{ route('edit_siteusers',['id'=>Route::current()->parameter('id')]) }}" class="list-group-item"><i class=" icon-cogs"></i> {{ trans('app.settings') }}</a>
                @permission([$controller.'-add-delete',$controller.'-edit'])
                    <a href="{{ route('edit_siteusers_passwords',['id'=>Route::current()->parameter('id')]) }}" class="list-group-item"><i class=" icon-lock2"></i> {{ trans('app.Change password') }}</a>
                @endpermission
                <a href="{{ route('siteusers_activity',['id'=>Route::current()->parameter('id')]) }}" class="list-group-item"><i class=" icon-sort-time-desc"></i> {{ trans('activity.User activity') }}</a>
                <a href="{{ route('siteusers_socials',['id'=>Route::current()->parameter('id')]) }}" class="list-group-item"><i class="icon-earth"></i> {{ trans('app.Social networks') }}</a>
            </div>
        </div>

    </div>


</div>
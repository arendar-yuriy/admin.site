<div class="sidebar-detached" >
    <div class="sidebar sidebar-default">
        <div class="sidebar-content">

            @if(isset($listStructures))

                @foreach($listStructures as $structure)

                    <div class="sidebar-category">
                        <div class="category-title">
                            <span>{{ $structure->name }}</span>
                            <ul class="icons-list">
                                <li><a href="#" data-action="collapse"></a></li>
                            </ul>
                        </div>

                        <div class="category-content no-padding">
                            <ul class="navigation navigation-alt navigation-accordion">
                                @foreach($structure->contents as $item)
                                    @if($item->comments->count() > 0)
                                        <li @if($item->id == $content_id)class="active" @endif><a href="{{ route('comments',['id'=>$item->id,'type'=>'content']) }}"> {{ $item->name }} <span class="label label-success">{{ $item->comments->count() }}</span></a></li>
                                    @endif
                                @endforeach

                            </ul>
                        </div>
                    </div>

                @endforeach

            @endif

            @if(isset($listGallery))

                    <div class="sidebar-category">
                        <div class="category-title ">
                            <span>{{ trans('app.Comments gallery') }}</span>
                            <ul class="icons-list">
                                <li><a href="#" data-action="collapse"></a></li>
                            </ul>
                        </div>

                        <div class="category-content no-padding">
                            <ul class="navigation navigation-alt navigation-accordion">
                                @foreach($listGallery as $item)
                                    @if(\App\Comments::where('content_id',$item->id)->where('type','gallery')->count() > 0)
                                        <li @if($item->id == $content_id)class="active" @endif><a href="{{ route('comments',['id'=>$item->id,'type'=>'gallery']) }}"> {{ $item->name }} <span class="label label-success">{{ \App\Comments::where('content_id',$item->id)->where('type','gallery')->count() }}</span></a></li>
                                    @endif
                                @endforeach

                            </ul>
                        </div>
                    </div>

            @endif


        </div>
    </div>
</div>

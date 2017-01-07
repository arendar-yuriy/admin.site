<?php $i=0 ?>
@foreach($content->children as $key=>$value)


    @if($i==0)
        <div class="row">
    @endif
            <div class="col-lg-3 col-sm-6">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h6 class="panel-title">&nbsp;{{ $value->name }}</h6>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="move"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="thumbnail" style="margin-bottom: 0">
                        <div class="thumb">
                            <img src="{{ Config::get('admin.image_url').$value->image }}" alt="">
                            <div class="caption-overflow">
                            <span>
                                <a href="{{ Config::get('admin.image_url').$value->image }}" data-popup="lightbox" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
                                <a href="#" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5"><i class="icon-link2"></i></a>
                            </span>
                            </div>
                        </div>

                        <div class="caption">
                            {{ $value->name }}
                        </div>
                    </div>

                </div>

            </div>
        <?php $i++;?>
    @if($i==4 || ($key == (count($content->children->toArray())-1)))
        <?php $i=0?>
        </div>
    @endif

@endforeach



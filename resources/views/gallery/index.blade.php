@extends('layout.default.main')

@section('central')

    <?php $i=0 ?>
    @foreach($listFolders as $key=>$value)


        @if($i==0)
            <div class="row">
                @endif
                <div class="col-lg-3 col-sm-6">
                    <div class="thumbnail">
                        <div class="thumb">
                            @if($value->image)
                                <img src="{{ Config::get('admin.image_url').$value->image }}" alt="">
                            @else
                                <img src="/img/placeholder.jpg" alt="">
                            @endif
                            <div class="caption-overflow">
										<span>
                                            @if($value->image)
                                                <a href="{{ Config::get('admin.image_url').$value->image }}" data-popup="lightbox" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class=" icon-zoomin3"></i></a>
                                            @endif

											<a href="{{ route('edit_gallery',['id'=>$value->id]) }}" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5"><i class="icon-folder"></i></a>
										</span>
                            </div>
                        </div>

                        <div class="caption">
                            <h6 class="no-margin-top text-semibold"><a href="{{ route('edit_gallery',['id'=>$value->id]) }}" class="text-default">{{ $value->name }}</a> <a href="#" class="text-muted"><i class="icon-download pull-right"></i></a></h6>
                            {{ $value->description }}
                        </div>
                    </div>
                </div>
                <?php $i++;?>
                @if($i==4 || ($key == (count($listFolders)-1)))
                    <?php $i=0?>
            </div>
        @endif

    @endforeach


@endsection
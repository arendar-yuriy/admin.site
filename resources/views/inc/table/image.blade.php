<td>
    @if(!empty($aRow['image']))
        <a href="{{ Config::get('admin.image_url').$aRow['image'] }}" data-popup="lightbox">
            {!! MediaImage::getImage($aRow['image'],94,null,['class'=>'img-rounded']) !!}
        </a>
    @else
        {!! MediaImage::getImage('',94,null,['class'=>'img-rounded']) !!}
    @endif
</td>


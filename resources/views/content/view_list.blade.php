<fieldset class="content-group">
    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.name') }}</label>
        <div class="col-lg-10">
            <h2>{{ $translation->name }}</h2>
        </div>
    </div>


    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.description') }}</label>
        <div class="col-lg-10">
            <p>{{ $translation->description }}</p>
        </div>
    </div>


    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.text') }}</label>
        <div class="col-lg-10">
            {!! Form::textarea('text', @$translation->text ,['class'=>'ckeditor form-control','id'=>'text','cf'=>'true']) !!}
            <div class="form-control-feedback" id="text-error-icon">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block" id="text-error"></span>
        </div>
    </div>
    <script>
        var editor = CKEDITOR.replace( 'text',{
            filebrowserBrowseUrl : '/elfinder/ckeditor',
            contentsCss : '{{ env('CKEDITOR_CSS') }}',
            language: '{{ LaravelLocalization::getCurrentLocale() }}',
            readOnly : true
        } );
    </script>


    @if($translation->image)
        <div class="form-group ">
            <label class="control-label col-lg-2 text-semibold">{{ trans('app.image') }}</label>
            <div class="col-lg-2">
                <div class="thumbnail">
                    <div class="thumb">
                        <a href="{{ getImageUrl($translation->image) }}" data-popup="lightbox">
                            {!! getImage($translation->image,218) !!}
                        </a>
                    </div>
                </div>

            </div>

        </div>
    @endif

    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.tags') }}</label>
        <div class="col-lg-10">
            @foreach($tags as $tag)
                @if(in_array($tag->id,$tagsList)) <p>{{ $tag->text }}</p> @endif
            @endforeach
        </div>
    </div>

    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.alias_customer') }}</label>
        <div class="col-lg-10" style="padding-left: 0;">
            <p>{{ $content->alias_customer }}</p>
        </div>
    </div>

    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.alias_en') }}</label>
        <div class="col-lg-10">
            <p>{{ $content->alias_en }}</p>
        </div>
    </div>

    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.alias_ru') }}</label>
        <div class="col-lg-10">
           <p>
               {{ @$content->alias_ru }}
           </p>
        </div>
    </div>

</fieldset>




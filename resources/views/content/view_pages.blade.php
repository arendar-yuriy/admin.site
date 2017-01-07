<fieldset class="content-group">
    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.name') }}</label>
        <div class="col-lg-10">
            <h2>{{ $translation->name }}</h2>
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
                        <a href="{{ MediaImage::getImageUrl($translation->image) }}" data-popup="lightbox">
                            {!! MediaImage::getImage($translation->image,218) !!}
                        </a>
                    </div>
                </div>

            </div>

        </div>
    @endif

</fieldset>



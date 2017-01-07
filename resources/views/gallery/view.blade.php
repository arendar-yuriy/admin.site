<fieldset class="content-group">
    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.name') }}</label>
        <div class="col-lg-10">
            <h2>{{ $translation->name }}</h2>
        </div>
    </div>



    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.parent_id') }}</label>
        <div class="col-lg-10">
            <p>{{ \App\Gallery::find($content->parent_id)->name }}</p>
        </div>
    </div>



    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.description') }}</label>
        <div class="col-lg-10">
            {!! Form::textarea('description', @$translation->description ,['class'=>'ckeditor form-control','id'=>'description','cf'=>'true']) !!}
            <div class="form-control-feedback" id="description-error-icon">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block" id="description-error"></span>
        </div>
    </div>
    <script>
        var editor = CKEDITOR.replace( 'description',{
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

    @if(@$content->structure_id == null)

        <div class="form-group ">
            <label class="control-label col-lg-2 text-semibold">{{ trans('app.alias_customer') }}</label>
            <div class="col-lg-10" style="padding-left: 0;">

                <div class="col-lg-11" >
                    <p>{{ $content->alias_customer }}</p>
                </div>
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
                <p>{{ $content->alias_ru }}</p>
            </div>
        </div>

    @endif

</fieldset>
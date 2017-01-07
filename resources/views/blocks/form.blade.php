<fieldset class="content-group">

    @include('inc.published',['published'=>@$content->published])

    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.name') }}</label>
        <div class="col-lg-10">
            {!! Form::text('name', @$translation->name ,['class'=>'form-control','id'=>'name','cf'=>'true']) !!}
            <div class="form-control-feedback" id="name-error-icon">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block" id="name-error"></span>
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
            language: '{{ LaravelLocalization::getCurrentLocale() }}'

        } );
    </script>

    @if(@$translation->image)
        {!! \App\Helpers\Main::getImageField('image',$translation->image,trans('app.image'),$translation->is_crop) !!}
    @else
        {!! \App\Helpers\Main::getImageField('image','',trans('app.image')) !!}
    @endif

    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.alias') }}</label>
        <div class="col-lg-10">
            {!! Form::text('alias', @$content->alias ,['class'=>'form-control','id'=>'alias','cf'=>'true']) !!}
            <div class="form-control-feedback" id="alias-error-icon">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block" id="alias-error"></span>
        </div>
    </div>

</fieldset>

{!! Form::hidden('locale',\App\Helpers\FormLang::getCurrentLang()) !!}
{!! Form::hidden('type','blocks') !!}

<div class="text-right">
    <button type="submit" class="btn btn-primary">{{ trans('app.submit') }} <i class="icon-arrow-right14 position-right"></i></button>
</div>




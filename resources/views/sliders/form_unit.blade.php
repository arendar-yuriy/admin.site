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
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.description') }}</label>
        <div class="col-lg-10">
            {!! Form::textarea('description', @$translation->description ,['class'=>'form-control ckeditor','id'=>'description','cf'=>'true']) !!}
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
            language: '{{ LaravelLocalization::getCurrentLocale() }}'
        } );
    </script>


    @if(@$content->image)
        {!! imageField('image',$content->image,trans('app.image'),$translation->is_crop) !!}
    @else
        {!! imageField('image','',trans('app.image')) !!}
    @endif



</fieldset>

{!! Form::hidden('locale',\App\Helpers\FormLang::getCurrentLang()) !!}



@if(Route::current()->getName() == 'sliders_add_unit')
    {!! Form::hidden('position',@$content->position ? $content->position : 0) !!}
@else
    {!! Form::hidden('position',@$content->position) !!}
@endif

@if(Route::current()->getName() == 'sliders_add_unit')
    {!! Form::hidden('slider_id',Route::current()->parameter('id')) !!}
@else
    {!! Form::hidden('slider_id',@$content->slider_id) !!}
@endif

<div class="text-right">
    <a href="{{ route('edit_sliders',['id'=>@$content->slider->id]) }}" class="btn btn-success"><i class="icon-arrow-left13 position-left"></i> {{ trans('app.back') }}</a>
    @if(@$content->id)
        <a href="{{ route('sliders_add_unit',['id'=>@$content->slider->id]) }}" class="btn btn-danger">{{ trans('app.Add new slide') }} <i class=" icon-add position-left position-right"></i></a>
    @endif
    <button type="submit" class="btn btn-primary">{{ trans('app.submit') }} <i class="icon-arrow-right14 position-right"></i></button>
</div>




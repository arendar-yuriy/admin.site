<fieldset class="content-group">

    @include('inc.published',['published'=>@$content->published])

    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.date_published') }}</label>
        <div class="col-lg-10">
            <div class="input-group">
            <span class="input-group-addon"><i class=" icon-calendar22"></i></span>
                {!! Form::text('date_published', @$content->date_published ? date('d F, Y',strtotime($content->date_published)) : date('d F, Y'),['class'=>'form-control','id'=>'date_published','cf'=>'true']) !!}
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#date_published').pickadate();
        });
    </script>

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
            {!! Form::textarea('description', @$translation->description ,['class'=>'form-control','id'=>'description','cf'=>'true']) !!}
            <div class="form-control-feedback" id="description-error-icon">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block" id="description-error"></span>
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
        {!! imageField('image',$translation->image,trans('app.image'),$translation->is_crop) !!}
    @else
        {!! imageField('image','',trans('app.image')) !!}
    @endif

    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.tags') }}</label>
        <div class="col-lg-10">
            <select name="tags[]" cf="true" class="select-multiple-tags" multiple="multiple">
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" @if(in_array($tag->id,$tagsList)) selected @endif>{{ $tag->text }}</option>
                @endforeach

            </select>
            <div class="form-control-feedback" id="tags-error-icon">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block" id="tags-error"></span>
        </div>
    </div>

    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.alias_customer') }}</label>
        <div class="col-lg-10" style="padding-left: 0;">
            <div class="col-lg-1" >
                <input type="radio" cf="true" name="alias_priority" value="1" @if(@$content->alias_priority == 1) checked="checked" @endif class="control-primary">
            </div>

            <div class="col-lg-11" >
                {!! Form::text('alias_customer', @$content->alias_customer ,['class'=>'form-control pull-right','id'=>'alias_customer','cf'=>'true']) !!}

                <div class="form-control-feedback" id="alias_customer-error-icon">
                    <i class="icon-cancel-circle2"></i>
                </div>
                <span class="help-block" id="alias_customer-error"></span>
            </div>
        </div>
    </div>

    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.alias_en') }}</label>
        <div class="col-lg-10">
            <label>
                <input type="radio" cf="true" name="alias_priority" value="2" @if(@$content->alias_priority == 2 || !@$content->alias_priority) checked="checked" @endif class="control-primary" >
                {{ @$content->alias_en }}
                {!! Form::hidden('alias_en',@$content->alias_en) !!}
            </label>
        </div>
    </div>

    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.alias_ru') }}</label>
        <div class="col-lg-10">
            <label>
                <input type="radio" cf="true" name="alias_priority" value="3" @if(@$content->alias_priority == 3) checked="checked" @endif class="control-primary" >
                {{ @$content->alias_ru }}
                {!! Form::hidden('alias_ru',@$content->alias_ru) !!}
            </label>
        </div>
    </div>

</fieldset>

{!! Form::hidden('locale',\App\Helpers\FormLang::getCurrentLang()) !!}
{!! Form::hidden('type','list') !!}

<div class="text-right">
    <button type="submit" class="btn btn-primary">{{ trans('app.submit') }} <i class="icon-arrow-right14 position-right"></i></button>
</div>




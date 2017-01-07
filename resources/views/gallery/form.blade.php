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
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.parent_id') }}</label>
        <div class="col-lg-10">
            <select name="parent_id" cf="true" class="select" id="parent_id">
                <option value="" >{{ trans('app.select') }}</option>
                @foreach($list_folder as $value)
                    @if($value != @$content->id)
                        <option value="{{ $value }}" @if($value == @$content->parent_id)selected="selected"@endif>{{ \App\Gallery::find($value)->name }}</option>
                    @endif
                @endforeach
            </select>
            <div class="form-control-feedback" id="parent_id-error-icon">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block" id="parent_id-error"></span>
        </div>
    </div>

    @if(@$content->units === null)

        <div class="form-group ">
            <label class="control-label col-lg-2 text-semibold">{{ trans('app.sorting') }}</label>
            <div class="col-lg-10">
                <div class="checkbox checkbox-switchery switchery-sm">
                    <label>

                        <input type="checkbox" id="by_position_switch" class="switchery " @if(@$content->by_position == true)checked="checked"@endif>
                        {!! Form::hidden('by_position',@$content->by_position ? 1 : 0,['id'=>'by_position']) !!}
                    </label>
                </div>

            </div>
        </div>

        <script>
            $(document).ready(function(){
                $('#by_position_switch').on('change',function(){
                    var checked = $(this).prop('checked');

                    checked = (checked) ? 1 : 0;

                    $('#by_position').val(checked);
                });
            });
        </script>

    @endif

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
            language: '{{ LaravelLocalization::getCurrentLocale() }}'
        } );
    </script>

    @if(@$translation->image)
        {!! \App\Helpers\Main::getImageField('image',$translation->image,trans('app.image'),$translation->is_crop) !!}
    @else
        {!! \App\Helpers\Main::getImageField('image','',trans('app.image')) !!}
    @endif
    @if(@$content->structure_id == null)

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

    @endif

</fieldset>

{!! Form::hidden('locale',\App\Helpers\FormLang::getCurrentLang()) !!}

<div class="text-right">
    <button type="submit" class="btn btn-primary">{{ trans('app.submit') }} <i class="icon-arrow-right14 position-right"></i></button>
</div>




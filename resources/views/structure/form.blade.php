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
            <select name="parent_id" cf="true" class="form-control">
                <option value="0">{{ trans('app.select') }}</option>
                @foreach($aTreeStructure as $struct)
                    @if($struct['id'] !== @$content->id)
                        <option value="{{ $struct['id'] }}" @if($struct['id'] == @$content->parent_id) selected @endif>{{ $struct['name'] }}</option>
                        @if(!empty($struct['children']))
                            @foreach($struct['children'] as $struct1)
                                @if($struct1['id'] !== @$content->id)
                                    <option value="{{ $struct1['id'] }}" @if($struct1['id'] == @$content->parent_id) selected @endif>&nbsp;&nbsp;{{ $struct1['name'] }}</option>
                                    @if(!empty($struct1['children']))
                                        @foreach($struct1['children'] as $struct2)
                                            @if($struct2['id'] !== @$content->id)
                                                <option value="{{ $struct1['id'] }}" @if($struct2['id'] == @$content->parent_id) selected @endif>&nbsp;&nbsp;&nbsp;&nbsp;{{ $struct1['name'] }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    @endif
                @endforeach

            </select>
            <div class="form-control-feedback" id="parent_id-error-icon">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block" id="parent_id-error"></span>
        </div>
    </div>

    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.level') }}</label>
        <div class="col-lg-10">
            <select multiple="multiple" cf="true" name="menu_level[]" class="select" id="menu_level">
                @foreach(Config::get('admin.menu_levels') as $value)
                    <option value="{{ $value }}" @if(in_array($value,explode(',',@$content->menu_level)))selected="selected"@endif>{{ trans('app.'.$value) }}</option>
                @endforeach
            </select>
            <div class="form-control-feedback" id="menu_level-error-icon">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block" id="menu_level-error"></span>
        </div>
    </div>

    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.controller') }}</label>
        <div class="col-lg-10">
            <select name="controller"  cf="true" class="select" id="controller">
                <option @if(@$content->controller =='list') selected @endif value="list">{{ trans('app.list') }}</option>
                <option @if(@$content->controller =='pages') selected @endif value="pages">{{ trans('app.pages') }}</option>
                <option @if(@$content->controller =='gallery') selected @endif value="gallery">{{ trans('app.gallery') }}</option>
            </select>
            <div class="form-control-feedback" id="controller-error-icon">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block" id="controller-error"></span>
        </div>
    </div>
    @if(@$content->controller && !empty(Config::get('admin.templates.'.$content->controller)))
        <div class="form-group ">
            <label class="control-label col-lg-2 text-semibold">{{ trans('app.template') }}</label>
            <div class="col-lg-10">
                <select name="template"  cf="true" class="select" id="template">
                    <option value="">{{ trans('app.select') }}</option>
                    @foreach(Config::get('admin.templates.'.$content->controller) as $key=>$value)
                        <option @if(@$content->template == $key) selected @endif value="{{ $key }}">{{ trans('app.'.$value) }}</option>
                    @endforeach
                </select>
                <div class="form-control-feedback" id="controller-error-icon">
                    <i class="icon-cancel-circle2"></i>
                </div>
                <span class="help-block" id="controller-error"></span>
            </div>
        </div>
    @endif

    <script>
        $(document).ready(function () {
            if($('#controller').val() != 'list'){
                $('#field-sort').hide();
            }

            $('#controller').on('change',function () {
                if($(this).val() != 'list'){
                    $('#field-sort').hide();
                }else{
                    $('#field-sort').show();
                }
            });
        });
    </script>

    <div class="form-group " id="field-sort">
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
            language: '{{ LaravelLocalization::getCurrentLocale() }}',
            contentsCss : '{{ env('CKEDITOR_CSS') }}'
        }  );
    </script>

    @if(@$translation->image)
        {!! imageField('image',$translation->image,trans('app.image'),$translation->is_crop) !!}
    @else
        {!! imageField('image','',trans('app.image')) !!}
    @endif

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

<div class="text-right">
    <button type="submit" class="btn btn-primary">{{ trans('app.submit') }} <i class="icon-arrow-right14 position-right"></i></button>
</div>




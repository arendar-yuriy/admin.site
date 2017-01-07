<?php $aMeta = json_decode($translation->metatags,true)?>
<form id="form-meta" class="form-horizontal" method="post" onsubmit="return Main.formSubmit(this);" action="{{ Route('meta_'.$controller, ['id'=>$content->id]) }}">

    <fieldset class="content-group">

        <div class="form-group "  style="margin-bottom: 44px;">
            <label class="control-label col-lg-2 text-semibold">{{ trans('app.Insert tag') }}</label>
            <div class="col-lg-10">
                <div class="input-group">
                    <select id="options_meta" class="form-control">
                        @foreach(Config::get('admin.meta.'.$controller) as $key=>$val)
                            <option value="{{ $key }}">{{ trans('app.'.$val) }}</option>
                        @endforeach

                    </select>
                    <span class="input-group-btn">
                        <button class="btn bg-teal" id="insert" type="button">{{ trans('app.Insert') }}</button>
                    </span>
                </div>
            </div>
            <input id="id_input_field" type="hidden"  value="">
        </div>

        <div class="form-group ">
            <label class="control-label col-lg-2 text-semibold">{{ trans('app.title') }}</label>
            <div class="col-lg-10">
                {!! Form::text('title', @$aMeta['title'] ,['class'=>'form-control','id'=>'title']) !!}
                <div class="form-control-feedback" id="title-error-icon">
                    <i class="icon-cancel-circle2"></i>
                </div>
                <span class="help-block" id="title-error"></span>
            </div>
        </div>


        <div class="form-group ">
            <label class="control-label col-lg-2 text-semibold">{{ trans('app.Description') }}</label>
            <div class="col-lg-10">
                {!! Form::textarea('description', @$aMeta['description'] ,['class'=>'form-control','id'=>'description']) !!}
                <div class="form-control-feedback" id="description-error-icon">
                    <i class="icon-cancel-circle2"></i>
                </div>
                <span class="help-block" id="description-error"></span>
            </div>
        </div>



        <div class="form-group ">
            <label class="control-label col-lg-2 text-semibold">{{ trans('app.keywords') }}</label>
            <div class="col-lg-10">
                <select name="keywords[]" class="select-multiple-keywords" multiple="multiple">
                    @foreach($tags as $tag)
                    <option value="{{ $tag->text }}" @if(isset($aMeta['keywords']) && in_array($tag->text,$aMeta['keywords'])) selected @endif>{{ $tag->text }}</option>
                    @endforeach

                </select>
                <div class="form-control-feedback" id="keywords-error-icon">
                    <i class="icon-cancel-circle2"></i>
                </div>
                <span class="help-block" id="keywords-error"></span>
            </div>
        </div>

        <div class="form-group ">
            <label class="control-label col-lg-2 text-semibold">{{ trans('app.author') }}</label>
            <div class="col-lg-10">
                {!! Form::text('author', @$aMeta['author'] ,['class'=>'form-control','id'=>'author']) !!}
                <div class="form-control-feedback" id="title-error-icon">
                    <i class="icon-cancel-circle2"></i>
                </div>
                <span class="help-block" id="title-error"></span>
            </div>
        </div>

    </fieldset>

    {!! Form::hidden('locale',\App\Helpers\FormLang::getCurrentLang()) !!}

    <div class="text-right">
        <button type="submit" class="btn btn-primary">{{ trans('app.submit') }} <i class="icon-arrow-right14 position-right"></i></button>
    </div>


</form>

<script>
    $(document).ready(function(){
        $('#insert').on('click', function (e) {
            e.preventDefault();
            field = $('#id_input_field').val();
            _insertAtCaret( $('#form-meta').find('#'+field), $('#options_meta').val());
        });

        $('#form-meta').find('textarea').focusout(function(){
            $('#form-meta').find('#id_input_field').val($(this).attr('id'));
        });

        $('#form-meta').find('input[type=text].form-control').on('focusout',function(){
            $('#form-meta').find('#id_input_field').val($(this).attr('id'));
        });
    });


    function _insertAtCaret(element, text) {
        if(element[0]){
            var caretPos = element[0].selectionStart,currentValue = element.val();
            element.val(currentValue.substring(0, caretPos) +  text + currentValue.substring(caretPos));
        }
    }


</script>


<fieldset class="content-group">
    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.alias') }}</label>
        <div class="col-lg-10">
            @if(@$content->name)
                {!! Form::text('name', @$content->name ,['class'=>'form-control','id'=>'name','cf'=>'true','readonly'=>'readonly']) !!}
            @else
                {!! Form::text('name', '' ,['class'=>'form-control','id'=>'name','cf'=>'true']) !!}
            @endif

            <div class="form-control-feedback" id="name-error-icon">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block" id="name-error"></span>
        </div>
    </div>


    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.name') }}</label>
        <div class="col-lg-10">
            {!! Form::text('display_name', @$content->display_name ,['class'=>'form-control','id'=>'display_name','cf'=>'true']) !!}
            <div class="form-control-feedback" id="display_name-error-icon">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block" id="display_name-error"></span>
        </div>
    </div>


    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.description') }}</label>
        <div class="col-lg-10">
            {!! Form::text('description', @$content->description ,['class'=>'form-control','id'=>'description','cf'=>'true']) !!}
            <div class="form-control-feedback" id="description-error-icon">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block" id="description-error"></span>
        </div>
    </div>

</fieldset>

<div class="text-right">
    <button type="submit" class="btn btn-primary">{{ trans('app.submit') }} <i class="icon-arrow-right14 position-right"></i></button>
</div>




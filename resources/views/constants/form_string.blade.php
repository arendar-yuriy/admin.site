<fieldset class="content-group">
    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.name') }}</label>
        <div class="col-lg-10">
            {!! Form::text('name', '' ,['class'=>'form-control','id'=>'name','cf'=>'true']) !!}
            <div class="form-control-feedback" id="name-error-icon">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block" id="name-error"></span>
        </div>
    </div>

    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.group') }}</label>
        <div class="col-lg-10">
            <select name="group"  cf="true" class="select" id="group">
                @foreach(Config::get('admin.constants_group') as $key=>$value)
                    <option @if(Route::current()->parameter('group') ==$key) selected @endif value="{{ $key }}">{{ trans('constant.'.$value) }}</option>
                @endforeach
            </select>
            <div class="form-control-feedback" id="group-error-icon">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block" id="group-error"></span>
        </div>
    </div>

    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.value') }}</label>
        <div class="col-lg-10">
            {!! Form::textarea('value', '' ,['class'=>'form-control','id'=>'value','cf'=>'true']) !!}
            <div class="form-control-feedback" id="value-error-icon">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block" id="value-error"></span>
        </div>
    </div>

    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.description') }}</label>
        <div class="col-lg-10">
            {!! Form::textarea('description', '' ,['class'=>'form-control','id'=>'description','cf'=>'true']) !!}
            <div class="form-control-feedback" id="description-error-icon">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block" id="description-error"></span>
        </div>
    </div>

</fieldset>

{!! Form::hidden('type',Route::current()->parameter('type')) !!}


<div class="text-right">
    <button type="submit" class="btn btn-primary">{{ trans('app.submit') }} <i class="icon-arrow-right14 position-right"></i></button>
</div>
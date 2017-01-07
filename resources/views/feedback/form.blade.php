<fieldset class="content-group">
    @if(!Auth::user()->can([$controller.'-add-delete',$controller.'-edit']))
        <div class="form-group ">
            <label class="control-label col-lg-2 text-semibold">{{ trans('app.status') }}</label>
            <div class="col-lg-10">
                    <label class="label {{ Config::get('admin.status_'.$controller)[$content->status]['bg'] }} "  >{{ trans('app.'.Config::get('admin.status_'.$controller)[$content->status]['name']) }} </label>
            </div>
        </div>
    @endif
    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.name user') }}</label>
        <div class="col-lg-10">
            {!! Form::text('name', @$content->name ,['class'=>'form-control','readonly'=>'readonly','id'=>'name']) !!}
        </div>
    </div>

    @if(@$content->subject)
        <div class="form-group ">
            <label class="control-label col-lg-2 text-semibold">{{ trans('app.subject') }}</label>
            <div class="col-lg-10">
                {!! Form::text('subject', @$content->subject ,['class'=>'form-control','readonly'=>'readonly','id'=>'subject']) !!}
            </div>
        </div>
    @endif

    @if(@$content->company)
        <div class="form-group ">
            <label class="control-label col-lg-2 text-semibold">{{ trans('app.company') }}</label>
            <div class="col-lg-10">
                {!! Form::text('company', @$content->company ,['class'=>'form-control','readonly'=>'readonly','id'=>'company']) !!}
            </div>
        </div>
    @endif

    @if(@$content->site)
        <div class="form-group ">
            <label class="control-label col-lg-2 text-semibold">{{ trans('app.site') }}</label>
            <div class="col-lg-10">
                {!! Form::text('site', @$content->site ,['class'=>'form-control','readonly'=>'readonly','id'=>'site']) !!}
            </div>
        </div>
    @endif

    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.message') }}</label>
        <div class="col-lg-10">
            {!! Form::textarea('content', @$content->content ,['class'=>'form-control','readonly'=>'readonly','id'=>'content']) !!}
        </div>
    </div>


    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.email') }}</label>
        <div class="col-lg-10">
            {!! Form::text('email', @$content->email ,['class'=>'form-control','readonly'=>'readonly','id'=>'email']) !!}
        </div>
    </div>


    @if(@$content->site)
        <div class="form-group ">
            <label class="control-label col-lg-2 text-semibold">{{ trans('app.phone') }}</label>
            <div class="col-lg-10">
                {!! Form::text('phone', @$content->phone ,['class'=>'form-control','readonly'=>'readonly','id'=>'phone']) !!}
            </div>
        </div>
    @endif


    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.browser') }}</label>
        <div class="col-lg-10">
            {!! Form::text('browser', @$content->browser ,['class'=>'form-control','readonly'=>'readonly','id'=>'browser']) !!}
        </div>
    </div>

    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.os') }}</label>
        <div class="col-lg-10">
            {!! Form::text('os', @$content->os ,['class'=>'form-control','readonly'=>'readonly','id'=>'os']) !!}
        </div>
    </div>


    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.url') }}</label>
        <div class="col-lg-10">
            {!! Form::text('url', @$content->url ,['class'=>'form-control','readonly'=>'readonly','id'=>'url']) !!}
        </div>
    </div>

    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.ip') }}</label>
        <div class="col-lg-10">
            {!! Form::text('ip', @$content->ip ,['class'=>'form-control','readonly'=>'readonly','id'=>'ip']) !!}
        </div>
    </div>

    @if(Auth::user()->can([$controller.'-add-delete',$controller.'-edit']))
        <div class="form-group ">
            <label class="control-label col-lg-2 text-semibold">{{ trans('app.status') }}</label>
            <div class="col-lg-10">

                <select name="status" class="select" id="controller">
                    @foreach(Config::get('admin.status_'.$controller) as $name=>$val)
                        <option @if(@$content->status == $name) selected @endif value="{{ $name }}">{{ trans('app.'.$val['name']) }}</option>
                    @endforeach;
                </select>
                <div class="form-control-feedback" id="status-error-icon">
                    <i class="icon-cancel-circle2"></i>
                </div>
                <span class="help-block" id="status-error"></span>

            </div>
        </div>
    @endif

    @permission([$controller.'-add-delete',$controller.'-edit'])
        @if(@$content->answer == null)
            <div class="form-group ">
                <label class="control-label col-lg-2 text-semibold">{{ trans('app.answer') }}</label>
                <div class="col-lg-10">
                    {!! Form::textarea('answer', @$content->answer ,['class'=>'form-control','id'=>'answer']) !!}
                </div>
            </div>
        @else
            <div class="form-group ">
                <label class="control-label col-lg-2 text-semibold">{{ trans('app.answer') }}</label>
                <div class="col-lg-10">
                    {!! Form::textarea('answer', @$content->answer ,['class'=>'form-control','readonly'=>'readonly','id'=>'answer']) !!}
                </div>
            </div>
        @endif
    @endpermission

</fieldset>
@permission([$controller.'-add-delete',$controller.'-edit'])
    <div class="text-right">
        <button type="submit" class="btn btn-primary">{{ trans('app.submit') }} <i class="icon-arrow-right14 position-right"></i></button>
    </div>
@endpermission




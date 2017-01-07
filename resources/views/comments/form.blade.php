<fieldset class="content-group">
    @if(@$content->name)
        <div class="form-group ">
            <label class="control-label col-lg-2 text-semibold">{{ trans('app.name user') }}</label>
            <div class="col-lg-10">
                {!! Form::text('name', @$content->name ,['class'=>'form-control','readonly'=>'readonly','id'=>'name']) !!}
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

    @if(@$content->email)
        <div class="form-group ">
            <label class="control-label col-lg-2 text-semibold">{{ trans('app.email') }}</label>
            <div class="col-lg-10">
                {!! Form::text('email', @$content->email ,['class'=>'form-control','readonly'=>'readonly','id'=>'email']) !!}
            </div>
        </div>
    @endif

    @if(@$content->browser)
        <div class="form-group ">
            <label class="control-label col-lg-2 text-semibold">{{ trans('app.browser') }}</label>
            <div class="col-lg-10">
                {!! Form::text('browser', @$content->browser ,['class'=>'form-control','readonly'=>'readonly','id'=>'browser']) !!}
            </div>
        </div>
    @endif

    @if(@$content->os)
        <div class="form-group ">
            <label class="control-label col-lg-2 text-semibold">{{ trans('app.os') }}</label>
            <div class="col-lg-10">
                {!! Form::text('os', @$content->os ,['class'=>'form-control','readonly'=>'readonly','id'=>'os']) !!}
            </div>
        </div>
    @endif

    @if(@$content->url)
        <div class="form-group ">
            <label class="control-label col-lg-2 text-semibold">{{ trans('app.url') }}</label>
            <div class="col-lg-10">
                {!! Form::text('url', @$content->url ,['class'=>'form-control','readonly'=>'readonly','id'=>'url']) !!}
            </div>
        </div>
    @endif

    @if(@$content->ip)
        <div class="form-group ">
            <label class="control-label col-lg-2 text-semibold">{{ trans('app.ip') }}</label>
            <div class="col-lg-10">
                {!! Form::text('ip', @$content->ip ,['class'=>'form-control','readonly'=>'readonly','id'=>'ip']) !!}
            </div>
        </div>
    @endif

    @if(@$content->browser)
        <div class="form-group ">
            <label class="control-label col-lg-2 text-semibold">{{ trans('app.status') }}</label>
            <div class="col-lg-10">
                <select name="status" class="select" id="controller">
                    @foreach(Config::get('admin.status_'.$controller) as $name=>$val)
                        <option @if(@$content->status == $name) selected @endif value="{{ $name }}">{{ trans('app.'.$val['name']) }}</option>
                    @endforeach;
                </select>
            </div>
        </div>
    @endif
        <h6 class="text-semibold"><i class="icon-pencil7 position-left"></i> {{ trans('app.Your comment') }} </h6>
    <div class="form-group ">
        <div class="col-lg-12">
            {!! Form::textarea('comment', @$content->comment ,['class'=>'form-control','id'=>'comment']) !!}
            <div class="form-control-feedback" id="comment-error-icon">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block" id="comment-error"></span>
        </div>
    </div>


</fieldset>

<div class="text-right">

    {{ Route::current()->parameter('type') }}
    {!! Form::hidden('locale',\App\Helpers\FormLang::getCurrentLang()) !!}
    {!! Form::hidden('type',$type) !!}
    @if(isset($parent_id))
        {!! Form::hidden('content_id',$content_id) !!}
    @else
        {!! Form::hidden('content_id',@$content->content_id) !!}
    @endif

    @if(isset($parent_id))
        {!! Form::hidden('parent_id',$parent_id) !!}
    @endif
    <button type="submit" class="btn btn-primary">{{ trans('app.submit') }} <i class="icon-arrow-right14 position-right"></i></button>
</div>

<script>
    $(document).ready(function(){
        $('.select').select2({
            minimumResultsForSearch: "-1"
        });

        $('#comment-error-icon').hide();

        $('input').on('click',function(){
            var id = this.name;
            var el = $('#'+id+'-error');
            el.html('');

            $(this).closest('.form-group').removeClass('has-error').removeClass('has-feedback');
            $('#'+id+'-error-icon').hide();
        });
    });
</script>




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

    <div class="form-group "  style="margin-bottom: 44px;">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.Insert tag') }}</label>
        <div class="col-lg-10">
            <div class="input-group">
                <input readonly id="value" name="value" class="form-control">

                    <span class="input-group-btn">
                        <button class="btn bg-teal" data-inputid="value" id="add-file" type="button">{{ trans('app.Upload file') }}</button>
                    </span>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click','#add-file',function (event) {
            event.preventDefault();
            var updateID = $(this).attr('data-inputid'); // Btn id clicked
            var elfinderUrl = '/elfinder/popup/';

            // trigger the reveal modal with elfinder inside
            var triggerUrl = elfinderUrl + updateID;
            $.colorbox({
                href: triggerUrl,
                fastIframe: true,
                iframe: true,
                width: '90%',
                height: '80%'
            });

        });
        // function to update the file selected by elfinder
        function processSelectedFile(filePath, requestingField) {
            $('#' + requestingField).val(filePath);
        }
    </script>

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
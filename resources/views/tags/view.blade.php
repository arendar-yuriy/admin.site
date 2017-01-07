<fieldset class="content-group">
    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.name') }}</label>
        <div class="col-lg-10">
            <p>{{ $content->text }}</p>
        </div>
    </div>

    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.alias') }}</label>
        <div class="col-lg-10">
            <p>{{ $content->alias }}</p>
        </div>
    </div>

</fieldset>
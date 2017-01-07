<fieldset class="content-group">
    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.name') }}</label>
        <div class="col-lg-10">
            <h2>{{ $content->display_name }}</h2>
        </div>
    </div>

    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.alias') }}</label>
        <div class="col-lg-10">
            <p>{{ $content->name }}</p>
        </div>
    </div>


    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.description') }}</label>
        <div class="col-lg-10">
            <p>
                {{ $content->description }}
            </p>
        </div>
    </div>

    <div class="form-group ">
        <h2>{{ trans('app.Permission') }}</h2>

            @foreach($permission as $columns)
                <div class="col-lg-6">
                    @foreach($columns as $value)
                        <p>{{ $value['display_name'] }}</p>
                    @endforeach
                </div>
            @endforeach

    </div>

</fieldset>
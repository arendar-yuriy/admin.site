
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
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.description') }}</label>
        <div class="col-lg-10">
            {!! Form::textarea('description', @$translation->description ,['class'=>'ckeditor form-control','id'=>'description','cf'=>'true']) !!}
            <div class="form-control-feedback" id="text-error-icon">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block" id="text-error"></span>
        </div>
    </div>
    <script>
        var editor = CKEDITOR.replace( 'description',{
            filebrowserBrowseUrl : '/elfinder/ckeditor',
            contentsCss : '{{ env('CKEDITOR_CSS') }}',
            language: '{{ LaravelLocalization::getCurrentLocale() }}'
        } );
    </script>

    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.select Structure') }}</label>
        <div class="col-lg-10">
            <select name="structure_id" cf="true" class="form-control">
                <option value="0" >{{ trans('app.select Structure') }}</option>
                @foreach($aTreeStructure as $struct)
                    <option value="{{ $struct['id'] }}" @if($struct['id'] == @$content->structure_id) selected @endif>{{ $struct['name'] }}</option>
                    @if(!empty($struct['children']))
                        @foreach($struct['children'] as $struct1)
                            <option value="{{ $struct1['id'] }}" @if($struct1['id'] == @$content->structure_id) selected @endif>&nbsp;&nbsp;{{ $struct1['name'] }}</option>
                            @if(!empty($struct1['children']))
                                @foreach($struct1['children'] as $struct2)
                                    <option value="{{ $struct1['id'] }}" @if($struct2['id'] == @$content->structure_id) selected @endif>&nbsp;&nbsp;&nbsp;&nbsp;{{ $struct1['name'] }}</option>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach

            </select>
            <div class="form-control-feedback" id="structure_id-error-icon">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block" id="structure_id-error"></span>
        </div>
    </div>

    <div class="form-group ">
        <label class="control-label col-lg-2 text-semibold">{{ trans('app.alias') }}</label>
        <div class="col-lg-10" style="padding-left: 0;">
        {!! Form::text('alias', @$content->alias ,['class'=>'form-control pull-right','id'=>'alias','cf'=>'true']) !!}

        <div class="form-control-feedback" id="alias-error-icon">
            <i class="icon-cancel-circle2"></i>
        </div>
        <span class="help-block" id="alias-error"></span>

        </div>
    </div>

</fieldset>

{!! Form::hidden('locale',\App\Helpers\FormLang::getCurrentLang()) !!}

<div class="text-right">
    @if(@$content->id)
        <a href="{{ route('sliders_add_unit',['id'=>Route::current()->parameter('id')]) }}" class="btn btn-danger">{{ trans('app.Add new slide') }} <i class=" icon-add position-left position-right"></i></a>
    @endif
        <button type="submit" class="btn btn-primary">{{ trans('app.submit') }} <i class="icon-arrow-right14 position-right"></i></button>
</div>





@if(@$content && $content->units()->count() > 0)


    <div class="row row-sortable" style="margin-top: 30px;">
        <div class="col-lg-12">

            @foreach($content->units()->orderBy('position','asc')->get() as $unit)
                <div class="panel panel-white sort-panel" data-id="{{ $unit->id }}">
                    <div class="panel-heading">
                        <h6 class="panel-title">{{ $unit->name }}</h6>
                        <div class="heading-elements">
                            <label class="checkbox-inline checkbox-right checkbox-switchery switchery-sm pull-left">
                                <input type="checkbox" data-id="{{ $unit->id }}" class="switchery change-active-row-{{ $unit->id }}" @if($unit->published) checked="checked" @endif>
                                {{ trans('app.published') }}
                            </label>

                            <script>
                                $(document).ready(function(){
                                    $('.change-active-row-{{ $unit->id }}').on('change',function(){
                                        var url = '{{ route('active_sliders_unit',['id'=>$unit->id]) }}';
                                        var checked = $(this).prop('checked');
                                        if(typeof checked != 'undefined'){
                                            checked = (checked) ? 1 : 0;
                                            $.ajax({
                                                type: "GET",
                                                url: url,
                                                data: {checked:checked},
                                                dataType: "json"
                                            });
                                        }
                                    });
                                });
                            </script>

                            <button type="button" class="btn btn-danger btn-icon heading-btn remove-button-{{ $unit->id }}"><i class="icon-bin"></i></button>

                            <script>
                                $(document).ready(function(){

                                    $('.remove-button-{{ $unit->id }}').on('click',function(e){
                                        e.preventDefault();
                                        var url = '{{ route('delete_sliders_unit',['id'=>$unit->id]) }}';

                                        bootbox.confirm("{{ trans('app.remove_confirm') }}", function(result) {
                                            if(result){
                                                $.ajax({
                                                    type: "GET",
                                                    url: url,
                                                    data: {},
                                                    dataType: "json",
                                                    success: function(data){
                                                        Main.actionData(data);
                                                    }
                                                });
                                            }
                                        });
                                    });
                                });
                            </script>

                            <ul class="icons-list">
                                <li><a href="{{ route('edit_sliders_unit',['id'=>$unit->id]) }}"><span class="label label-info"><i class="icon-pen position-left"></i> {{ trans('app.Edit') }}</span></a></li>
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="move"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {!! MediaImage::getImage($unit->image,1600,null,['crop'=>$unit->is_crop,'alt'=>$unit->name,'style'=>'max-width: 100%']) !!}
                        </div>

                        <div class="col-md-6">
                            {!! $unit->description !!}
                        </div>
                    </div>


                </div>
            @endforeach

        </div>
    </div>


    <script>
        $(document).ready(function(){
            $(".row-sortable").sortable({
                connectWith: '.row-sortable',
                items: '.panel',
                helper: 'original',
                cursor: 'move',
                handle: '[data-action=move]',
                revert: 100,
                containment: '.content-wrapper',
                forceHelperSize: true,
                placeholder: 'sortable-placeholder',
                forcePlaceholderSize: true,
                tolerance: 'pointer',
                start: function(e, ui){
                    ui.placeholder.height(ui.item.outerHeight());
                },
                stop: function( event, ui ) {
                    var mas = [];

                    $('.sort-panel').each(function (e) {
                        mas[mas.length] = {id:$(this).data('id'),'position':e+1};
                    });

                    $.ajax({
                        type: "POST",
                        url: '{{ route('sliders_units_position') }}',
                        data: {data:mas},
                        dataType: "json"
                    });

                }
            });
        });
    </script>

@endif




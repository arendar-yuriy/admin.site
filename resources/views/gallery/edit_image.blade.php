@extends('layout.default.main')

@section('central')

    <form class="form-horizontal" method="post" onsubmit="return Main.formSubmit(this);" action="{{ Route('update_image_'.$controller, ['id'=>$content->id]) }}">
        <div class="row">
            <div class="col-lg-4">

                <div class="thumbnail">
                    <div class="thumb">
                        @if($content->image)
                            <img src="{{ Config::get('admin.image_url').$content->image }}" alt="">
                        @else
                            <img src="/img/placeholder.jpg" alt="">
                        @endif
                        <div class="caption-overflow">
                            <span>
                                <a href="{{ Config::get('admin.image_url').$content->image }}" data-popup="lightbox" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class=" icon-zoomin3"></i></a>
                            </span>
                        </div>
                    </div>

                    <div class="caption">
                        <h6 class="no-margin-top text-semibold">  {{ @$translation->name }} <a href="#" class="text-muted"><i class="icon-download pull-right"></i></a></h6>
                    </div>
                </div>

            </div>

            <div class="col-lg-8">

                @include('inc.published',['published'=>@$content->published])

                <fieldset class="content-group">
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
                            <div class="form-control-feedback" id="description-error-icon">
                                <i class="icon-cancel-circle2"></i>
                            </div>
                            <span class="help-block" id="description-error"></span>
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
                        <label class="control-label col-lg-2 text-semibold">{{ trans('app.tags') }}</label>
                        <div class="col-lg-10">
                            <select name="tags[]" cf="true" class="select-multiple-tags" multiple="multiple">
                                @foreach($content->tags as $tag)
                                    <option value="{{ $tag->id }}" @if(in_array($tag->id,$tagsList)) selected @endif>{{ $tag->text }}</option>
                                @endforeach

                            </select>
                            <div class="form-control-feedback" id="tags-error-icon">
                                <i class="icon-cancel-circle2"></i>
                            </div>
                            <span class="help-block" id="tags-error"></span>
                        </div>
                    </div>



                </fieldset>

                {!! Form::hidden('locale',\App\Helpers\FormLang::getCurrentLang()) !!}

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">{{ trans('app.submit') }} <i class="icon-arrow-right14 position-right"></i></button>
                </div>

            </div>
        </div>

    </form>

@endsection
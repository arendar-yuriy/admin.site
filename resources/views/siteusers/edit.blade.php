@extends('layout.default.main')

@section('central')


    <div class="row">
        <div class="col-lg-9">

            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">{{ trans('app.Profile information') }}</h6>
                </div>

                <div class="panel-body">
                    <form method="post" onsubmit="return Main.formSubmit(this);" action="{{ Route('update_'.$controller, ['id'=>$content->id]) }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('app.Username') }}</label>

                                        {!! Form::text('name', @$content->name ,['class'=>'form-control','id'=>'name','cf'=>'true']) !!}

                                    <div class="form-control-feedback" id="name-error-icon">
                                        <i class="icon-cancel-circle2"></i>
                                    </div>
                                    <span class="help-block" id="name-error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('app.Lastname') }}</label>
                                        {!! Form::text('lastname', @$content->lastname ,['class'=>'form-control','id'=>'lastname','cf'=>'true']) !!}

                                    <div class="form-control-feedback" id="lastname-error-icon">
                                        <i class="icon-cancel-circle2"></i>
                                    </div>
                                    <span class="help-block" id="lastname-error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('app.Phone') }}</label>

                                    {!! Form::text('phone', @$content->phone ,['class'=>'form-control','id'=>'phone','cf'=>'true']) !!}


                                    <div class="form-control-feedback" id="phone-error-icon">
                                        <i class="icon-cancel-circle2"></i>
                                    </div>
                                    <span class="help-block" id="phone-error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('app.email') }}</label>
                                    {!! Form::text('email', @$content->email ,['class'=>'form-control','id'=>'email','cf'=>'true','readonly'=>'readonly']) !!}


                                    <div class="form-control-feedback" id="email-error-icon">
                                        <i class="icon-cancel-circle2"></i>
                                    </div>
                                    <span class="help-block" id="email-error"></span>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('app.Address') }}</label>

                                        {!! Form::text('address', @$content->address ,['class'=>'form-control','id'=>'address','cf'=>'true']) !!}


                                    <div class="form-control-feedback" id="address-error-icon">
                                        <i class="icon-cancel-circle2"></i>
                                    </div>
                                    <span class="help-block" id="address-error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('app.Region') }}</label>
                                    {!! Form::text('region', @$content->region ,['class'=>'form-control','id'=>'region','cf'=>'true']) !!}


                                    <div class="form-control-feedback" id="region-error-icon">
                                        <i class="icon-cancel-circle2"></i>
                                    </div>
                                    <span class="help-block" id="region-error"></span>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('app.City') }}</label>

                                    {!! Form::text('city', @$content->city ,['class'=>'form-control','id'=>'city','cf'=>'true']) !!}


                                    <div class="form-control-feedback" id="city-error-icon">
                                        <i class="icon-cancel-circle2"></i>
                                    </div>
                                    <span class="help-block" id="city-error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('app.Country') }}</label>
                                    {!! Form::text('country', @$content->country ,['class'=>'form-control','id'=>'country','cf'=>'true']) !!}


                                    <div class="form-control-feedback" id="country-error-icon">
                                        <i class="icon-cancel-circle2"></i>
                                    </div>
                                    <span class="help-block" id="country-error"></span>
                                </div>
                            </div>
                        </div>


                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ trans('app.submit') }} <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>


        </div>

        @include('siteusers.inc.sidebar')
    </div>

@endsection
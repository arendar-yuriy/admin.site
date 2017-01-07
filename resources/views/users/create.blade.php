@extends('layout.default.main')

@section('central')


    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">{{ trans('app.Profile information') }}</h6>
                </div>

                <div class="panel-body">
                    <form method="post" onsubmit="return Main.formSubmit(this);" action="{{ action('UsersController@postStore') }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('app.Username') }}</label>

                                    {!! Form::text('name','' ,['class'=>'form-control','id'=>'name','cf'=>'true']) !!}

                                    <div class="form-control-feedback" id="name-error-icon">
                                        <i class="icon-cancel-circle2"></i>
                                    </div>
                                    <span class="help-block" id="name-error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('app.Lastname') }}</label>
                                    {!! Form::text('lastname', '' ,['class'=>'form-control','id'=>'lastname','cf'=>'true']) !!}

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
                                    <label>{{ trans('app.email') }}</label>
                                    {!! Form::text('email', '' ,['class'=>'form-control','id'=>'email','cf'=>'true']) !!}


                                    <div class="form-control-feedback" id="email-error-icon">
                                        <i class="icon-cancel-circle2"></i>
                                    </div>
                                    <span class="help-block" id="email-error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('app.Phone') }}</label>

                                    {!! Form::text('phone', '' ,['class'=>'form-control','id'=>'phone','cf'=>'true']) !!}


                                    <div class="form-control-feedback" id="phone-error-icon">
                                        <i class="icon-cancel-circle2"></i>
                                    </div>
                                    <span class="help-block" id="phone-error"></span>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('app.Address') }}</label>

                                    {!! Form::text('address', '' ,['class'=>'form-control','id'=>'address','cf'=>'true']) !!}


                                    <div class="form-control-feedback" id="address-error-icon">
                                        <i class="icon-cancel-circle2"></i>
                                    </div>
                                    <span class="help-block" id="address-error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('app.Region') }}</label>
                                    {!! Form::text('region', '' ,['class'=>'form-control','id'=>'region','cf'=>'true']) !!}


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

                                    {!! Form::text('city', '' ,['class'=>'form-control','id'=>'city','cf'=>'true']) !!}


                                    <div class="form-control-feedback" id="city-error-icon">
                                        <i class="icon-cancel-circle2"></i>
                                    </div>
                                    <span class="help-block" id="city-error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('app.Country') }}</label>
                                    {!! Form::text('country', '' ,['class'=>'form-control','id'=>'country','cf'=>'true']) !!}


                                    <div class="form-control-feedback" id="country-error-icon">
                                        <i class="icon-cancel-circle2"></i>
                                    </div>
                                    <span class="help-block" id="country-error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">

                            <div class="col-md-12">
                                <label >{{ trans('app.Select roles') }}</label>
                                <select multiple="multiple" cf="true" name="roles[]" class="select" id="roles">
                                    @foreach($roles as $value)
                                        <option value="{{ $value->id }}" >{{ $value->display_name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-control-feedback" id="roles-error-icon">
                                    <i class="icon-cancel-circle2"></i>
                                </div>
                                <span class="help-block" id="roles-error"></span>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('app.Password') }}</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                    <div class="form-control-feedback" id="password-error-icon">
                                        <i class="icon-cancel-circle2"></i>
                                    </div>
                                    <span class="help-block" id="password-error"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('app.Confirm password') }}</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                    <div class="form-control-feedback" id="password_confirmation-error-icon">
                                        <i class="icon-cancel-circle2"></i>
                                    </div>
                                    <span class="help-block" id="password_confirmation-error"></span>
                                </div>
                            </div>
                        </div>

                        {!! \App\Helpers\Main::getImageField('image','',trans('app.image')) !!}


                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ trans('app.submit') }} <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>

@endsection
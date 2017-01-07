@extends('layout.default.main')

@section('central')


    <div class="row">
        <div class="col-lg-9">


                        <!-- Account settings -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">{{ trans('app.Change password') }}</h6>
                            </div>

                            <div class="panel-body">
                                <form method="post" onsubmit="return Main.formSubmit(this);" action="{{ Route('change_users_password', ['id'=>Route::current()->parameter('id')]) }}">

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
                                                <label>{{ trans('app.Password') }}</label>
                                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                                <div class="form-control-feedback" id="password_confirmation-error-icon">
                                                    <i class="icon-cancel-circle2"></i>
                                                </div>
                                                <span class="help-block" id="password_confirmation-error"></span>
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

        @include('users.inc.sidebar')
    </div>

@endsection
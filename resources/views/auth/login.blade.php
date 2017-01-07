@extends('auth.layout')


@section('form')
	<form role="form" onsubmit="return Main.formSubmit(this);" method="POST" action="{{ url('/login') }}">
		<div class="panel panel-body login-form">
			<div class="text-center">
				<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
				<h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
			</div>

			<div class="form-group has-feedback has-feedback-left">
				<input type="text" class="form-control" id="input-email" name="email" placeholder="Email">

				<div class="form-control-feedback">
					<i class="icon-user text-muted"></i>
				</div>
				<label id="email-error" class="validation-error-label" for="email"></label>
			</div>

			<div class="form-group has-feedback has-feedback-left">
				<input type="password" class="form-control" id="input-password" name="password" placeholder="Password">

				<div class="form-control-feedback">
					<i class="icon-lock2 text-muted"></i>
				</div>

				<label id="password-error" class="validation-error-label" for="password"></label>
			</div>

			<div class="checkbox disabled">
				<label>
					<input type="checkbox" name="remember" class="control-info" checked="checked" >
					Remember me
				</label>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button>
			</div>

		</div>
	</form>
@endsection


@extends('layouts.guest')

@section('content')
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
				<div class="panel-heading">
                    <h3 class="panel-title">Firefly III &mdash; Register</h3>
                </div>
				<div class="panel-body">
					<p>
						Registering an account on Firefly requires an e-mail address.
					</p>
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form role="form" id="register" method="POST" action="/auth/register">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="control-label">E-Mail</label>
							<input type="email" class="form-control" placeholder="E-Mail" name="email" value="{{ old('email') }}">
						</div>

						<div class="form-group">
							<label class="control-label">Password</label>
							<input type="password" placeholder="Password" class="form-control" name="password">
						</div>

						<div class="form-group">
							<label class="control-label">Confirm Password</label>
							<input type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation">
						</div>

                        <p>
                            <button type="submit" class="btn btn-lg btn-success btn-block">Register</button>
                        </p>


                        <div class="btn-group btn-group-justified btn-group-sm">
                            <a href="/auth/login" class="btn btn-default">Login</a>
                            <a href="/password/email" class="btn btn-default">Forgot your password?</a>
                        </div>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

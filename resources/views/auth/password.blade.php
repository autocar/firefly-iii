@extends('layouts.guest')

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Firefly III &mdash; Reset Password</h3>
                </div>
				<div class="panel-body">
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif

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

					<form role="form" method="POST" action="/password/email">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label class="control-label">E-Mail</label>
                            <input type="email" class="form-control" placeholder="E-Mail" name="email" value="{{ old('email') }}">
						</div>

                        <p>
                            <button type="submit" class="btn btn-lg btn-success btn-block">Send Password Reset</button>
                        </p>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

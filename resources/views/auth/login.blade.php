@extends('layouts.guest')
@section('content')

@if($errors->has('email'))
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>Error!</strong> {{$errors->get('email')[0]}}
        </div>
    </div>
</div>
@endif


<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Firefly III &mdash; Sign In</h3>
            </div>
            <div class="panel-body">
                <form role="form" method="POST" id="login" action="/auth/login">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="control-label">E-Mail</label>
                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="E-Mail">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
                    </div>


        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember" value="1"> Remember me
            </label>
        </div>
        <p>
            <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
        </p>
        <div class="btn-group btn-group-justified btn-group-sm">
            @if(Config::get('auth.allow_register') === true)
                <a href="{{route('register')}}" class="btn btn-default">Register</a>
            @endif
            <a href="/password/email" class="btn btn-default">Forgot your password?</a>
        </div>
        </form>
    </div>
</div>
</div>
</div>
@stop

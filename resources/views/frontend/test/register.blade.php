@extends('frontend.layouts.auth')

@section('page-title', trans('app.sign_up'))

@section('content')
        <p class="login-box-msg">Register a new membership</p>
        <form role="form" action="<?=url('api/v2/register')?>" method="post" id="registration-form" autocomplete="off">
            <input type="hidden" value="<?=csrf_token()?>" name="_token">

            <div class="form-group has-feedback">
                <input type="email" name="email" id="email" class="form-control" placeholder="@lang('app.email')" value="{{ old('email') }}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="text" name="username" id="username" class="form-control" placeholder="@lang('app.username')"  value="{{ old('username') }}">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="password" name="password" id="password" class="form-control" placeholder="@lang('app.password')">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="@lang('app.confirm_password')">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div>
        </form>

    </div>

@stop
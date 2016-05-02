@extends('frontend.layouts.auth')

@section('page-title', trans('app.login'))

@section('content')
    <p class="login-box-msg">Sign in to start your session</p>
    <form role="form" action="<?=url('api/v2/login')?>" method="POST" id="login-form" autocomplete="off">
        <input type="hidden" value="<?=csrf_token()?>" name="_token">

        @if (Input::has('to'))
            <input type="hidden" value="{{ Input::get('to') }}" name="to">
        @endif

        <div class="form-group has-feedback">
            <input type="email" name="username" id="username" class="form-control" placeholder="@lang('app.email_or_username')">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
            <input type="password" name="password" id="password" class="form-control" placeholder="@lang('app.password')">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        <div class="row">
            <div class="col-xs-8">
                @if (settings('remember_me'))
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" name="remember" id="remember"> @lang('app.remember_me')
                    </label>
                </div>
                @endif
            </div>
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat" id="btn-login">@lang('app.log_in')</button>
            </div>
        </div>

    </form>
@stop

@section('after-scripts-end')
    {!! Html::script('assets/js/login.js') !!}
    {!! JsValidator::formRequest('App\Http\Requests\Auth\LoginRequest', '#login-form') !!}
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
@stop
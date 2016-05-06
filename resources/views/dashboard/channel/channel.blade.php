@extends('dashboard.layouts.master')

@section('page-title', 'Your Shopping Channel')

@section('page-header')
    <h1>
        {{ $user->present()->nameOrEmail }}
        <small>@lang('app.edit_profile_details')</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('app.home')</a></li>
        <li class="active">@lang('app.my_profile')</li>
     </ol>
@endsection

@section('content')

@include('partials.messages')


@stop

@section('after-scripts-end')
    {!! Html::script('assets/js/btn.js') !!}
    {!! Html::script('assets/js/profile.js') !!}
    {!! JsValidator::formRequest('App\Http\Requests\User\UpdateDetailsRequest', '#details-form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\User\UpdateProfileLoginDetailsRequest', '#login-details-form') !!}

    @if (config('auth.2fa.enabled'))
        {!! JsValidator::formRequest('App\Http\Requests\User\EnableTwoFactorRequest', '#two-factor-form') !!}
    @endif
@stop
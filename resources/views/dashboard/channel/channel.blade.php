@extends('dashboard.layouts.master')

@section('page-title', 'Your Shopping Channel')

@section('page-header')
    <h1>
        {{ $user->present()->nameOrEmail }}
        <small>Shopping Channel Management</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('app.home')</a></li>
        <li class="active">Channel</li>
     </ol>
@endsection

@section('content')

@include('partials.messages')

<div class="nav-tabs-custom">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#details" aria-controls="details" role="tab" data-toggle="tab">
                <i class="glyphicon glyphicon-th"></i>
                Channel Details
            </a>
        </li>

    </ul>
    @if($channel != NULL)
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="details">
            <div class="row">
                <div class="col-lg-8 col-md-7">
                    {!! Form::open(['route' => 'channel.details.update', 'method' => 'PUT', 'id' => 'details-form']) !!}
                        @include('dashboard.channel.partials.details')
                    {!! Form::close() !!}
                </div>
                <div class="col-lg-4 col-md-5">
                    {!! Form::open(['route' => 'channel.avatar.update', 'files' => true, 'id' => 'avatar-form']) !!}
                        @include('dashboard.channel.partials.avatar')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="details">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    {!! Form::open(['route' => 'channel.details.create', 'method' => 'POST', 'id' => 'details-form']) !!}
                        @include('dashboard.channel.partials.details')
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
</div>
@endif
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
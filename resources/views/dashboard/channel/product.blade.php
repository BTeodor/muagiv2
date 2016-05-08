@extends('dashboard.layouts.master')

@section('page-title', 'Products')

@section('page-header')
    <h1>
        {{ $user->present()->nameOrEmail }}
        <small>Products Management</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('app.home')</a></li>
        <li class="active">@lang('app.my_profile')</li>
     </ol>
@endsection

@section('content')

@include('partials.messages')

<div class="nav-tabs-custom">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#products-list" aria-controls="products-list" role="tab" data-toggle="tab">
                <i class="glyphicon glyphicon-th"></i>
                Products List
            </a>
        </li>
        <li role="presentation" class="">
            <a href="#product-create" aria-controls="product-create" role="tab" data-toggle="tab">
                <i class="glyphicon glyphicon-th"></i>
                Add product
            </a>
        </li>
    </ul>
    
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="products-list">
        @if(isset($products) && count($products) > 0)
            @foreach($products as $product)
            <div class="row">
                <div class="col-lg-9 col-md-8">
                    {!! Form::open(['route' => 'channel.product.update', 'method' => 'PUT', 'id' => 'products-form-'.$product->id]) !!}
                        @include('dashboard.channel.partials.product-detail')
                        
                </div>
                <div class="col-lg-3 col-md-4">
                    {!! Form::open(['route' => 'channel.event.updatePoster',  'files' => true]) !!}
                        @include('dashboard.channel.partials.event-logo')
                    {!! Form::close() !!}
                </div>
            </div>
            @endforeach
        @endif
        </div>
        <div role="tabpanel" class="tab-pane" id="product-create">
            <div class="row">
                <div class="col-lg-8 col-md-7">
                    {!! Form::open(['route' => 'channel.product.create', 'method' => 'POST', 'id' => 'product-create-form']) !!}
                        @include('dashboard.channel.partials.product-create')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
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
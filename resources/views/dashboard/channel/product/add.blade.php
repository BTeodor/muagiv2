@extends('dashboard.layouts.master')

@section('page-title', 'Create new product')

@section('page-header')
    <h1>
        Create new product
        <small>Product details</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('app.home')</a></li>
        <li><a href="{{ route('channel.product.index') }}">Products</a></li>
        <li class="active">Create</li>
      </ol>
@endsection

@section('content')

@include('partials.messages')

{!! Form::open(['route' => 'channel.product.create', 'method' => 'POST', 'id' => 'product-create-form', 'files' => true]) !!}
    @include('dashboard.channel.partials.product-create-form')
{!! Form::close() !!}

@stop

@section('after-scripts-end')
    {!! Html::script('assets/js/profile.js') !!}
    {!! JsValidator::formRequest('App\Http\Requests\User\CreateUserRequest', '#user-form') !!}
@stop
@extends('dashboard.layouts.master')

@section('page-title', 'Update product information')

@section('page-header')
    <h1>
        Update product information
        <small>Product details</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('app.home')</a></li>
        <li><a href="{{ route('channel.product.index') }}">Products</a></li>
        <li class="active">Edit</li>
      </ol>
@endsection

@section('content')

@include('partials.messages')

{!! Form::open(['route' => 'channel.product.update', 'method' => 'PUT', 'id' => 'product-edit-form', 'files' => true]) !!}
    @include('dashboard.channel.partials.product-edit-form')
{!! Form::close() !!}

@stop

@section('after-scripts-end')
    {!! Html::script('assets/js/profile.js') !!}
    {!! JsValidator::formRequest('App\Http\Requests\User\CreateUserRequest', '#user-form') !!}
    <script type="text/javascript">
        $("#switch").bootstrapSwitch();
    </script>
@stop
@extends('dashboard.layouts.master')

@section('page-title', 'Update channel')

@section('page-header')
    <h1>
        Update channel details
        <small>Channel details</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('app.home')</a></li>
        <li><a href="{{ route('adminchannel.channel.list') }}">Channels</a></li>
        <li class="active">Edit</li>
      </ol>
@endsection

@section('content')

@include('partials.messages')

{!! Form::open(['route' => 'adminchannel.channel.update', 'method' => 'PUT', 'id' => 'channel-update-form']) !!}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">Name</label>
                <input type='text' name="name" id='name' class="form-control" required value="{{$channel->name}}" disabled/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="hotline">Hotline</label>
                <input type="text" class="form-control" id="hotline"
                       name="hotline" placeholder="" required value="{{$channel->hotline}}" disabled>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="logo">Logo URL</label><br>
                <img src="{{ empty($channel->relative_logo_link) ? $channel->logo : asset($channel->relative_logo_link)}}" alt="{{ $channel->name}}">
                <br>
                <br>
                <input type='text' name="logo" id='logo' class="form-control" required value="{{$channel->logo}}" disabled/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="maximum_no_hot_product">Maximum number of top sell positions</label>
                <input type="text" class="form-control" id="maximum_no_hot_product"
                       name="maximum_no_hot_product" placeholder="" required value="{{$channel->maximum_no_hot_product}}">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" placeholder="Description goes here" disabled>{{$channel->description}}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <input type="hidden" name="id" value="{{$channel->id}}"></input>
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary" id="create-details-btn">
                <i class="fa fa-refresh"></i>
                Update channel
            </button>
        </div>
    </div>
{!! Form::close() !!}

@stop

@section('after-scripts-end')
    {!! Html::script('assets/js/profile.js') !!}
    {!! JsValidator::formRequest('App\Http\Requests\User\CreateUserRequest', '#user-form') !!}
@stop
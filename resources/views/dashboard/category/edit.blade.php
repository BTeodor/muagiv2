@extends('dashboard.layouts.master')

@section('page-title', 'Update category details')

@section('page-header')
    <h1>
        Update category details
        <small>category details</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('app.home')</a></li>
        <li><a href="{{ route('category.list') }}">Category</a></li>
        <li class="active">Edit</li>
      </ol>
@endsection

@section('content')

@include('partials.messages')

{!! Form::open(['route' => 'category.update', 'method' => 'PUT', 'id' => 'category-update-form']) !!}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name_en">Name</label>
                <input type='text' name="name_en" id='name_en' class="form-control" required value="{{$category->name_en}}" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="name_vi">Name (in Vietnamese)</label>
                <input type='text' name="name_vi" id='name_vi' class="form-control" required value="{{$category->name_vi}}"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <img src="{{$category->image}}" alt="{{$category->name_en}}" class="avatar-preview"><br>
                <label for="image">Image URL</label>
                <input type="text" class="form-control" id="image"
                       name="image" placeholder="" required value="{{$category->image}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" placeholder="Description goes here">{{$category->description}}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <input type="hidden" name="id" value="{{$category->id}}"></input>
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary" id="create-details-btn">
                <i class="fa fa-refresh"></i>
                Update category
            </button>
        </div>
    </div>
{!! Form::close() !!}

@stop

@section('after-scripts-end')
    {!! Html::script('assets/js/profile.js') !!}
    {!! JsValidator::formRequest('App\Http\Requests\User\CreateUserRequest', '#user-form') !!}
@stop
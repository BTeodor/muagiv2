@extends('dashboard.layouts.master')

@section('page-title', 'Create new category')

@section('page-header')
    <h1>
        Create new category
        <small>category details</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('app.home')</a></li>
        <li><a href="{{ route('category.list') }}">Category</a></li>
        <li class="active">Create</li>
      </ol>
@endsection

@section('content')

@include('partials.messages')

{!! Form::open(['route' => 'category.store', 'method' => 'POST', 'id' => 'category-create-form']) !!}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name_en">Name</label>
                <input type='text' name="name_en" id='name_en' class="form-control" required/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="name_vi">Name (in Vietnamese)</label>
                <input type='text' name="name_vi" id='name_vi' class="form-control" required />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="image">Image URL</label>
                <input type="text" class="form-control" id="image"
                       name="image" placeholder="" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" placeholder="Description goes here"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary" id="create-details-btn">
                <i class="glyphicon glyphicon-plus"></i>
                Add category
            </button>
        </div>
    </div>
{!! Form::close() !!}

@stop

@section('after-scripts-end')
    {!! Html::script('assets/js/profile.js') !!}
    {!! JsValidator::formRequest('App\Http\Requests\User\CreateUserRequest', '#user-form') !!}
@stop
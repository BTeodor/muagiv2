@extends('dashboard.layouts.master')
@section('page-title', 'Category')
@section('page-header')
<h1>
Category
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('app.home')</a></li>
    <li class="active">Category</li>
</ol>
@endsection
@section('content')
@include('partials.messages')

<div class="row tab-search">
    <div class="col-md-2 col-xs-2">
        <a href="{{ route('category.create') }}" class="btn btn-success" id="add-user">
            <i class="glyphicon glyphicon-plus"></i>
            Add category
        </a>
    </div>
    <div class="col-md-5 col-xs-3"></div>
    <!-- Search Form -->
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Current categories</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <div id="products-table-wrapper">
                    <table class="table table-hover table-striped">
                        <tbody>
                            <tr>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Category (in Vietnamese)</th>
                                <th class="text-center">Action</th>
                            </tr>
                            @if (count($categories))
                            @foreach ($categories as $category)
                            <tr>
                                <td><img src="{{ $category->image}}" alt="{{ $category->name_en}}"></td>
                                <td>{{ $category->name_en}}</td>
                                <td>{{ $category->name_vi}}</td>
                                <td class="text-center">
                                    <a href="{{ route('category.delete', $category->id) }}" class="btn btn-danger btn-circle" title="Delete category"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-method="DELETE"
                                        data-confirm-title="Please Confirm'"
                                        data-confirm-text="Are you sure to delete this category"
                                        data-confirm-delete="Yes, delete it">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-success btn-circle"
                                        title="Edit" data-toggle="tooltip" data-placement="top">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="6"><em>@lang('app.no_records_found')</em></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('after-scripts-end')
@stop
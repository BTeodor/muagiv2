@extends('dashboard.layouts.master')
@section('page-title', 'Products Management')
@section('page-header')
<h1>
Products
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('app.home')</a></li>
    <li class="active">Products</li>
</ol>
@endsection
@section('content')
@include('partials.messages')

<div class="row tab-search">
    <div class="col-md-2 col-xs-2">
        <a href="{{ route('channel.product.create') }}" class="btn btn-success" id="add-user">
            <i class="glyphicon glyphicon-plus"></i>
            Add product
        </a>
    </div>
    <div class="col-md-5 col-xs-3"></div>
    <!-- Search Form -->
    <form method="GET" action="" accept-charset="UTF-8" id="products-form">
        <div class="col-md-2 col-xs-3">
            {!! Form::select('category', $category_name, Input::get('category'), ['id' => 'category', 'class' => 'form-control']) !!}
        </div>
        <div class="col-md-3 col-xs-4">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" name="search" value="{{ Input::get('search') }}" placeholder="Search for product by name or description">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" id="search-products-btn">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                    @if (Input::has('search') && Input::get('search') != '')
                        <a href="{{ route('channel.product.index') }}" class="btn btn-danger" type="button" >
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    @endif
                </span>
            </div>
        </div>
    </form>
</div>


<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Total {{$channel->countProduct()}} product(s). Current number of hot items: {{$channel->current_no_hot_product()}}. Maximum number of hot items: {{$channel->maximum_no_hot_product}}</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <div id="products-table-wrapper">
                    <table class="table table-hover table-striped">
                        <tbody>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Top sell</th>
                                <th>Original link</th>
                                <th>Regular Price</th>
                                <th>New Price</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Video Link</th>
                                <th class="text-center">Action</th>
                            </tr>
                            @if (count($products))
                            <?php $i = 1?>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{$i}}</td>
                                <?php $i++;?>
                                <td>{{ $product->title}}</td>
                                <td>
                                    @if($product->is_hot == 1) 
                                    <input type="checkbox" checked disabled>
                                    @endif
                                </td>
                                <td><a href="{{ $product->product_link}}" title="{{ $product->title}}" target="_blank">{{ $product->product_link}}</a></td>
                                <td><strike>{{ $product->old_price }}</strike></td>
                                <td>{{ $product->new_price }}</td>
                                <?php 

                                if($product->deleted_at) 
                                    echo('<td class="text-center"><p class="alert alert-danger alert-dismissible">Deleted</p></td>');
                                else 
                                    echo ('<td class="text-center"><p class="alert alert-success alert-dismissible">Active</p></td>');
                                ?>
                                <td><img src="{{ empty($product->relative_image_link) ? $product->image_link : asset($product->relative_image_link)}}" alt="{{$product->title}}" height="100px" width="100px"></td>
                                <td><a href="{{$product->video_link}}" title="{{$product->title}}" target="_blank">{{$product->video_link}}</a></td>
                                <td class="text-center">
                                    <a href="{{ route('channel.schedule.create', $product->id) }}" @if($product->deleted_at != NULL) class="btn btn-danger btn-circle" @else class="btn btn-success btn-circle" @endif
                                        data-toggle="tooltip" data-placement="top" @if($product->deleted_at != NULL) onclick="return false;" title="Restore before adding schedule" @else title="Add schedule for this product" @endif target="_blank">
                                        <i class="glyphicon glyphicon-plus"></i>
                                    </a>
                                    <a href="{{ route('channel.product.show', $product->id) }}" class="btn btn-success btn-circle"
                                        title="Quicklook" data-toggle="tooltip" data-placement="top" target="_blank">
                                        <i class="glyphicon glyphicon-eye-open"></i>
                                    </a>
                                    <a href="{{ route('channel.product.edit', $product->id) }}" class="btn btn-primary btn-circle edit" title="Edit product"
                                        data-toggle="tooltip" data-placement="top" target="_blank">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    @if($product->deleted_at == NULL)
                                    <a href="{{ route('channel.product.delete', $product->id) }}" class="btn btn-danger btn-circle" title="Delete product"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-method="DELETE"
                                        data-confirm-title="Please Confirm'"
                                        data-confirm-text="Are you sure to delete this product"
                                        data-confirm-delete="Yes, delete it">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                    @else
                                    <a href="{{ route('channel.product.restore', $product->id) }}" class="btn btn-danger btn-circle" title="Restore product"
                                        data-toggle="tooltip" data-placement="top"
                                        data-method="DELETE"
                                        data-confirm-title="Please Confirm'"
                                        data-confirm-text="Are you sure to restore this product"
                                        data-confirm-delete="Yes, restore it">
                                        <i class="fa fa-refresh"></i>
                                    </a>
                                    @endif
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
                    {!! $products->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('after-scripts-end')
<script>
$("#category").change(function () {
$("#products-form").submit();
});
</script>
@stop
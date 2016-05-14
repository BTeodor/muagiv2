@extends('dashboard.layouts.master')
@section('page-title', 'Channels Management')
@section('page-header')
<h1>
Channels
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('app.home')</a></li>
    <li class="active">Channels</li>
</ol>
@endsection
@section('content')
@include('partials.messages')
<div class="row tab-search">
    <div class="col-md-2 col-xs-2">
        <p>Manage available channels</p>
    </div>
    <div class="col-md-5 col-xs-3"></div>
    <!-- Search Form -->
    <form method="GET" action="" accept-charset="UTF-8" id="channels-form">
        <div class="col-md-2 col-xs-3">
            <p>&nbsp;</p>
        </div>
        <div class="col-md-3 col-xs-4">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" name="search" value="{{ Input::get('search') }}" placeholder="Search for channel by name, homepage or description" title="Search for channel by name, homepage or description">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" id="search-channels-btn">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                    @if (Input::get('search') != '')
                        <a href="{{ route('adminchannel.channel.list') }}" class="btn btn-danger" type="button" >
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
                <h3 class="box-title">Current channels</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <div id="products-table-wrapper">
                    <table class="table table-hover table-striped">
                        <tbody>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Logo</th>
                                <th>Homepage</th>
                                <th class="text-center">Hotline</th>
                                <th>Owner</th>
                                <th class="text-center">Maximum number of top sell positions</th>
                                <th class="text-center">Action</th>
                            </tr>
                            @if (count($channels))
                            <?php $i = 1;?>
                            @foreach ($channels as $channel)
                            <tr>
                                <th>{{$i}}</th>
                                <?php $i++;?>
                                <td>{{$channel->name}}</td>
                                <td><img src="{{ empty($channel->relative_logo_link) ? $channel->logo : asset($channel->relative_logo_link)}}" alt="{{ $channel->name}}"></td>
                                <td><a href="{{$channel->homepage}}" title="{{$channel->homepage}}">{{$channel->homepage}}</a></td>
                                <td class="text-center">{{$channel->hotline}}</td>
                                <td>{{$channel->user == NULL ? 'None' : $channel->user->username}}</td>
                                <td class="text-center">{{$channel->maximum_no_hot_product}}</td>
                                <td class="text-center">
                                    <a href="{{ route('adminchannel.channel.delete', $channel->id) }}" class="btn btn-danger btn-circle" title="Delete channel"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-method="DELETE"
                                        data-confirm-title="Please Confirm'"
                                        data-confirm-text="Are you sure to delete this channel"
                                        data-confirm-delete="Yes, delete it">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                    <a href="{{ route('adminchannel.channel.edit', $channel->id) }}" class="btn btn-success btn-circle"
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
<script>
$("#search").change(function () {
$("#channels-form").submit();
});
</script>
@stop
@extends('dashboard.layouts.master')
@section('page-title', 'Bring your products to online tv')
@section('page-header')
<h1>
Schedule
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('app.home')</a></li>
    <li class="active">Schedule</li>
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
                        <a href="{{ route('channel.schedule.index') }}" class="btn btn-danger" type="button" >
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
                <h3 class="box-title">Broadcasting Timetable</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <div id="products-table-wrapper">
                    <table class="table table-hover table-striped">
                        <tbody>
                            <tr>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Start Date</th>
                                <th>On-air Time</th>
                                <th>On-air Link</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            @if (count($schedules))
                            @foreach ($schedules as $schedule)
                            <tr>
                                <td>{{ $schedule->product()->title}}</td>
                                <td><img src="{{ empty($schedule->product()->relative_image_link) ? $schedule->product()->image_link : asset($schedule->product()->relative_image_link)}}" alt="{{$schedule->product()->title}}" height="100px" width="100px"></td>
                                <td>{{$schedule->start_date}}</td>
                                <td>{{$schedule->available_time}}</td>
                                <td>{{$schedule->stream_link}}</td>
                                <td>
                                    @if($current_time_hh_mm_GMT_7 < $schedule->start_time_string) 
                                    Upcoming
                                    @elseif($current_time_hh_mm_GMT_7 >= $schedule->start_time_string && $current_time_hh_mm_GMT_7 <= $schedule->end_time_string)
                                    On-Air
                                    @else
                                    Off-Air
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('channel.schedule.delete', $schedule->id) }}" class="btn btn-danger btn-circle" title="Delete Schedule"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-method="DELETE"
                                        data-confirm-title="Please Confirm'"
                                        data-confirm-text="Are you sure to delete this schedule"
                                        data-confirm-delete="Yes, delete it">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                    <a href="{{ route('channel.schedule.edit', $schedule->id) }}" class="btn btn-primary btn-circle edit" title="Edit product"
                                        data-toggle="tooltip" data-placement="top">
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
                    {!! $schedules->render() !!}
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
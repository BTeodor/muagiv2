@extends('dashboard.layouts.master')

@section('page-title', 'Edit schedule')

@section('page-header')
    <h1>
        Update schedule information
        <small>Schedule details</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('app.home')</a></li>
        <li><a href="{{ route('channel.product.index') }}">Products</a></li>
        <li class="active">Edit</li>
      </ol>
@endsection

@section('content')

@include('partials.messages')

{!! Form::open(['route' => 'channel.schedule.update', 'method' => 'PUT', 'id' => 'product-edit-form', 'files' => true]) !!}
    @include('dashboard.channel.schedule.schedule-edit-form')
{!! Form::close() !!}
<script type="text/javascript">
    $(function(){
        $('#start_time, #end_time').datetimepicker({
            format: 'HH:mm', 
        });
        $('#start_date').datetimepicker({
            format: 'YYYY-MM-DD',
        });
    });
</script>
@stop

@section('after-scripts-end')
    {!! Html::script('assets/js/profile.js') !!}
    {!! JsValidator::formRequest('App\Http\Requests\User\CreateUserRequest', '#user-form') !!}
@stop
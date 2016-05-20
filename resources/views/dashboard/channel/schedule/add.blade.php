@extends('dashboard.layouts.master')

@section('page-title', 'Scheduling for products')

@section('page-header')
    <h1>
        Scheduling
        <small>Schedule details</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('app.home')</a></li>
        <li><a href="{{ route('channel.schedule.index') }}">Schedule</a></li>
        <li class="active">Create</li>
      </ol>
@endsection

@section('content')

@include('partials.messages')

{!! Form::open(['route' => 'channel.schedule.store', 'method' => 'POST', 'id' => 'schedule-create-form']) !!}
    @include('dashboard.channel.schedule.schedule-create-form')
{!! Form::close() !!}
<script type="text/javascript">
    $(function(){
        $('#start_time , #end_time').datetimepicker({
            format: 'HH:mm',  
        });
        $('#start_date').datetimepicker({
            format: 'YYYY-MM-DD',
            minDate: new Date(),
        });
    });
</script>
@stop

@section('after-scripts-end')
    {!! Html::script('assets/js/profile.js') !!}
    {!! JsValidator::formRequest('App\Http\Requests\User\CreateUserRequest', '#user-form') !!}
@stop
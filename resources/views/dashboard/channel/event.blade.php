@extends('dashboard.layouts.master')

@section('page-title', 'Events on your channel')

@section('page-header')
    <h1>
        {{ $user->present()->nameOrEmail }}
        <small>Events Management</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('app.home')</a></li>
        <li class="active">Event</li>
     </ol>
@endsection

@section('content')

@include('partials.messages')

<div class="nav-tabs-custom">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#events" aria-controls="events" role="tab" data-toggle="tab">
                <i class="glyphicon glyphicon-th"></i>
                Events Details
            </a>
        </li>
        <li role="presentation" class="">
            <a href="#events-create" aria-controls="events-create" role="tab" data-toggle="tab">
                <i class="glyphicon glyphicon-th"></i>
                Events Create
            </a>
        </li>
    </ul>
    
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="events">
        @if(isset($events) && count($events) > 0)
            @foreach($events as $event)
            <div class="row">
                <div class="col-lg-9 col-md-8">
                    {!! Form::open(['route' => 'channel.event.update', 'method' => 'PUT', 'id' => 'events-form-'.$event->id]) !!}
                        @include('dashboard.channel.partials.events-details')
                        
                </div>
                <div class="col-lg-3 col-md-4">
                    {!! Form::open(['route' => 'channel.event.updatePoster',  'files' => true]) !!}
                        @include('dashboard.channel.partials.event-logo')
                    {!! Form::close() !!}
                </div>
            </div>
            @endforeach
        @endif
        </div>
        <div role="tabpanel" class="tab-pane" id="events-create">
            <div class="row">
                <div class="col-lg-8 col-md-7">
                    {!! Form::open(['route' => 'channel.event.create', 'method' => 'POST', 'id' => 'events-create-form']) !!}
                        @include('dashboard.channel.partials.events-create')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('#start_time , #end_time').datetimepicker({
            format: 'YYYY-MM-DD',
            minDate: new Date('2016-01-01'),
        });
    });
</script>
@stop

@section('after-scripts-end')
    {!! Html::script('assets/js/btn.js') !!}
    {!! Html::script('assets/js/profile.js') !!}
    {!! JsValidator::formRequest('App\Http\Requests\User\UpdateDetailsRequest', '#details-form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\User\UpdateProfileLoginDetailsRequest', '#login-details-form') !!}

    @if (config('auth.2fa.enabled'))
        {!! JsValidator::formRequest('App\Http\Requests\User\EnableTwoFactorRequest', '#two-factor-form') !!}
    @endif
@stop
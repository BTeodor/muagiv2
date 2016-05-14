<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Review Product</title>
    <script type="text/javascript" src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}" />
</head>
<body>
<div class="container-fluid">
    <div class="row">&nbsp;</div>
    <div class="panel panel-default">
        <div class="panel-heading"><big>{{$product->title}}</big></div>
        <div class="panel-body">
            <fieldset class="form-group">
                <legend>Preview</legend>
                <div class="row">
                    <div class="col-md-3">&nbsp;</div>
                    <div class="col-md-6">
                    <img class="avatar-preview img-circle" src="{{ empty($product->relative_image_link) ? $product->image_link : asset($product->relative_image_link) }}" id="preview" alt="Preview">
                    </div>
                    <div class="col-md-3">&nbsp;</div>
                </div>
                <div class="row">
                    <div class="col-md-6"><a href="{{$product->video_link}}" title="Introduction video link" style="text-decoration: none;" target="_blank"><span class="tag label label-info">Introduction video</span></a></div>
                </div>
            </fieldset>
            @if($channel != NULL)
            <fieldset class="form-group">
                <legend>From</legend>
                <div class="row">
                    <div class="col-md-6">
                    <a href="{{$channel->homepage}}" title="{{$channel->name}}" style="text-decoration: none;" target="_blank"><span class="tag label label-info">{{$channel->name}}</span></a>
                    </div>
                </div>
            </fieldset>
            @endif
            @if($channel != NULL)
            <fieldset class="form-group">
                <legend>Category</legend>
                <div class="row">
                    <div class="col-md-6">
                        @foreach($categories as $category)
                        <span class="tag label label-info">{{$category->name_en}}</span>
                        @endforeach
                    </div>
                </div>
            </fieldset>
            @endif
            @if($events != NULL)
            <fieldset class="form-group">
                <legend>Events</legend>
                <div class="row">
                    <div class="col-md-6">
                        @foreach($events as $event)
                        <a href="{{$event->event_link}}" title="{{$event->title}}" style="text-decoration: none;"><span class="tag label label-info">{{$event->title}}</span></a>
                        @endforeach
                    </div>
                </div>
            </fieldset>
            @endif
            <fieldset class="form-group">
                <legend>Price</legend>
                <div class="row">
                    <div class="col-md-6">
                    @if(empty($product->new_price))
                        <span class="tag label label-info">{{$product->old_price}}</span>
                    @else
                        <p>New price: <big><span class="tag label label-info">{{$product->new_price}}</span></big></p>
                        <p>Old price: <small><strike>{{$product->old_price}}</strike></small></p>
                    @endif
                    </div>
                </div>
            </fieldset>
            <fieldset class="form-group">
                <legend>Status</legend>
                <div class="row">
                    <div class="col-md-2 col-xs-6">
                        @if($product->deleted_at)
                            <span class="tag label label-info">Not available</span>
                        @else
                            <span class="tag label label-info">Available</span>
                        @endif 
                    </div>
                </div>
            </fieldset>
            <div class="row">
                <div class="col-md-6">
                    <a href="{{route('/')}}" title="Home" style="text-decoration: none;">Homepage</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<div class="panel panel-default">
    <div class="panel-heading">Update your schedule information</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type='text' name="title" id='title' class="form-control" disabled value="{{$schedule->product()->title}}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <img src="{{empty($schedule->product()->relative_image_link) ? $schedule->product()->image_link : asset($schedule->product()->relative_image_link)}}" alt="{{$schedule->product()->title}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                <label for="start_time_string">Start Time</label>
                    <div class="input-group date" id="start_time">
                        <input type="text" class="form-control" id="start_time_string"
                               name="start_time_string" required value="{{$schedule->start_time_string}}">
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="end_time_string">End Time</label>
                    <div class="input-group date" id="end_time">
                        <input type="text" class="form-control" id="end_time_string"
                               name="end_time_string" required value="{{$schedule->end_time_string}}">
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <label for="start_date">Start date</label>
                <input type="date" class="form-control" id="start_date"
                       name="start_date" required min="{{$today}}" value="{{$schedule->start_date}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="stream_link">Live video link</label>
                <input type="text" class="form-control" id="stream_link"
                       name="stream_link" required value="{{$schedule->stream_link}}">
            </div>
        </div>
        <div class="row">&nbsp;</div>
        <div class="row">
            <input type="hidden" name="schedule_id" value="{{$schedule->id}}"></input>
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary" id="create-details-btn">
                    <i class="glyphicon glyphicon-plus"></i>
                    Update schedule
                </button>
            </div>
        </div>
    </div>
</div>
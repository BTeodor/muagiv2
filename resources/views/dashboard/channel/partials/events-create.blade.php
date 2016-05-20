<div class="panel panel-default">
    <div class="panel-heading">Create Event</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type='text' name="title" id='title' class="form-control" required/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="event_link">Link</label>
                    <input type='text' name="event_link" id='event_link' class="form-control" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label for="start_time_string"><span title="GMT+7">Start Time</span></label>
                    <div class="input-group date" id="start_time">
                        <input type="text" class="form-control" id="start_time_string"
                               name="start_time_string" title="GMT+7">
                        <span class="input-group-addon" title="GMT+7">
                        <span class="glyphicon glyphicon-calendar" title="GMT+7"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="end_time_string"><span title="GMT+7">End Time</span></label>
                    <div class="input-group date" id="end_time">
                        <input type="text" class="form-control" id="end_time_string"
                               name="end_time_string" required title="GMT+7">
                        <span class="input-group-addon" title="GMT+7">
                        <span class="glyphicon glyphicon-calendar" title="GMT+7"></span>
                        </span>
                    </div>
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
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary" id="create-details-btn">
                    <i class="fa fa-refresh"></i>
                    Create Event
                </button>
            </div>
        </div>

    </div>

</div>
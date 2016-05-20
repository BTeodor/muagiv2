<div class="panel panel-default">
    <div class="panel-heading">Bring your product to our shopping tv</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type='text' name="title" id='title' class="form-control" disabled value="{{$product->title}}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <img src="{{empty($product->relative_image_link) ? $product->image_link : asset($product->relative_image_link)}}" alt="{{$product->title}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                <label for="start_time_string"><span title="GMT+7">Start Time</span></label>
                    <div class="input-group date" id="start_time">
                        <input type="text" class="form-control" id="start_time_string"
                               name="start_time_string" required title="GMT+7">
                        <span class="input-group-addon" title="GMT+7">
                        <span class="glyphicon glyphicon-calendar" title="GMT+7"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
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
            <div class="col-md-4">
                <div class="form-group">
                    <label for="start_date"><span title="GMT+7">Start Date</span></label>
                    <div class="input-group date" id="start_date">
                        <input type="text" class="form-control"
                               name="start_date" required title="GMT+7">
                        <span class="input-group-addon" title="GMT+7">
                        <span class="glyphicon glyphicon-calendar" title="GMT+7"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="stream_link">Live video link</label>
                <input type="text" class="form-control" id="stream_link"
                       name="stream_link" required>
            </div>
        </div>
        <div class="row">&nbsp;</div>
        <div class="row">
            <input type="hidden" name="product_id" value="{{$product->id}}"></input>
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary" id="create-details-btn">
                    <i class="glyphicon glyphicon-plus"></i>
                    Add schedule
                </button>
            </div>
        </div>
    </div>
</div>
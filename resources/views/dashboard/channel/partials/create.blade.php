<div class="panel panel-default">
    <div class="panel-heading">Information</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type='text' name="name" id='name' value="" class="form-control" required/>
                </div>
                <div class="form-group">
                    <label for="homepage">Homepage</label>
                    <input type='text' name="homepage" id='homepage' value="" class="form-control" required/>
                </div>
                <div class="form-group">
                    <label for="hotline">Hotline</label>
                    <input type="text" class="form-control" id="hotline"
                           name="hotline" placeholder="" value="">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description"
                           name="description" placeholder="" value="">
                </div>
            </div>

            @if ($edit)
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" id="update-details-btn">
                        <i class="fa fa-refresh"></i>
                        Create Channel
                    </button>
                </div>
            @endif
        </div>
    </div>

</div>
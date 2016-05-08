<div class="well">
    <h3 class="page-header">Event Poster</h3>
    <div class="avatar-wrapper">
        <div class="row">
            <img class="avatar-preview img-circle" src="{{ isset($event) && count($event) ? asset($event->relative_image_link) : url('assets/img/profile.png') }}" id="preview" alt="Preview">
            <input type="file" name="poster" id="poster-upload" class="form-control">
            <input type="hidden" name="id" value="{{$event->id}}">
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary" id="create-details-btn">
                    <i class="fa fa-refresh"></i>
                    Update Poster
                </button>
            </div>
        </div>

    </div>
</div>
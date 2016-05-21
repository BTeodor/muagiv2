<div class="panel panel-default">
    <div class="panel-heading">Add Product</div>
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
                    <label for="product_link">Product link (If available)</label>
                    <input type='text' name="product_link" id='product_link' class="form-control" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="image_link">Image URL (If available)</label>
                    <input type="text" class="form-control" id="image_link"
                           name="image_link" placeholder="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="image_file">Or Upload Image</label>
                    <input type="file" class="form-control" id="image_file"
                           name="image_file" placeholder="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="old_price">Regular Price</label>
                    <input type="text" class="form-control" id="old_price"
                           name="old_price" placeholder="" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="new_price">Sell Price</label>
                    <input type="text" class="form-control" id="new_price"
                           name="new_price" placeholder="">
                </div>
            </div>
        </div>
        @include('dashboard.channel.partials.category')
        <div class="row">
            <div class="col-md-6">
                <label for="video_link">Introduction video link</label>
                <input type="text" class="form-control" id="video_link"
                       name="video_link" placeholder="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="keywords">Keywords Required</label>
                    <input type="text" class="form-control" id="keywords" placeholder="Keyword can be provider, sub-category of product, usage of product ..." value="" name="keywords" required></input>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" rows="15" class="form-control" id="description" placeholder="Description goes here"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary" id="create-details-btn">
                    <i class="glyphicon glyphicon-plus"></i>
                    Add product
                </button>
            </div>
        </div>

    </div>

</div>
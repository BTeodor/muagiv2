<div class="panel panel-default">
    <div class="panel-heading">Update Product Details</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type='text' name="title" id='title' class="form-control" required value="{{ $product->title }}" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="product_link">Original link</label>
                    <input type='text' name="product_link" id='product_link' class="form-control" value="{{ $product->product_link }}"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="image_link">Image URL</label>
                    <input type="text" class="form-control" id="image_link"
                           name="image_link" placeholder="" value="{{ $product->image_link }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="image_file">Or change image</label>
                    <img src="{{ empty($product->relative_image_link) ? $product->image_link : asset($product->relative_image_link) }}" alt="">
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
                           name="old_price" placeholder="" required value="{{ $product->old_price }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="new_price">Sell Price</label>
                    <input type="text" class="form-control" id="new_price"
                           name="new_price" placeholder="" value="{{ $product->new_price }}">
                </div>
            </div>
        </div>
        @include('dashboard.channel.partials.category')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description" placeholder="">{{ $product->description }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary" id="create-details-btn">
                    <i class="fa fa-refresh"></i>
                    Update product
                </button>
            </div>
        </div>

    </div>

</div>
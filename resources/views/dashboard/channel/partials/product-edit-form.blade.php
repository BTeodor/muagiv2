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
                <input type="hidden" name="is_hot" value="0"></input>
                <label>Hot product: <input type="checkbox" name="is_hot" value="1" data-on-text="Hot" data-off-text="Normal" data-size="mini" id="switch" {{ $product->is_hot ? 'checked' : ''}}></label>
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
            <div class="col-md-6">
                <label for="video_link">Introduction video link</label>
                <input type="text" class="form-control" id="video_link"
                       name="video_link" placeholder="" value="{{$product->video_link}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="keywords">Keywords (Required)</label>
                    <input type="text" class="form-control" id="keywords" placeholder="Keyword can be provider, sub-category of product, usage of product ..." value="{{$product->json_keyword}}" name="keywords" required></input>
                    <?php //if(count(json_decode($product->json_keyword)) != 0) echo implode(",", json_decode($product->json_keyword)); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" rows="15" class="form-control" id="description" placeholder="">{{ $product->description }}</textarea>
                    <input type="hidden" name="product_id" value="{{$product->id}}"></input>
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
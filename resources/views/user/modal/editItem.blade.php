 <!--Add Item modal -->
 <div class="modal fade" id="item{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <form action="{{route('updateProduct')}}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Code</label>
                    <input type="email" class="form-control input-sm"   placeholder="{{$product->code}}" disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Item Name</label>
                      <input type="text" name="name" class="form-control input-sm"  value="{{$product->name}}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Quantity</label>
                      <input type="number" name="quantity" class="form-control input-sm" min="1" value="{{$product->quantity}}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price</label>
                      <input type="number" name="price" class="form-control input-sm" step="0.01" value="{{$product->price}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Category</label>
                        <select class="form-control" name="category">
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected': ''}}>{{$category->name}}</option>
                            @endforeach
                          </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Size</label>
                      <input type="number" name="size" class="form-control input-sm" value="{{$product->size}}" min="0">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Color</label>
                      <input type="text" name="color" class="form-control input-sm" value="{{$product->color}}">
                    </div>
                    <div class="form-group">
                      <label for="details">Details:</label>
                      <textarea id="details-ckeditor{{$product->id}}" class="form-control" name="details" rows="5" >
                        {!!$product->details!!}
                      </textarea>
                    </div>                  
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <label for="exampleFormControlFile1">Upload Cover Image</label>
                    <input type="file" name="profile" class="form-control-file uploadProfile" data-id="{{$product->id}}" id="up{{$product->id}}" >
                  </div>
                  <div class="row" id="profileContainer{{$product->id}}" >
                    <div class="col-sm-12">
                        <img src="" alt="" id="output" class="img-fluid ">
                      <small class="text-danger" id="showProfileErr{{$product->id}}" style="display:none">Upload Image only!</small>
                        <small class="text-danger" id="showSizeErr{{$product->id}}" style="display:none">Image is too large! max size is 2mb</small>
                    </div>
                  </div>
                  <div class="form-group mt-2">
                    <label for="exampleFormControlFile1">Uplod 3 pictures of the product</label>
                    <input type="file" name="image[]" class="form-control-file uploadFile" id="uploadFile{{$product->id}}" data-id="{{$product->id}}"  multiple >
                  </div>
                  <div class="row" class="imageContainer" id="imageContainer{{$product->id}}">
                    <div class="col-sm-12">
                        <img src="" alt="" id="output" class="img-fluid ">
                      <small class="text-danger " id="showErr{{$product->id}}"  style="display:none">Upload 3 image only!</small>
                        <small class="text-danger " id="showMinErr{{$product->id}}"  style="display:none">Upload 3 Image! </small>
                        <small class="text-danger " id="showImageErr{{$product->id}}"  style="display:none">Upload Image only!</small>
                        <small class="text-danger " id="showImageSizeErr{{$product->id}}"  style="display:none">One of the image is too large! max size is 2mb</small>
                    </div>
                  </div>
              </div>
            </div>
          </div>
            <input type="hidden" name="product_id" value="{{$product->id}}">
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Edit</button>
          </div>
      </form>
      </div>
    </div>
  </div>
 

<div class="modal fade" id="imageModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Post Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('storeProduct')}}" method="POST" enctype="multipart/form-data">
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
                    <input type="text" name="name" class="form-control input-sm"  placeholder="{{$product->name}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Quantity</label>
                        <input type="number" name="quantity" class="form-control input-sm" min="1" placeholder="{{$product->quantity}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Price</label>
                        <input type="number" name="price" class="form-control input-sm" step="0.01" placeholder="{{$product->price}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Category</label>
                        <select class="form-control" name="category">
                            <option value="1">Volvo</option>
                            <option value="2">Saab</option>
                            <option value="3">Mercedes</option>
                            <option value="4">Audi</option>
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Size</label>
                        <input type="number" name="size" class="form-control input-sm" placeholder="{{$product->size}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Color</label>
                        <input type="text" name="color" class="form-control input-sm" placeholder="{{$product->color}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="details">Details:</label>
                        <textarea id="details-ckeditor" class="form-control" name="details" rows="5"  disabled>
                            {!!$product->details!!}
                        </textarea>
                    </div>                  
                </div>
                <div class="col-md-6">
                <h3>Item Images:</h3>
                    <div class="row" id="imageContainer">
                        @foreach (explode(',',$product->image) as $item)
                        @if ($item !== "")
                        <div class="col-md-12 mt-2">
                            <img class="img-fluid img-thumbnail" src="{{asset('uploads/'.$item)}}" alt="">
                        </div>                                
                        @endif                          
                    @endforeach
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
        </div>
    </div>
    </div>
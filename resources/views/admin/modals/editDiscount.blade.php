  <!--Add Item modal -->
  <div class="modal fade" id="editDiscount{{$discount->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Discount</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
    <form action="{{route('discountUpdate', ['id' => $discount->id])}}" method="POST" >
        {{ csrf_field() }}
        <div class="modal-body">
            <div class="form-group">
            <label for="exampleInputEmail1">Barangay Name</label>
            <input type="text" name="name" class="form-control input-sm" value="{{$discount->name}}" required >
            </div>
            <div class="form-group">
            <label for="exampleInputEmail1">Percentage</label>
            <input type="number" name="percentage" class="form-control input-sm" value="{{$discount->percentage}}" required >
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

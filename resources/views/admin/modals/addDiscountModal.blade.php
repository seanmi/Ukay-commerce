  <!--Add Item modal -->
  <div class="modal fade" id="addDiscount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Discount</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
    <form action="{{route('discountPost')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-body">
            <div class="form-group">
            <label for="exampleInputEmail1">Label</label>
            <input type="text" name="name" class="form-control input-sm"  >
            </div>
            <label for="exampleInputEmail1">Discount Percentage</label>
            <div class="input-group mb-3">
            <input type="number" class="form-control input-sm" name="percentage" min="1">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">%</span>
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

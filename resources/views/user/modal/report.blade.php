  <!--Add Item modal -->
  <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
    <form action="{{route('report')}}" method="POST" >
        {{ csrf_field() }}
        <div class="modal-body">
            <div class="form-group">
            <label for="exampleInputEmail1">Details</label>
            <textarea name="details" id="" cols="30" rows="10" class="form-control input-sm" ></textarea>
            </div>
        </div>
        <input type="hidden" name="product_id" value="{{$product->id}}">
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Report</button>
        </div>
    </form>
    </div>
    </div>
</div>
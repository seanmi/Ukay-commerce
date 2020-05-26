  <!--Add Item modal -->
    <div class="modal fade" id="order{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order Summary</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

                <ul class="list-group">
                    @foreach ($order->orderItems as $item)
                    <li class="list-group-item">{{$item->product->name." "."($item->total_quantity)"}} <span class="float-right">₱{{number_format($item->total_price,2)}}</span></li>
                    @endforeach
                    <li class="list-group-item">Shipping fee <span class="float-right">₱{{number_format( $order->user->bar->shipping_fee,2)}}</span></li>
                    <li class="list-group-item">Total <span class="float-right">₱{{number_format($order->orderItems->sum('total_price')+ $order->user->bar->shipping_fee,2)}}</span></li>
                    
                </ul>
                
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
</div>

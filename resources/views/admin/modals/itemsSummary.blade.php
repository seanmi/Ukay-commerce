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

                    <li class="list-group-item">(<small>Seller: {{$item->product->user->name}}</small>) {{$item->product->name." "."($item->total_quantity)"}} <span class="float-right">₱{{number_format(round($item->total_price,1),2)}}</span></li>
                    @endforeach
                    <li class="list-group-item">Shipping Fee <span class="float-right">₱{{number_format($order->shipping_fee,2)}}</span></li>
                    <li class="list-group-item">Total <span class="float-right">₱{{number_format(round($order->orderItems->sum('total_price')+$order->shipping_fee,1),2)}}</span></li>
                </ul> <hr class="my-4">
                
                <h3 class="mb-2">Seller Receivables</h3>
                <ul class="list-group">
                    @foreach ($order->orderItems as $item)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4">
                                    <small>Seller ID: {{$item->product->user->id}}; Name:{{$item->product->user->name}}</small> 
                            </div>
                            <div class="col-md-4 text-center">
                                    <small>Item: {{$item->product->name." "."($item->total_quantity)"}}</small>
                            </div>
                            <div class="col-md-4 text-right">
                                    <small> ₱{{number_format(round($item->takehome,1),2)}}</small>
                            </div>
                        </div>
                        
                    </li>
                    @endforeach
                </ul>
        </div>
        <hr>
        <div class="modal-body m-2">
                <div class="row mb-3">
                        <div class="col-md-12 " >
                          <h3 class="modal-title">Shipping Details</h3>
                        </div>
                    </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                      <i class="fas fa-street-view"></i>{{$order->user->name}}
                    </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-12">
                      <i class="fas fa-address-card"></i>{{$order->user->house_number." ".$order->user->bar['name'].", Angeles City, Pampanga"}}
                  </div> 
              </div>
              <div class="row mb-3">
                  <div class="col-md-12">
                      <i class="fas fa-mobile-alt"></i>{{$order->user->contact_no}}
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-md-12">
                      <i class="fas fa-envelope-square"></i>{{$order->user->email}}
                  </div>
              </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
</div>

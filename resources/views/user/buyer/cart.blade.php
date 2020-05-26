@extends('user.buyer.layouts.app')

@section('content')

<div class="hero-wrap hero-bread" style="background-image:url({{asset('images/bg_6.jpg')}}) ">
	<div class="container">
	  <div class="row no-gutters slider-text align-items-center justify-content-center">
		<div class="col-md-9 ftco-animate text-center">
		  <h1 class="mb-0 bread">My Cart</h1>
		</div>
	  </div>
	</div>
  </div>

<section class="ftco-section ftco-cart">
  <div id="shopping-cart">
	  <div class="txt-heading">Shopping Cart</div>
	  {{-- <a id="btnEmpty" href="cart.php?action=empty">Empty Cart</a> --}}
			  <table class="table-responsive " cellpadding="13" cellspacing="1">
			  <tbody>
			  <tr>
			  <th style="text-align:left;">Name</th>
			  <th style="text-align:left;">Code</th>
			  <th style="text-align:right;" width="5%">Quantity</th>
			  <th style="text-align:right;" width="10%">Unit Price</th>
			  <th style="text-align:right;" width="10%">Original Price</th>
			  <th style="text-align:right;" width="10%">Discounted Price</th>
			  <th style="text-align:right;" width="10%">Total</th>
			  <th style="text-align:right;" width="5%">Remove</th>
			  </tr>	
			  @foreach (Auth::user()->cart->item as $item)
			  	<tr>
				  <td><a href="{{route('viewProduct', ['id' => $item->product->id])}}" style="color:gray !important;"> <img src="{{asset('uploads/'.$item->product->profile)}}" class="cart-item-image" />{{$item->product->name}}</a></td>
				  	<td>{{$item->product->code}}</td>
				  	<td  style="text-align:right;">{{$item->quantity}}</td>
					<td  style="text-align:right;">{{number_format($item->product->price + $item->product->additional_price,2) }}</td>
					<td  style="text-align:right;">Php {{number_format($item->sub_total,2)}}</td>
					<td  style="text-align:right;">Php {{number_format($item->deduction,2)}}</td>
					<td  style="text-align:right;">Php {{number_format($item->total,2)}}</td>
				  <td style="text-align:center;"><a href="{{route('removeItem',['id' => $item->product->id])}}" class="btnRemoveAction"><i class="fas fa-trash"></i></a></td>
				</tr>				  
			  @endforeach
			  </tbody>
			  </table>
			  @if (Auth::user()->cart->item->count() == 0)
				<div class="no-records">Your Cart is Empty</div>
			  @endif
  </div>
<div class="container"><hr class="style-four"><hr></div>
@if (Auth::user()->cart->item->count() !== 0)
	
<div class="container">
	<div class="row justify-content-center">
		<div class="col col-lg-5 col-md-6 mt-5 cart-wrap ">
			<div class="cart-total mb-3">
				<h3>Cart Total</h3>
				<p class="d-flex">
					<span>Subtotal</span>
				<span>₱ {{number_format(Auth::user()->cart->item->sum('sub_total'),2)}}</span>
				</p>
				<p class="d-flex">
						<span>Discount</span>
						<span>₱ {{number_format(Auth::user()->cart->item->sum('deduction'),2)}}</span>
					</p>
				<p class="d-flex">
					<span>Delivery</span>
				<span>₱ {{Auth::user()->bar->shipping_fee}}</span>
				</p>
				<hr>
				<p class="d-flex total-price">
					<span>Total</span>
				<span>₱ {{number_format(Auth::user()->cart->item->sum('total') +Auth::user()->bar->shipping_fee,2)}}<span>
				</p>
			</div>
			<p class="text-center"><button class="btn btn-primary py-3 px-4"  data-toggle="modal" data-target="#exampleModal">Place Order</button></p>
		</div>
	</div>
	</div>
@endif
<div class="container"><hr class="style-four"></hr></div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalLabel">Shipping and  Billing</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body m-2">
		  <div class="row mb-3">
			  <div class="col-md-12">
				<i class="fas fa-street-view"></i>{{Auth::user()->name}}
			  </div>
		  </div>
		  <div class="row mb-3">
			<div class="col-md-12">
				<i class="fas fa-address-card"></i>{{Auth::user()->house_number." ".Auth::user()->bar->name.", Angeles City, Pampanga"}}
			</div> 
		</div>
		<div class="row mb-3">
			<div class="col-md-12">
				<i class="fas fa-mobile-alt"></i>{{Auth::user()->contact_no}}
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-md-12">
				<i class="fas fa-envelope-square"></i>{{Auth::user()->email}}
			</div>
		</div>
		<hr>
		<h3>Order Summary</h3>
		<div class="row mb-3">
			<div class="col-md-6">
				Subtotal ({{Auth::user()->cart->item->count()}}) item/s
			</div>
			<div class="col-md-6  text-right pr-2">
				₱{{number_format(Auth::user()->cart->item->sum('total'),2)}}
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-md-6">
				Shipping Fee
			</div>
			<div class="col-md-6  text-right pr-2">
				₱{{Auth::user()->bar->shipping_fee}}
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-md-6">
				Total
			</div>
			<div class="col-md-6   text-right pr-2">
				₱{{number_format(Auth::user()->cart->item->sum('total') +Auth::user()->bar->shipping_fee,2)}}
			</div>
		</div>
		<div class="modal-footer">
		  <a href="" class="btn btn-secondary" data-dismiss="modal">Close</a>
			<a href="{{route('checkout')}}" id="removeBtn" class="btn btn-primary">Check out</a>
		</div>
	  </div>
	</div>
</div>

</section>
@endsection

@section('script')
	<script>
		const btn = document.getElementById('removeBtn');
		btn.addEventListener('click', function(){
			btn.parentNode.removeChild(btn);
		});
	</script>
@endsection

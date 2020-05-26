@extends('user.buyer.layouts.app')

@section('content')
<div class="container"><hr class="style-four"></hr></div>
    <div class="col-md-12 heading-section text-center ftco-animate">
        <h4 class="mb-4">Categories</h4>
        </div>
    </div>
<div class="text-center">
    @foreach ($categories as $category)
<li class="list-inline-item"><a href="{{route('landing', ['category' => $category->id])}}">{{$category->name}}</a></li>     
    @endforeach
</div>

<div class="container"><hr class="style-four"></hr></div>
<section class="bg-light">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
            <h2 class="mb-4">Products</h2>
                <p>Shop your favorite clothes</p>
            </div>
        </div>   		
    </div>
    <section class=" bg-light">  		
        <div class="container">
            <div class="row">
                @foreach ($products as $product)
                <div class=" col-md-6 col-lg-3 ftco-animate">
                    <div class="product">
                    <a href="{{route('viewProduct', ['id'=>$product->id])}}"class="img-prod"><img class="img-fluid" src="{{asset('uploads/'.$product->profile)}} " width='100%' alt="Colorlib Template">
                        @if ($product->discount_id !== NULL)   
                        <span class="status">{{$product->discount->percentage}}%</span>
                            <div class="overlay"></div>
                        </a>                           
                        @endif
                        <div class="text py-3 px-3">
                        <h3><a href="#">{{$product->name}}</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    @if ($product->discount_id !==NULL)
                                        <p class="price"><span class="mr-2 price-dc">₱{{$product->price}}</span><span class="price-sale">₱{{round(($product->price + $product->additional_price)*((100 - $product->discount->percentage)/100),2)}}</span></p>
                                    @else  
                                        <p class="price"><span class="price-sale">₱{{number_format($product->price + $product->additional_price,2)}}</span></p>
                                    @endif                                          
                                </div>
                                <div class="rating">
                                    <p class="text-right">
                                        {{-- <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a> --}}
                                    </p>
                                </div>
                            </div>
                            <p class="bottom-area d-flex px-3">
                                @if ($product->seller_id !== Auth::user()->id)
                                <a href="{{route('addOneItem', ['id' => $product->id])}}" class="add-to-cart text-center py-2 mr-1" ><span>Add to cart <i class="fas fa-cart-plus"></i></span></a>   
                                @endif 
                                <a href="{{route('viewProduct', ['id'=>$product->id])}}" class="buy-now text-center py-2">Preview<span> <i class="ml-1 fas fa-eye"></i> </span></a>
                            </p>
                        </div>
                    </div>
                </div>                   
                @endforeach
            </div>
        </div>
    </section>
</section>
@endsection
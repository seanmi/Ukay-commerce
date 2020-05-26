@extends('user.buyer.layouts.app')
@section('link')
    <style>

    </style>
@endsection
@section('content')
<div class="container"></div>
<section class="bg-light mb-3 pt-4"> 		
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="card text-center scaling" style="width:auto">
                        <div class="card-body text-center">
                            <img src="{{asset('uploads/'.$product->profile)}}" class="img img-fluid" alt="">
                        </div>
                        <ul class="list-group list-group-flush">
                            <form action="{{route('addItem')}}" method="POST">
                                {{ csrf_field() }}
                                <li class="list-group-item h3 text-center">{{$product->name}}</li>
                                @if ($product->quantity != 0)
                                    <li class="list-group-item text-center">
                                        <div class="form-group">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-default" id="minus"><i class="fas fa-minus"></i></button>   
                                                </div>
                                                <input type="text" name="quantity" id="myNumber" data-max="{{$product->quantity}}" class="form-control input-number text-center" value="1" min="1"  {{Auth::user()->id == $product->seller_id ? 'disabled' : ''}}/>
                                                <input type="hidden" name="item" value="{{$product->id}}">
                                                <div class="input-group-btn">
                                                    <button  class="btn btn-default" id="plus"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                <li class="list-group-item text-center">
                                    <div class="text-center">
                                        <small>{{$product->quantity}} remaining item/s </small> <br>     
                                        <small>posted by: {{$product->user->name}}</small> 
                                        <small>
                                            @if ($product->report->where('user_id', '=', Auth::user()->id)->count() == 0)
                                                @if ($product->user->id !== Auth::user()->id)
                                                    <a href="" data-toggle="modal" data-target="#reportModal">Report seller!</a>   
                                                @endif                                              
                                            @endif

                                        </small>
                                    </div>
                                </li>
                            @if ($product->quantity != 0)
                                <li class="list-group-item text-center"><button class="btn btn-primary " {{Auth::user()->id == $product->seller_id ? 'disabled' : ''}}>Add to Cart</button>  
                                    @if ($product->seller_id !== Auth::user()->id)
                                        @if ($product->wishlist->where('user_id','=', Auth::user()->id)->count() == 0)
                                        or
                                        <a href="{{route('addWishlist', ['id' => $product->id])}}">Add to Wishlist</a>   
                                        @endif   
                                    @endif     
                                </li>                                   
                            @endif     
                            </form>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-10">
                            <div id="demo" class="carousel slide mt-4" data-ride="carousel">
                                    <ul class="carousel-indicators">
                                        @foreach (explode(',', $product->image) as $key=>$item)
                                            @if ($item !=="")
                                            <li data-target="#demo" data-slide-to="{{$key-1}}" class="{{$key ==1 ? 'active': ''}}"></li>
                                            @endif
                                        @endforeach
                                    </ul> 
                                    <div class="carousel-inner">              
                                        @foreach (explode(',', $product->image) as $key=>$item)
                                            @if ($item !== "")
                                                <div class="carousel-item {{$key ==1 ? 'active': ''}}">
                                                    <img class="img-fluid img-thumbnail" src="{{asset('uploads/'.$item)}}" alt="Los Angeles" width="100%">
                                                </div>    
                                            @endif
                                        @endforeach
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </a>
                                    <a class="carousel-control-next" href="#demo" data-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </a>
                                </div>
                        </div>
                    </div>                  
                </div>   
                </div>
            </div>
            <hr>             
                    <table class="table " id="s" style="min-width: 0px !important;">
                        <thead>
                            <tr>
                            <th scope="col" colspan="2">Item Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td>Item Name</td>
                            <td>{{$product->name}}</td>
                            </tr>
                            <tr>
                            <td>Price</td>
                            <td>₱{{number_format($product->price + $product->additional_price,2)}}</td>
                            </tr>
                            <tr>
                            <td>Size</td>
                            <td>{{$product->size}}</td>
                            </tr>
                            <tr>
                            <td>Color</td>
                            <td>{{$product->color}}</td>
                            </tr>
                            <tr>
                            <td>Details</td>
                            <td>{!!$product->details!!}</td>
                            </tr>
                        </tbody>
                    </table>
  
            <hr>
            <div class="col-sm-12 text-center " >
                    <h1>Ratings</h1>
                    <span class="h3" class="selected-rating" id="ratingVal">0</span><small> / 5</small>
                </div>             
                <div class="col-md-12 p-4">
                    <div class="form-group text-center" id="rating-ability-wrapper">
                        <label class="control-label" for="rating">
                        <span class="field-label-info"></span>
                        <input type="hidden" id="selected_rating" name="selected_rating" value="" required="required">
                        </label>
                        <h2 class="bold rating-header" style="">
                            You rated this
                        </h2>
                        <button type="button" class="btnrating btn btn-default btn-lg " data-attr="1" id="rating-star-1">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btnrating btn btn-default btn-lg" data-attr="2" id="rating-star-2">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btnrating btn btn-default btn-lg" data-attr="3" id="rating-star-3">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btnrating btn btn-default btn-lg" data-attr="4" id="rating-star-4">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btnrating btn btn-default btn-lg" data-attr="5" id="rating-star-5">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </button>
                    </div>
                </div> 
        </div>
</section>
@include('user.modal.report')
<div class="container"></div>
<div class="container"></div>
@endsection

@section('script')
    <script src="{{asset('js/axios.min.js')}}"></script>
    <script>
        let minus = document.getElementById('minus');
        let plus = document.getElementById('plus');
        let myNumber = document.getElementById('myNumber');
        let dataMax = myNumber.getAttribute('data-max');
        let dataMin = 1;
        console.log(dataMax);
        

        minus.addEventListener('click', (e)=>{
            e.preventDefault();
            
            if(parseInt(myNumber.value) > dataMin ){
                myNumber.value = parseInt(myNumber.value) -1;
            }  
        })
        plus.addEventListener('click', (e)=>{
            e.preventDefault();
            if(parseInt(myNumber.value) < dataMax)
            myNumber.value =  parseInt(myNumber.value)+1;
        })
        getRating();
        function getRating(){
            axios.get(`/api/rate/${{!!$product->id!!}}/${{!!Auth::user()->id!!}}`)
            .then(function (response) {
                console.log(response.data.rating);
                let rating = parseInt(response.data.rating);
                if(response.data !== ""){
                    let buttons = document.getElementsByClassName('btnrating');
                    Array.from(buttons, element=>{
                        let attr = element.getAttribute('data-attr');
                        if(parseInt(attr) <= rating){
                            element.className += ' btn-warning';
                            element.disabled = true;
                        }
                    })
                    disableStars();     
                }
                
            })
            .catch(function (error) {
                console.log(error);
            });
        }
        getStars();
        function getStars(){
            axios.get(`/api/rate/${{!!$product->id!!}}`)
            .then(function (response) {
                console.log(response.data);
                let spanBtn = document.getElementById('ratingVal');
                if(parseInt(response.data) == 0){
                    spanBtn.value = 0;
                }else{
                    spanBtn.textContent = response.data; 
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        }

        let starbuttons = document.getElementsByClassName('btnrating');
        Array.from(starbuttons, element => {
            element.addEventListener('click', ()=>{
                disableStars();
                axios.post('/api/rate', {
                    user_id: {{Auth::user()->id}},
                    product_id: {!!$product->id!!},
                    rating: element.getAttribute('data-attr')
                })
                .then(function (response) {
                    console.log(response);
                    getStars();
                    
                })
                .catch(function (error) {
                    console.log(error);
                });
            })
        })

        function disableStars(){
            Array.from(document.getElementsByClassName('btnrating'), element=>{
                element.disabled = true;
            })
        }

    </script>
@endsection
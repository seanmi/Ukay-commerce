@extends('user.buyer.layouts.app')

@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('{{asset('images/bg_6.jpg')}}');">
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>About</span></p>
          <h1 class="mb-0 bread">About Us</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section ftco-no-pb ftco-no-pt bg-light">
          <div class="container">
              <div class="row">
                  <div class="col-md-5 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url({{asset('images/about.jpg')}});">
                      <a href="https://vimeo.com/45830194" class="icon popup-vimeo d-flex justify-content-center align-items-center">
                          <span class=""><i class="fas fa-play"></i></span>
                      </a>
                  </div>
                  <div class="col-md-7 py-5 wrap-about pb-md-5 ftco-animate">
            <div class="heading-section-bold mb-4 mt-md-5">
                <div class="ml-md-0">
                  <h2 class="mb-4">Better Way to Ship Your Products</h2>
              </div>
            </div>
            <div class="pb-md-5">
                          <p>This app deliver items surely and trusted</p>
                          <div class="row ftco-services">
                    <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
                      <div class="media block-6 services">
                        <div class="icon d-flex justify-content-center align-items-center mb-4">
                        <img class="img-fluid" src="{{asset('images/refund.jpg')}}" alt="">
                        </div>
                        <div class="media-body">
                          <h3 class="heading">Refund Policy</h3>
                        </div>
                      </div>      
                    </div>
                    <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
                      <div class="media block-6 services">
                        <div class="icon d-flex justify-content-center align-items-center mb-4">
                                <img class="img-fluid" src="{{asset('images/premium.png')}}" alt="">
                              {{-- <span class="flaticon-001-box"></span> --}}
                        </div>
                        <div class="media-body">
                          <h3 class="heading">Premium Packaging</h3>
                          <p>If the sealed is broken do not accept the item.</p>
                        </div>
                      </div>    
                    </div>
                    <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
                      <div class="media block-6 services">
                        <div class="icon d-flex justify-content-center align-items-center mb-4">
                        <img class="img-fluid" src="{{asset('images/Quality.jpg')}}" alt="">

                              {{-- <span class="flaticon-003-medal"></span>    <span class="flaticon-003-medal"></span> --}}
                        </div>
                        <div class="media-body">
                          <h3 class="heading">Superior Quality</h3>
                        </div>
                      </div>      
                    </div>
                  </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>


    <section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url({{asset('images/bg_4.jpg')}}) ">
      <div class="container">
          <div class="row justify-content-center py-5">
              <div class="col-md-10">
                  <div class="row">
                <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                  <div class="block-18 text-center">
                    <div class="text">
                      <strong class="number" data-number="10000">0</strong>
                      <span>Happy Customers</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                  <div class="block-18 text-center">
                    <div class="text">
                      <strong class="number" data-number="100">0</strong>
                      <span>Branches</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                  <div class="block-18 text-center">
                    <div class="text">
                      <strong class="number" data-number="1000">0</strong>
                      <span>Partner</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                  <div class="block-18 text-center">
                    <div class="text">
                      <strong class="number" data-number="100">0</strong>
                      <span>Awards</span>
                    </div>
                  </div>
                </div>
              </div>
          </div>
      </div>
      </div>
  </section>

  
    
@endsection
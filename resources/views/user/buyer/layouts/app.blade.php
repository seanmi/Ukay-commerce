<!DOCTYPE html>
<html lang="en">
  <head>
    <title>HOMEPAGE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/open-iconic-bootstrap.min.css')}}">

    <link href="{{asset('css/admin-css/T-admin_panel/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.timepicker.css')}}">

    
    <link rel="stylesheet" href="{{asset('css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    
    <link href="{{asset('css/admin-css/T-admin_panel/vendor/datatables/rowReorder.dataTables.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/admin-css/T-admin_panel/vendor/datatables/responsive.dataTables.min.css')}}" rel="stylesheet">
    <style>
      .rating-header {
        margin-top: -10px;
        margin-bottom: 10px;
    }
    </style>
    @yield('links')
  </head>
  <body class="goto-here">
		<div class="py-1 navbar-custom">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
	    		<div class="col-lg-12 d-block">
		    		<div class="row d-flex">
		    			<div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						    <span class="text">+63 935 219 2297</span>
					    </div>
					    <div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
						    <span class="text">youremail@email.com</span>
					    </div>
					    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
						    <span class="text">3-5 Business days delivery</span>
					    </div>
				    </div>
			    </div>
		    </div>
		  </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-custom navbar-dark ftco_navbar bg-dark ftco-navbar-white ftco-navbar-custom" id="ftco-navbar">
	    <div class="container">
      <a class="navbar-brand" href="#"><img src="{{asset('images/yaku.png')}}" width="200" style="background-color: white;"></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <i class="fas fa-bars"></i> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="{{route('landing')}}" class="nav-link">Home</a></li>
		
            <li class="nav-item"><a href="{{route('myAccount')}}" class="nav-link">Sell</a></li>
            <li class="nav-item"><a href="{{route('aboutUs')}}" class="nav-link">About</a></li>
	          <!-----<li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>----->
            <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
            <li class="nav-item"><a href="{{route('wishlist')}}" class="nav-link">Wishlist</a></li>
            <li class="nav-item cta cta-colored"><a href="{{route('indexCart')}}" class="nav-link"><i class="fas fa-cart-plus"></i>[{{Auth::user()->cart->item->count()}}]</a></li>

            <button class="btn btn-primary" data-toggle="modal" data-target="#logoutModal">Logout</button>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
	{{-- <div class="jumbotron">
		<h1>Bootstrap Tutorial</h1> 
		<p>Bootstrap is the most popular HTML, CSS...</p> 
	</div> --}}

	@yield('content')

    <footer class="ftco-footer bg-light ftco-section">
      <div class="container">
      	<div class="row">
      		<div class="mouse">
						<a href="#" class="mouse-icon">
							<div class="mouse-wheel"><i class="fas fa-arrow-up"></i></span></div>
						</a>
					</div>
      	</div>
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Ukay-ukay</h2>
              <p>Pre-loved fashion web application shopping.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <!------<li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>------>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Menu</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">Shop</a></li>
                <li><a href{{route('aboutUs')}} class="py-2 d-block">About</a></li>
                <li><a href="#" class="py-2 d-block">Journal</a></li>
                <li><a href="#" class="py-2 d-block">Contact Us</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Help</h2>
              <div class="d-flex">
	              <ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
	                <li><a href="#" class="py-2 d-block">Shipping Information</a></li>
	                <li><a href="#" class="py-2 d-block">Returns &amp; Exchange</a></li>
	                <li><a href="#" class="py-2 d-block">Terms &amp; Conditions</a></li>
	                <li><a href="#" class="py-2 d-block">Privacy Policy</a></li>
	              </ul>
	              <ul class="list-unstyled">
	                <li><a href="#" class="py-2 d-block">FAQs</a></li>
	                <li><a href="#" class="py-2 d-block">Contact</a></li>
	              </ul>
	            </div>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text"> City College of Angeles</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+63 935 219 2297</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">ukay@gmail.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</p>
          </div>
        </div>
      </div>
    </footer>

     <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <form action="{{route('logout')}}" method="POST">
            <div class="modal-footer">
                
                    {{ csrf_field() }}
                    
                
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button class="btn btn-primary" type="submit">Logout</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="{{asset('js/js/jquery.min.js')}}"></script>
  <script src="{{asset('js/js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{asset('js/js/popper.min.js')}}"></script>
  <script src="{{asset('js/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('js/js/jquery.easing.1.3.js')}}"></script>
  <script src="{{asset('js/js/jquery.waypoints.min.js')}}"></script>
  <script src="{{asset('js/js/jquery.stellar.min.js')}}"></script>
  <script src="{{asset('js/js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('js/js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{asset('js/js/aos.js')}}"></script>
  <script src="{{asset('js/js/jquery.animateNumber.min.js')}}"></script>
  <script src="{{asset('js/js/bootstrap-datepicker.js')}}"></script>
  <script src="{{asset('js/js/scrollax.min.js')}}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="{{asset('js/js/google-map.js')}}"></script>
  <script src="{{asset('js/js/main.js')}}"></script>
  <script src="{{asset('css/admin-css/T-admin_panel/vendor/datatables/jquery.dataTables.js')}}"></script>
  <script src="{{asset('css/admin-css/T-admin_panel/vendor/datatables/dataTables.bootstrap4.js')}}"></script>
    <script>
      	$(".btnrating").on('click',(function(e) {
	
        var previous_value = $("#selected_rating").val();
        
        var selected_value = $(this).attr("data-attr");
        $("#selected_rating").val(selected_value);
        
        $(".selected-rating").empty();
        $(".selected-rating").html(selected_value);
        
        for (i = 1; i <= selected_value; ++i) {
        $("#rating-star-"+i).toggleClass('btn-warning');
        $("#rating-star-"+i).toggleClass('btn-default');
        }
        
        for (ix = 1; ix <= previous_value; ++ix) {
        $("#rating-star-"+ix).toggleClass('btn-warning');
        $("#rating-star-"+ix).toggleClass('btn-default');
        }
        
        }));
        function up(max) {
            document.getElementById("myNumber").value = parseInt(document.getElementById("myNumber").value) + 1;
            if (document.getElementById("myNumber").value >= parseInt(max)) {
                document.getElementById("myNumber").value = max;
            }
        }
        function down(min) {
            document.getElementById("myNumber").value = parseInt(document.getElementById("myNumber").value) - 1;
            if (document.getElementById("myNumber").value <= parseInt(min)) {
                document.getElementById("myNumber").value = min;
            }
        }

    </script>
    @yield('script')




    <!-------------------Upload image------------->

<!-------------------------------->
  </body>
</html>
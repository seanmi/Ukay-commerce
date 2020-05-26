
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Item Management</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('css/admin-css/T-admin_panel/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="{{asset('css/admin-css/T-admin_panel/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">

  <link href="{{asset('css/admin-css/T-admin_panel/vendor/datatables/rowReorder.dataTables.min.css')}}" rel="stylesheet">

  <link href="{{asset('css/admin-css/T-admin_panel/vendor/datatables/responsive.dataTables.min.css')}}" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('css/admin-css/T-admin_panel/css/sb-admin.css')}}" rel="stylesheet">

  <link rel="stylesheet" href="{{asset('css/admin-css/T-admin_panel/js/toastr.min.css')}}">
  <style>
      .dot {
        height: 25px;
        width: 25px;
        background-color: red;
        border-radius: 50%;
        display: inline-block;
      }
      </style>
</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.html">My Account</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">

        <li class="nav-item dropdown no-arrow">
          <a class="btn btn-primary mr-4" href="{{route('landing')}}">Products</a>
        </li>
     
    
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item text-center" data-toggle="modal" data-target="#profile" href="#">Settings</a>
          <div class="dropdown-divider"></div>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="text-center">
                        {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Logout</button>
          </form>  
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="{{route('myAccount')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>

      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('myAccount')}}">
            <i class="fab fa-product-hunt"></i>
          <span>Items</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{route('orders')}}">
            <i class="fas fa-gifts"></i>
          <span>Ordered </span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{route('getAllOrderedItems')}}"> 
            <i class="fas fa-gifts" style="color: {{Auth::user()->checkNotif() == 1 ? 'red' : ''}}" ></i>
          <span >Orders </span>
        </a>
      </li>

      
    </ul>

    @yield('content')
    @include('user.modal.updateProfile')
  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

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
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="./functions/logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('css/admin-css/T-admin_panel/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('css/admin-css/T-admin_panel/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('css/admin-css/T-admin_panel/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Page level plugin JavaScript-->
  <script src="{{asset('css/admin-css/T-admin_panel/vendor/datatables/jquery.dataTables.js')}}"></script>
  <script src="{{asset('css/admin-css/T-admin_panel/vendor/datatables/dataTables.bootstrap4.js')}}"></script>

  <script src="{{asset('css/admin-css/T-admin_panel/vendor/datatables/dataTables.rowReorder.min.js')}}"></script>
  <script src="{{asset('css/admin-css/T-admin_panel/vendor/datatables/dataTables.responsive.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('css/admin-css/T-admin_panel/js/sb-admin.min.js')}}"></script>
  <script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>

  <script src="{{asset('css/admin-css/T-admin_panel/js/toastr.min.js')}}"></script>
  <script>
          @if(Session::has('success'))
          toastr.success('{{Session::get('success')}}')
          @endif
          @if(Session::has('fail'))
                toastr.error('{{Session::get('fail')}}')
          @endif
  </script>

  <script>

      CKEDITOR.replace( 'details-ckeditor' );
      
  </script>
  @yield('script')

</body>

</html>

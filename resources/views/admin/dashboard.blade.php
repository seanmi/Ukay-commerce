@extends('admin.layouts.app')

@section('content')

<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>

      </ol>
      <div class="row">
          <div class="col-xl-4 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="mr-5">{{$order_count}} pending orders!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="{{route('orderIndex')}}">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
    
          <div class="col-xl-4 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5">{{$product_count}} total items!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="{{route("adminGetAllActiveProducts")}}">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
    
          <div class="col-xl-4 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-ban"></i>
                </div>
                <div class="mr-5">{{$report_count}} Active Reports!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="{{route('reportIndex')}}">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
      </div>


      <!-- Area Chart Example-->
      <!---<div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-chart-area"></i>
          Area Chart Example</div>
        <div class="card-body">
          <canvas id="myAreaChart" width="100%" height="30"></canvas>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>----->

      <!-- DataTables Example -->
      
      {{-- <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-table"></i>
          For Approval</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Request from</th> 
                    <th>Action</th>
                  </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Category</th>
                  <th>Request from</th> 
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                      <tr>

                          <td>Damit</td>                          
                          <td>20.00</td>
                          <td>Short</td>
                          <td>Sean</td>
                          <td>
                          <div class="btn-group">
                          <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#details">Details</button>
                          <a href="./functions/approve.php?product=" class="btn btn-primary btn-sm">Approve</a>
                          <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#disapprove">Disapprove</button>
                          </div>
                          </td>

                          <!-- Modal Details-->
                          <div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLongTitle">Product:</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="offset-md-1 col-md-5 ">
                                      <img src="https://static.independent.co.uk/s3fs-public/thumbnails/image/2019/04/10/16/online-clothes-shops-hero.jpg?w968" alt="..." class="img-thumbnail" style="width:240px;600px">
                                    </div>
                                    <div class="col-md-6">
                                      <h3 class="text-center">Details</h3>
                                      <hr>
                                      <p>Brand name: Nike</p>
                                      <p>Product Code: 001</p>
                                      <p>Category: Shirt</p>
                                      <p>Price: 20.00</p>
                                      <p>Size Number: Small</p>
                                      <p>Size: 32</p>
                                      <p>Color: Blue</p>
                                      <p>Request from: Sean</p>
                                      <p>Category: Pants</p>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                         <!-- Ending Modal Disapprove-->
                        <!-- Modal Details-->
                          <div class="modal fade" id="disapprove" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLongTitle">Product:</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form action="./functions/disapprove.php?product" method="POST">
                                  <div class="modal-body">         
                                      <div class="form-group">
                                        <label for="usr">Reason:</label>
                                        <textarea name="reason" class="form-control" id="" cols="30" rows="10" placeholder="Reason for disapproving the product"></textarea>
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger" name="disapprove">Disapprove</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                         <!-- Ending Modal Disapprove-->

                      </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div> --}}

    </div>
    <!-- /.container-fluid -->

    <!-- Sticky Footer -->


  </div>
  <!-- /.content-wrapper -->

@endsection
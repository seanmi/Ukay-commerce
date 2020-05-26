@extends('admin.layouts.app')

@section('content')

<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
          <li class="breadcrumb-item active">Items</li>
          <li class="breadcrumb-item active">Archives</li>
      </ol>
 
        @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
      @endif
      <div class="card mb-3">
          {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Post Item</button> --}}
        <div class="card-header">
          <i class="fas fa-table"></i>
          Pending Items</div>
          
        <div class="card-body">
          <table id="example" class="display nowrap table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Name</th>
                    <th  class="text-center">Email</th>
                    <th  class="text-center">Gender</th>
                    <th  class="text-center">Category</th>
                    <th  class="text-center">Size</th>
                    <th  class="text-center">Color</th>
                    <th  class="text-center">Details</th>
                    <th  class="text-center">Status</th>
                    <th  class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
              <tr>
                  <td class="align-middle">{{$product->name}}</td>
                  <td class="align-middle">{{$product->quantity}}</td>
                  <td class="align-middle">{{$product->price}}</td>
                  <td class="align-middle">Jacket</td>
                  <td class="align-middle">{{$product->size}}</td>
                  <td class="align-middle">{{$product->color}}</td>
                  <td class="align-middle">{!!$product->details!!}</td>
                  <td class="align-middle text-center"><button class="btn btn-danger" disabled>Pending</button></td>
                  <td class="text-center align-middle ">
                    <div class="btn-group ">
                    <button class="btn btn-success" data-toggle="modal" data-target="#imageModal{{$product->id}}" data-toggle="tooltip" data-placement="top" title="View images"><i class="fas fa-images"></i></button>
                      <button class="btn btn-primary " data-toggle="tooltip" data-placement="top" title="Item Received"><i class="far fa-check-circle"></i></button>
                      <button class="btn btn-danger " data-toggle="tooltip" data-placement="top" title="Archive item"><i class="fas fa-archive"></i></button>
                    </div>
                  </td>
              </tr>            
              
                <!-- Modal Image -->
                <div class="modal fade" id="imageModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Item Images</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row justify-content-center" width="100%">
                            @foreach (explode(',',$product->image) as $item)
                              @if ($item !== "")
                                <div class="col-md-8 mt-2">
                                    <img class="img-fluid img-thumbnail" src="{{asset('uploads/'.$item)}}" alt="">
                                </div>                                
                              @endif                          
                            @endforeach

                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                      </div>
                    </div>
                  </div>
                </div>      
              @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th  class="text-center">Item Name</th>
                    <th  class="text-center">Quantity</th>
                    <th  class="text-center">Price</th>
                    <th  class="text-center">Category</th>
                    <th  class="text-center">Size</th>
                    <th  class="text-center">Color</th>
                    <th  class="text-center">Details</th>
                    <th  class="text-center">Status</th>
                    <th  class="text-center">Action</th>
                </tr>
            </tfoot>
        </table>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>

    </div>
  </div>
  <!-- /.content-wrapper -->

@endsection
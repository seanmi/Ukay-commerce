@extends('admin.layouts.app')

@section('content')

<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">Items</li>
        <li class="breadcrumb-item active">Active Items</li>
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
          Active Items</div>
          
        <div class="card-body">
          <table id="example" class="display nowrap table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th >Code</th>
                    <th >Item Name</th>
                    <th >Category</th>
                    <th >Seller</th>
                    <th  >Date Created</th>
                    <th  class="text-center">Status</th>
                    <th  class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
              <tr>
                  <td class="align-middle">{{$product->code}}</td>
                  <td class="align-middle">{{$product->name}}</td>
                  <td class="align-middle">Jacket</td>
                  <td class="align-middle">{{$product->user->name}}</td>
                  <td class="align-middle">{{$product->created_at->toDayDateTimeString()}}</td>
              <td class="align-middle text-center"> 
                @if ($product->status->name == "created")
                  <button class="btn btn-success" disabled>Pending</button>
                @elseif($product->status->name == "active")
                  <button class="btn btn-primary" disabled>Posted</button>
                @else
                  <button class="btn btn-danger" disabled>Archived</button>
                @endif
              </td>
                  <td class="text-center align-middle ">
                    <div class="btn-group ">
                    <button class="btn btn-success" data-toggle="modal" data-target="#imageModal{{$product->id}}" data-toggle="tooltip" data-placement="top" title="View Details"><i class="fas fa-images"></i></button>
                      <button class="btn btn-primary "  data-toggle="modal" data-target="#addDiscount{{$product->id}}" data-toggle="tooltip" data-placement="top" title="Add Discount"><i class="fas fa-tags" ></i></button>
                      <a href="{{route('archiveOne', ['id' =>$product->id])}}" class="btn btn-danger " data-toggle="tooltip" data-placement="top" title="Archive item" ><i class="fas fa-archive"  ></i></a>
                    </div>
                  </td>
              </tr>

               <!--View Item modal -->
               @include('shared.viewProduct')

              <!--Add Discount modal -->
              <div class="modal fade" id="addDiscount{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Discount</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <form action="{{route('productAddDiscount', ['id' => $product->id])}}" method="POST" >
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Discount</label>
                              <select name="discount" class="form-control input-sm">
                                  <option value="" selected disabled></option>
                                @foreach ($discounts as $discount)
                                  <option value="{{$discount->id}}" {{$product->discount_id == $discount->id ? 'selected': ''}}>{{$discount->name}}</option>
                                @endforeach
                              </select>
                            </div>     
                            @if ($product->discount_id !== NULL)
                            <a href="{{route('productRemoveDiscount', ['id'=> $product->id])}}" class="btn btn-danger" >Remove Discount</a>    
                            @endif
                            
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                    </div>
                  </div>
                </div>
              
              @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th >Code</th>
                    <th >Item Name</th>
                    <th >Category</th>
                    <th  >Date Created</th>
                    <th >Seller</th>
                    <th  class="text-center">Status</th>
                    <th  class="text-center">Action</th>
                </tr>
            </tfoot>
        </table>
        </div>
      </div>

    </div>
  </div>
  <!-- /.content-wrapper -->

@endsection
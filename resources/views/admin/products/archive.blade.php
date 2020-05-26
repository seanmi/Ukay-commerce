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
          Archives</div>
          
        <div class="card-body">
          <table id="example" class="display nowrap table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Item Name</th>
                    <th  class="text-center">Quantity</th>
                    <th  class="text-center">Price</th>
                    <th  class="text-center">Category</th>
                    <th  class="text-center">Size</th>
                    <th  class="text-center">Color</th>
                    <th  class="text-center">Details</th>
                    <th  class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
              <tr>
                  <td class="align-middle text-center">{{$product->name}}</td>
                  <td class="align-middle text-center">{{$product->quantity}}</td>
                  <td class="align-middle text-center">{{$product->price}}</td>
                  <td class="align-middle text-center">Jacket</td>
                  <td class="align-middle text-center">{{$product->size}}</td>
                  <td class="align-middle text-center">{{$product->color}}</td>
                  <td class="align-middle text-center">{!!$product->details!!}</td>
                  <td class="text-center align-middle ">
                    <div class="btn-group ">
                    <button class="btn btn-success" data-toggle="modal" data-target="#imageModal{{$product->id}}" data-toggle="tooltip" data-placement="top" title="View images"><i class="fas fa-images"></i></button>
                    </div>
                  </td>
              </tr>            
              
              @include('shared.viewProduct')
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
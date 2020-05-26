@extends('admin.layouts.app')

@section('content')

<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
          <li class="breadcrumb-item active">Dashboard</li>
          <li class="breadcrumb-item active">Orders</li>
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
                    <th >Ordered by</th>
                    <th >Ref#</th>
                    <th >Total</th>
                    <th >Date Ordered</th>
                    <th  class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($orders as $order)
              <tr>
                  <td class="align-middle">{{$order->user->name}}</td>
                  <td class="align-middle">{{$order->code}}</td>
                  <td class="align-middle">₱{{number_format(round($order->total + $order->shipping_fee,1),2)}}</td>
                  <td class="align-middle">{{$order->created_at}}</td>
                  <td class="text-center align-middle ">
                    <div class="btn-group ">
                        <button  class="btn btn-success"  data-toggle="modal" data-target="#order{{$order->id}}" data-toggle="tooltip" data-placement="top" title="View images"><i class="fas fa-images"></i></button>
                      <a href="{{route('delivered', ['id' => $order->id])}}" class="btn btn-primary " data-toggle="tooltip" data-placement="top" title="Delivered"><i class="fas fa-truck"></i></a>
                      <a href="{{route('cancelOrder', ['id' =>$order->id])}}" class="btn btn-danger " data-toggle="tooltip" data-placement="top" title="Cancel Order"><i class="fas fa-ban"></i></a>
                    </div>
                  </td>
              </tr>            
              {{-- @include('admin.modals.viewUser') --}}
               @include('admin.modals.itemsSummary')
              @endforeach
            </tbody>
            <tfoot>
                <tr>
                  <th >Ordered by</th>
                  <th >Ref#</th>
                  <th >Total</th>
                  <th >Date Ordered</th>
                  <th  class="text-center">Action</th>
                </tr>
            </tfoot>
        </table>
        </div>
      </div>

      <div class="card mb-3">
          {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Post Item</button> --}}
        <div class="card-header">
          <i class="fas fa-table"></i>
          Delivered </div>
          
        <div class="card-body">
          <table id="example1" class="display nowrap table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th >Ordered by</th>
                    <th >Ref#</th>
                    <th >Total</th>
                    <th >Date Ordered</th>
                    <th  class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($ordered as $order)
              <tr>
                  <td class="align-middle">{{$order->user->name}}</td>
                  <td class="align-middle">{{$order->code}}</td>
                  <td class="align-middle">₱{{number_format(round($order->total + $order->shipping_fee,1),2)}}</td>
                  <td class="align-middle">{{$order->created_at}}</td>
                  <td class="text-center align-middle ">
                    <div class="btn-group ">
                        <button  class="btn btn-success"  data-toggle="modal" data-target="#order{{$order->id}}" data-toggle="tooltip" data-placement="top" title="View images"><i class="fas fa-images"></i></button>
                    </div>
                  </td>
              </tr>            
              {{-- @include('admin.modals.viewUser') --}}
              @include('admin.modals.itemsSummary')
              @endforeach
            </tbody>
            <tfoot>
                <tr>
                  <th >Ordered by</th>
                  <th >Ref#</th>
                  <th >Total</th>
                  <th >Date Ordered</th>
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
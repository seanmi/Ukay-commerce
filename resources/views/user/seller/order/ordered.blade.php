@extends('user.seller.layouts.app')

@section('content')

<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Item Management</a>
        </li>
        <li class="breadcrumb-item active"> Orders </li>
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
        <div class="card-header">
          <i class="fas fa-table"></i>
          For Delivery Items</div>
          
        <div class="card-body">
          <table id="example" class="display nowrap table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Order#</th>
                    <th>Item</th>
                    <th>Quanity</th>
                    <th>Total Payment</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($orders as $order)
               @foreach ($order->orderItems as $item)
                   @if ($item->product->seller_id == Auth::user()->id)
                       <tr>
                        <td class="align-middle">{{$item->product->code}}</td>
                        <td class="align-middle">{{$order->code}}</td>
                        <td class="align-middle">{{$item->product->name}}</td>
                        <td class="align-middle">{{$item->total_quantity}}</td>
                        <td class="align-middle">
                            ₱{{number_format(round($item->takehome,1),2)}}
                        </td>
                       </tr>
                   @endif
               @endforeach
               
              {{-- <tr>
                  <td class="align-middle">{{$order->code}}</td>
                  <td class="align-middle">{{$order->status}}</td>
                  <td class="align-middle">{{$order->total}}</td>
                  <td class="align-middle">{{$order->created_at}}</td>
                  <td class="text-center align-middle ">
                    <button  class="btn btn-success" data-toggle="modal" data-target="#order{{$order->id}}" data-toggle="tooltip" data-placement="top" title="View images"><i class="fas fa-images"></i></button>
                  </td>
              </tr>             --}}
               @include('user.modal.itemsSummary')
              
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>Code</th>
                <th>Order#</th>
                <th>Item</th>
                <th>Quanity</th>
                <th>Total Payment</th>
            </tr>
            </tfoot>
        </table>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>

      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-table"></i>
          Delivered items</div>
          
        <div class="card-body">
          <table id="example1" class="display nowrap table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Order#</th>
                    <th>Item</th>
                    <th>Quanity</th>
                    <th>Total Payment</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($ordered as $order)
               @foreach ($order->orderItems as $item)
                   @if ($item->product->seller_id == Auth::user()->id)
                       <tr>
                        <td class="align-middle">{{$item->product->code}}</td>
                        <td class="align-middle">{{$order->code}}</td>
                        <td class="align-middle">{{$item->product->name}}</td>
                        <td class="align-middle">{{$item->total_quantity}}</td>
                        <td class="align-middle">
                            ₱{{number_format(round($item->takehome,1),2)}}
                        </td>
                       </tr>
                   @endif
               @endforeach
               
              {{-- <tr>
                  <td class="align-middle">{{$order->code}}</td>
                  <td class="align-middle">{{$order->status}}</td>
                  <td class="align-middle">{{$order->total}}</td>
                  <td class="align-middle">{{$order->created_at}}</td>
                  <td class="text-center align-middle ">
                    <button  class="btn btn-success" data-toggle="modal" data-target="#order{{$order->id}}" data-toggle="tooltip" data-placement="top" title="View images"><i class="fas fa-images"></i></button>
                  </td>
              </tr>             --}}
               @include('user.modal.itemsSummary')
              
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>Code</th>
                <th>Order#</th>
                <th>Item</th>
                <th>Quanity</th>
                <th>Total Payment</th>
            </tr>
            </tfoot>
        </table>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>


     

    </div>
    <!-- /.container-fluid -->

    <!-- Sticky Footer -->


  </div>
  <!-- /.content-wrapper -->



@endsection

@section('script')
  <script>
        $(document).ready(function() {
          var table = $('#example').DataTable( {
              rowReorder: {
                  selector: 'td:nth-child(3)'
              },
              responsive: true
          } );
          var table = $('#example1').DataTable( {
              rowReorder: {
                  selector: 'td:nth-child(3)'
              },
              responsive: true
          } );
        })
  </script>
@endsection
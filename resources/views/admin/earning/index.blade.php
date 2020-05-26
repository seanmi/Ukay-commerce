@extends('admin.layouts.app')

@section('content')

<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
          <li class="breadcrumb-item active">Dashboard</li> 
          <li class="breadcrumb-item active">Earnings</li>
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
          Earnings
          <span class="float-right">
              <i class="fas fa-money-bill-wave"></i>
            Earnings: ₱{{number_format($total,2)}}</div>
            </span>
        </div>

          
        <div class="card-body">
          <table id="example" class="display nowrap table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th >Order Code</th>
                    <th class="text-center">Earnings</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                      <td>{{$order->code}}</td>
                      <td class="text-center">₱{{number_format(round($order->orderItems->sum('total_price')+$order->shipping_fee,1) - round($order->orderItems->sum('takehome'),1),2)}}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
              <tr>
                  <th >Order Code</th>
                  <th class="text-center" >Earnings</th>
              </tr>
              
            </tfoot>
        </table>
        </div>
      </div>

    </div>

  </div>
  <!-- /.content-wrapper -->

@endsection
@extends('admin.layouts.app')

@section('content')

<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
          <li class="breadcrumb-item active">Dashboard</li>
          <li class="breadcrumb-item active">Barangays</li>
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
        <button class="btn btn-primary" data-toggle="modal" data-target="#addDiscount">Add Barangay</button>
          {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Post Item</button> --}}
        <div class="card-header">
          <i class="fas fa-table"></i>
          Barangays</div>
          
        <div class="card-body">
          <table id="example" class="display nowrap table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th >Barangay</th>
                    <th >Standard Shipping Fee</th>
                    <th  class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($barangays as $barangay)
              <tr>
                  <td class="align-middle">{{$barangay->name}}</td>
                  <td class="align-middle">{{$barangay->shipping_fee}}</td>
                  <td class="text-center align-middle ">
                    <div class="btn-group ">
                    <button class="btn btn-primary " data-toggle="modal" data-target="#editbarangay{{$barangay->id}}" data-toggle="tooltip" data-placement="top" title="Edit barangay"><i class="fas fa-edit"></i></button>
                      @if ($barangay->user->count() !== 0)
                      <button class="btn btn-danger " data-toggle="tooltip" data-placement="top" title="Delete barangay" disabled><i class="fas fa-trash"></i></button>
                      @else
                      <a  href="{{route('deleteBarangay', ['id' => $barangay->id])}}" class="btn btn-danger " data-toggle="tooltip" data-placement="top" title="Ban user"><i class="fas fa-trash"></i></a>
                      @endif
                     
                    </div>
                  </td>
              </tr>        
              @include('admin.modals.editBarangay')    
              {{-- @include('admin.modals.viewUser') --}}
               
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                  <th >Barangay</th>
                  <th >Standard Shipping Fee</th>
                  <th  class="text-center">Action</th>
              </tr>
            </tfoot>
        </table>
        </div>
      </div>

    </div>
    @include('admin.modals.addBarangay')
  </div>
  <!-- /.content-wrapper -->

@endsection
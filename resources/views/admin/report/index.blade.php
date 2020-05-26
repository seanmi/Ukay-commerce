@extends('admin.layouts.app')

@section('content')

<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
          <li class="breadcrumb-item active">Dashboard</li>
          <li class="breadcrumb-item active">Reports</li>
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
          Active Reports</div>
          
        <div class="card-body">
          <table id="example" class="display nowrap table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th >From</th>
                    <th >Item</th>
                    <th >Posted by</th>
                    <th  class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($active as $a)
              <tr>
                  <td class="align-middle">{{$a->user->name}}</td>
                  <td class="align-middle">{{$a->product->name}}</td>
                  <td class="align-middle">{{$a->product->user->name}}</td>
                  <td class="text-center align-middle ">
                    <div class="btn-group ">
                        <a href="{{route('deactivate', ['id' => $a->id])}}" class="btn btn-danger " data-toggle="tooltip" data-placement="top" title="deactivate" ><i class="fas fa-ban"></i></a>
                    </div>
                  </td>
              </tr>            
              {{-- @include('admin.modals.viewUser') --}}
               
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                  <th >From</th>
                  <th >Item</th>
                  <th >Posted by</th>
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
          Active Reports</div>
          
        <div class="card-body">
          <table id="example1" class="display nowrap table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th >From</th>
                    <th >Item</th>
                    <th >Posted by</th>
                    <th  class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($inactive as $a)
              <tr>
                  <td class="align-middle">{{$a->user->name}}</td>
                  <td class="align-middle">{{$a->product->name}}</td>
                  <td class="align-middle">{{$a->product->user->name}}</td>
                  <td class="text-center align-middle ">
                    <div class="btn-group ">
                        <button class="btn btn-danger " data-toggle="tooltip" data-placement="top" title="deactivate" disabled><i class="fas fa-ban"></i></button>
                    </div>
                  </td>
              </tr>            
              {{-- @include('admin.modals.viewUser') --}}
               
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                  <th >From</th>
                  <th >Item</th>
                  <th >Posted by</th>
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
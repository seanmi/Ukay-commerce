@extends('admin.layouts.app')

@section('content')

<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
          <li class="breadcrumb-item active">Dashboard</li>
          <li class="breadcrumb-item active">Users</li>
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
          <button class="btn btn-primary" data-toggle="modal" data-target="#createAdmin">Create Admin User</button>
          {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Post Item</button> --}}
        <div class="card-header">
          <i class="fas fa-table"></i>
          Admin Users</div>
          
        <div class="card-body">
          <table id="example" class="display nowrap table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th >Name</th>
                    <th >Email</th>
                    <th >Gender</th>
                    <th >Date Registered</th>
                    <th  class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($admin as $user)
              <tr>
                  <td class="align-middle">{{$user->name}}</td>
                  <td class="align-middle">{{$user->email}}</td>
                  <td class="align-middle">{{$user->gender}}</td>
                  <td class="align-middle">{{$user->created_at}}</td>
                  <td class="text-center align-middle ">
                    <div class="btn-group ">
                    {{-- <button class="btn btn-success" data-toggle="modal" data-target="#imageModal{{$user->id}}" data-toggle="tooltip" data-placement="top" title="Details"><i class="fas fa-info"></i></button>
                      <a href="{{route('banUser',['id' => $user->id])}}" class="btn btn-danger " data-toggle="tooltip" data-placement="top" title="Ban user"><i class="fas fa-ban"></i></a> --}}
                    </div>
                  </td>
              </tr>            
              @include('admin.modals.viewUser')
               
              @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th >Name</th>
                    <th >Email</th>
                    <th >Gender</th>
                    <th >Date Registered</th>
                    <th  class="text-center">Action</th>
                </tr>
            </tfoot>
        </table>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>

      <div class="card mb-3">
          {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Post Item</button> --}}
        <div class="card-header">
          <i class="fas fa-table"></i>
          Active Users</div>
          
        <div class="card-body">
          <table id="example" class="display nowrap table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th >Name</th>
                    <th >Email</th>
                    <th >Gender</th>
                    <th >Date Registered</th>
                    <th  class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
              <tr>
                  <td class="align-middle">{{$user->name}}</td>
                  <td class="align-middle">{{$user->email}}</td>
                  <td class="align-middle">{{$user->gender}}</td>
                  <td class="align-middle">{{$user->created_at}}</td>
                  <td class="text-center align-middle ">
                    <div class="btn-group ">
                    <button class="btn btn-success" data-toggle="modal" data-target="#imageModal{{$user->id}}" data-toggle="tooltip" data-placement="top" title="Details"><i class="fas fa-info"></i></button>
                      <a href="{{route('banUser',['id' => $user->id])}}" class="btn btn-danger " data-toggle="tooltip" data-placement="top" title="Ban user"><i class="fas fa-ban"></i></a>
                    </div>
                  </td>
              </tr>            
              @include('admin.modals.viewUser')
               
              @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th >Name</th>
                    <th >Email</th>
                    <th >Gender</th>
                    <th >Date Registered</th>
                    <th  class="text-center">Action</th>
                </tr>
            </tfoot>
        </table>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>

      <div class="card mb-3">
          {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Post Item</button> --}}
        <div class="card-header">
          <i class="fas fa-table"></i>
          Banned Users</div>
          
        <div class="card-body">
          <table id="example2" class="display nowrap table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th >Name</th>
                    <th >Email</th>
                    <th >Gender</th>
                    <th >Date Registered</th>
                    <th  class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($banned as $user)
              <tr>
                  <td class="align-middle">{{$user->name}}</td>
                  <td class="align-middle">{{$user->email}}</td>
                  <td class="align-middle">{{$user->gender}}</td>
                  <td class="align-middle">{{$user->created_at}}</td>
                  <td class="text-center align-middle ">
                    <div class="btn-group ">
                    <button class="btn btn-success" data-toggle="modal" data-target="#imageModal{{$user->id}}" data-toggle="tooltip" data-placement="top" title="Details"><i class="fas fa-info"></i></button>
                    </div>
                  </td>
              </tr>            
              @include('admin.modals.viewUser')
               
              @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th >Name</th>
                    <th >Email</th>
                    <th >Gender</th>
                    <th >Date Registered</th>
                    <th  class="text-center">Action</th>
                </tr>
            </tfoot>
        </table>
        </div>
      </div>

@include('admin.modals.addAdmin')
    </div>
  </div>
  <!-- /.content-wrapper -->

@endsection


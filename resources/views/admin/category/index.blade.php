@extends('admin.layouts.app')

@section('content')

<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
          <li class="breadcrumb-item active">Dashboard</li>
          <li class="breadcrumb-item active">Categories</li>
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
        <button class="btn btn-primary" data-toggle="modal" data-target="#addDiscount">Add Category</button>
          {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Post Item</button> --}}
        <div class="card-header">
          <i class="fas fa-table"></i>
          Category</div>
          
        <div class="card-body">
          <table id="example" class="display nowrap table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th >Name</th>
                    <th  class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($categories as $category)
              <tr>
                  <td class="align-middle">{{$category->name}}</td>
                  <td class="text-center align-middle ">
                    <div class="btn-group ">
                      <button class="btn btn-primary "  data-toggle="modal" data-target="#editCategory{{$category->id}}" data-toggle="tooltip" data-placement="top" title="Edit category"><i class="fas fa-edit"></i></button>
                      @if ($category->product->count() !==0)
                      <button href="{{route('deleteCategory', ['id' => $category->id])}}" class="btn btn-danger " data-toggle="tooltip" data-placement="top" title="Delete category" disabled><i class="fas fa-trash"></i></button>
                      @else
                        <a href="{{route('deleteCategory', ['id' => $category->id])}}" class="btn btn-danger " data-toggle="tooltip" data-placement="top" title="Delete category" ><i class="fas fa-trash"></i></a>
                      @endif
                     
                    </div>
                  </td>
              </tr>            
              {{-- @include('admin.modals.viewUser') --}}
              @include('admin.modals.editCategory')
               
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                  <th >Name</th>
                  <th  class="text-center">Action</th>
              </tr>
            </tfoot>
        </table>
        </div>
      </div>

    </div>
    @include('admin.modals.addCategory')
  </div>
  <!-- /.content-wrapper -->

@endsection
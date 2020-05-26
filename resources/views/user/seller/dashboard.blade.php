@extends('user.seller.layouts.app')

@section('content')

<div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Item Management</a>
        </li>
        <li class="breadcrumb-item active"> Posted</li>
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
          <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Item</button>
        <div class="card-header">
          <i class="fas fa-table"></i>
          Items Posted</div>
          
        <div class="card-body">
          <table id="example" class="display nowrap table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Details</th>
                    <th>Status</th>
                    <th>Action</th>
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
                  <td class="align-middle">
                    @if ($product->status->name == 'created')
                      <form action="{{route('updateStatusProduct')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <button type="submit" class="btn btn-primary" >Post</button>
                      </form>
                    @elseif($product->status->name == 'active')
                        <button class="btn btn-primary" disabled>Posted</button>
                    @else
                    <button class="btn btn-danger" disabled>Archived</button>
                    @endif
                  </td>
                  <td class="text-center align-middle ">
                    <div class="btn-group ">
                      @if ($product->status->name == 'created')
                        <button class="btn btn-success" data-toggle="modal" data-target="#imageModal{{$product->id}}" data-toggle="tooltip" data-placement="top" title="View images"><i class="fas fa-images"></i></button>
                        <button class="btn btn-primary edit-btn" data-id="{{$product->id}}"  data-toggle="modal" data-target="#item{{$product->id}}" data-toggle="tooltip" data-placement="top" title="Edit item"><i class="fas fa-edit" ></i></button>
                        <a href="{{route('removeProduct', ['id' => $product->id])}}" class="btn btn-danger "  title="Delete item"><i class="fas fa-trash"></i></a>                        
                      @else
                        <button  class="btn btn-success" data-toggle="modal" data-target="#imageModal{{$product->id}}" data-toggle="tooltip" data-placement="top" title="View images"><i class="fas fa-images"></i></button>
                      <button disabled class="btn btn-primary "  data-toggle="tooltip" data-placement="top" title="Edit item"><i class="fas fa-edit" ></i></button>
                        <button disabled class="btn btn-danger " data-toggle="tooltip" data-placement="top" title="Delete item"><i class="fas fa-trash"></i></button>                    
                      @endif

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
                        <h3 class="d-block text-center">Cover Image</h3>
                        <div class="row justify-content-center" width="100%">
                            <div class="col-md-8 mt-2">
                                <img class="img-fluid img-thumbnail" src="{{asset('uploads/'.$product->profile)}}" alt="">
                            </div>                                
                        </div><br>
                        <h3 class="d-block text-center">Item Images</h3>
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
 
                @include('user.modal.editItem')  
              @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Details</th>
                    <th>Status</th>
                    <th>Action</th>
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

    <!--Add Item modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Post Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <form action="{{route('storeProduct')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Code</label>
                        <input type="email" class="form-control input-sm"   placeholder="automatic" disabled>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Item Name</label>
                        <input type="text" name="name" class="form-control input-sm"  >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Quantity</label>
                        <input type="number" name="quantity" class="form-control input-sm" min="1">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Price</label>
                        <input type="number" name="price" class="form-control input-sm" step="0.01">
                      </div>
                      <div class="form-group">
                          <label for="exampleInputEmail1">Category</label>
                          <select class="form-control" name="category">
                              @foreach ($categories as $category)
                              <option value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                            </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Size</label>
                        <input type="number" name="size" class="form-control input-sm" min="0">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Color</label>
                        <input type="text" name="color" class="form-control input-sm" >
                      </div>
                      <div class="form-group">
                        <label for="details">Details:</label>
                        <textarea id="details-ckeditor" class="form-control" name="details" rows="5" ></textarea>
                      </div>                  
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Upload Cover Image</label>
                        <input type="file" name="profile" class="form-control-file" id="uploadProfile1" required>
                    </div>
                    <div class="row" id="profileContainer1" >
                      <div class="col-sm-12">
                          <img src="" alt="" id="output" class="img-fluid ">
                          <small class="text-danger" id="showProfileErr1" style="display:none">Upload Image only!</small>
                          <small class="text-danger" id="showProfileSizeErr1" style="display:none">Image is too large! max size is 2mb</small>
                      </div>
                    </div>
                    <div class="form-group mt-2">
                      <label for="exampleFormControlFile1">Uplod 3 pictures of the product</label>
                      <input type="file" name="image[]" class="form-control-file" id="uploadFile1" multiple required>
                    </div>
                    <div class="row" id="imageContainer1">
                      <div class="col-sm-12">
                          <img src="" alt="" id="output" class="img-fluid ">
                          <small class="text-danger" id="showErr1" style="display:none">Upload 3 image only!</small>
                          <small class="text-danger" id="showMinErr1" style="display:none">Upload 3 Image! </small>
                          <small class="text-danger" id="showImageErr1" style="display:none">Upload Image only!</small>
                          <small class="text-danger" id="showSizeErr1" style="display:none">Image is too large! max size is 2mb</small>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
        </div>
      </div>
    </div>

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


      let fileElem = document.getElementsByClassName('uploadFile');
      console.log("Sean", fileElem);
      if(fileElem){
        Array.from(document.getElementsByClassName('uploadFile'), el => {
            el.addEventListener('change', ()=>{
              // let output = document.getElementById('output');
              // output.src = URL.createObjectURL(event.target.files[0]);
              // console.log(event.target.files.length);
              let data = el.getAttribute('data-id')
              let showErr = `showErr${data}`;
              let showImageErr = `showImageErr${data}`;
              let showMinErr = `showMinErr${data}`;
              let uploadFile = `uploadFile${data}`;
              let showImageSizeErr = `showImageSizeErr${data}`;

              document.getElementById(showErr).style.display = 'none';
              document.getElementById(showImageErr).style.display = "none";
              document.getElementById(showMinErr).style.display = "none";
              document.getElementById(showImageSizeErr).value = "none"; 

              if(event.target.files.length > 3){
                document.getElementById(showErr).style.display = '';
                document.getElementById(showImageErr).style.display = "none";
                document.getElementById(showMinErr).style.display = "none";
                document.getElementById(uploadFile).value = null; 
                document.getElementById(showImageSizeErr).value = "none"; 

              }else if(event.target.files.length < 3){
                document.getElementById(showMinErr).style.display = '';
                document.getElementById(showErr).style.display = "none";
                document.getElementById(showImageErr).style.display = "none";
                document.getElementById(showImageSizeErr).style.display = "none";
                document.getElementById(uploadFile).value = null; 

              }else{
                let data = el.getAttribute('data-id')
                let imageContainer = `imageContainer${data}`;
                let container = document.getElementById(imageContainer);
                for (let index = 0; index < event.target.files.length ; index++) {
                  if(event.target.files[index].size > 2097152){
                    document.getElementById(showImageSizeErr).style.display = "";
                    document.getElementById(uploadFile).value = null; 
                    break;
                  }else{
                    let type = event.target.files[index].type;
                    if(type== 'image/gif' || type=='image/ief' || type=='image/jpe' || type=="image/jpeg" || type=="image/png"){
                      let html = '';
                      let url =  URL.createObjectURL(event.target.files[index]);
                      html ='<div class="col-sm-12 mt-2 item-image"><img src="'+url+'" alt=""  class="img-fluid img-thumbnail"></div>';
                      container.insertAdjacentHTML('beforeend', html);
                      document.getElementById(showImageErr).style.display = "none"; 
                      document.getElementById(showErr).style.display = "none";
                      document.getElementById(showImageSizeErr).style.display = "none";   
                      document.getElementById(showMinErr).style.display = "none";
                    }else{
                      document.getElementById(showImageErr).style.display = ''; 
                      document.getElementById(showErr).style.display = "none";
                      document.getElementById(showMinErr).style.display = "none"; 
                      document.getElementById(showImageSizeErr).style.display = "none";      
                      document.getElementById(uploadFile).value = null;     
                      deleteImages();
                    }
                  }
                }
              }     
          });     
        })
      }

      
      function deleteImages(){
        if( document.querySelectorAll('.item-image')!==null){
          Array.from(document.querySelectorAll('.item-image'), el=>{
            el.innerHTML = '';
            el.remove();
        });
        }
      }

      function deleteProfile(){
        if( document.querySelectorAll('.profile-image')!==null){
          Array.from(document.querySelectorAll('.profile-image'), el=>{
            el.innerHTML = '';
            el.remove();
        });
        }
      }

      
      Array.from(document.getElementsByClassName('uploadProfile'), el=>{
        el.addEventListener('change', ()=>{
          deleteProfile();
          let data = el.getAttribute('data-id') 
          let showProfileErr = `showProfileErr${data}`;
          let showSizeErr = `showSizeErr${data}`;
          let up = `up${data}`;
          let container = document.getElementById(`profileContainer${data}`);

          document.getElementById(showSizeErr).style.display = "none"; 
          document.getElementById(showProfileErr).style.display = "none";

          if(event.target.files[0].size > 2097152){
            console.log(document.getElementById(up));
            
            document.getElementById(up).value = '';
            document.getElementById(showSizeErr).style.display = ""; 
            
          }else{
            let type = event.target.files[0].type;
            if(type== 'image/gif' || type=='image/ief' || type=='image/jpe' || type=="image/jpeg"){
              document.getElementById(showProfileErr).style.display = "none";
              document.getElementById(showSizeErr).style.display = "none";
              let html = '';
              let url =  URL.createObjectURL(event.target.files[0]);
              html ='<div class="col-sm-12 mt-2 profile-image"><img src="'+url+'" alt=""  class="img-fluid img-thumbnail"></div>';
              container.insertAdjacentHTML('beforeend', html);
            }else{
              document.getElementById(up).value =''; 
              document.getElementById(showProfileErr).style.display = "";
              
            }
          }       
        })
      })
        //   document.getElementById(uploadProfile).addEventListener('change',()=>{
        //   deleteProfile();
        //   let type = event.target.files[0].type;
        //   if(type== 'image/gif' || type=='image/ief' || type=='image/jpe' || type=="image/jpeg"){
        //     document.getElementById('showProfileErr').style.display = "none";
        //     let html = '';
        //     let url =  URL.createObjectURL(event.target.files[0]);
        //     html ='<div class="col-sm-12 mt-2 profile-image"><img src="'+url+'" alt=""  class="img-fluid img-thumbnail"></div>';
        //     container.insertAdjacentHTML('beforeend', html);
        //   }else{
        //     document.getElementById('showProfileErr').style.display = "";
        //   }
        // })


    } );  

    let btns = document.querySelectorAll('.edit-btn');

    Array.from(btns, elem =>{
      console.log(elem.getAttribute('data-id'));
      elem.addEventListener('click', ()=>{
        CKEDITOR.replace( `details-ckeditor${elem.getAttribute('data-id')}` );
      })
    })

    </script>

<script>


    let fileElem = document.getElementById('uploadFile1');
    fileElem.addEventListener('change', ()=>{
        // let output = document.getElementById('output');
        // output.src = URL.createObjectURL(event.target.files[0]);
        // console.log(event.target.files.length);
        if(event.target.files.length > 3){
          document.getElementById('showErr1').style.display = '';
          document.getElementById('showImageErr1').style.display = "none";
              document.getElementById('showMinErr1').style.display = "none";
          document.getElementById('uploadFile1').value = null; 
          deleteImages();
        }else if(event.target.files.length < 3){
          document.getElementById('showMinErr1').style.display = '';
          document.getElementById('showErr1').style.display = "none";
          document.getElementById('showImageErr1').style.display = "none";
          document.getElementById('uploadFile1').value = null; 
          deleteImages();
        }else{
          deleteImages();
          let container = document.getElementById('imageContainer1');
          document.getElementById('showSizeErr1').style.display = "none";
          
          for (let index = 0; index < event.target.files.length ; index++) {
            if(event.target.files[index].size > 2097152){
              document.getElementById('showSizeErr1').style.display = "";
              container.value = "";
              break;
            }else{
              let type = event.target.files[index].type;
              if(type== 'image/gif' || type=='image/ief' || type=='image/jpe' || type=="image/jpeg" || type=="image/png"){
                let html = '';
                let url =  URL.createObjectURL(event.target.files[index]);
                html ='<div class="col-sm-12 mt-2 item-image1"><img src="'+url+'" alt=""  class="img-fluid img-thumbnail"></div>';
                container.insertAdjacentHTML('beforeend', html);
                document.getElementById('showImageErr1').style.display = "none"; 
                document.getElementById('showErr1').style.display = "none";
                document.getElementById('showMinErr1').style.display = "none";
              }else{
                document.getElementById('showImageErr1').style.display = ''; 
                document.getElementById('showErr1').style.display = "none";
                document.getElementById('showMinErr1').style.display = "none";       
                document.getElementById('uploadFile1').value = null;     
                deleteImages();
              }             
            }
          }
        }     
    });
    
    function deleteImages(){
      if( document.querySelectorAll('.item-image1')!==null){
        Array.from(document.querySelectorAll('.item-image1'), el=>{
          el.innerHTML = '';
          el.remove();
      });
      }
    }

    function deleteProfile(){
      if( document.querySelectorAll('.profile-image1')!==null){
        Array.from(document.querySelectorAll('.profile-image1'), el=>{
          el.innerHTML = '';
          el.remove();
      });
      }
    }

    let container = document.getElementById('profileContainer1');
    
    document.getElementById('uploadProfile1').addEventListener('change',()=>{
      deleteProfile();
      console.log(event.target.files[0].size);
      document.getElementById('showProfileSizeErr1').style.display = "none";
      if(event.target.files[0].size > 2097152 ){       
        document.getElementById('showProfileSizeErr1').style.display = "";
        document.getElementById('uploadProfile1').value = "";
      }else{
        let type = event.target.files[0].type;
        if(type== 'image/gif' || type=='image/ief' || type=='image/jpe' || type=="image/jpeg"){
          document.getElementById('showProfileErr1').style.display = "none";

          let html = '';
          let url =  URL.createObjectURL(event.target.files[0]);
          html ='<div class="col-sm-12 mt-2 profile-image1"><img src="'+url+'" alt=""  class="img-fluid img-thumbnail"></div>';
          container.insertAdjacentHTML('beforeend', html);
        }else{
          document.getElementById('showProfileErr1').style.display = "";
        }
      }
  
    })


  

  </script>
@endsection
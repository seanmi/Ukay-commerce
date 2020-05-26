<div class="modal fade" id="imageModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="user{{$user->id}}">User: {{$user->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('storeProduct')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control input-sm"   placeholder="{{$user->email}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Date of Birth</label>
                        <input type="date" name="name" class="form-control input-sm"  value="{{$user->birth_date}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Gender</label>
                            <input type="number" name="quantity" class="form-control input-sm" min="1" placeholder="{{$user->gender}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Address</label>
                        <input type="text" class="form-control" placeholder="{{$user->house_number." ".$user->bar['name'].", "."Angeles City, Pampanga"}}" readonly>
                        </div>               
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="addProduct">Add</button>
                </div>
            </form>
            </div>
        </div>
        </div>
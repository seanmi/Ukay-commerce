  <!--Add Item modal -->
  <div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{Auth::user()->name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        
        <h3 class="mt-4 text-center">Personal Information</h3>
    <form action="{{route('updateContact')}}" method="POST" >
        {{ csrf_field() }}
        <div class="modal-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control input-sm" value="{{Auth::user()->name}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control input-sm" value="{{Auth::user()->email}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Birthday</label>
                <input type="date" class="form-control input-sm" value="{{Auth::user()->birth_date}}" readonly>
            </div>
            <div class="form-group">
                    <label for="exampleInputEmail1">Gender</label>
                    <select name="gender" id="" class="form-control" readonly>    
                        <option value="male" {{Auth::user()->gender == 'male' ? 'selected' : ''}}>Male</option>
                        <option value="female"  {{Auth::user()->gender == 'female' ? 'selected' : ''}}>Female</option>
                    </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Contact No</label>
                <input type="number" class="form-control input-sm" name="contact" value="{{Auth::user()->contact_no}}" >
            </div>
        </div>
        <input type="hidden" name="product_id" value="">
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>

    <h3 class="mt-4 text-center">Address Details</h3>

    <form action="{{route('updateAddress')}}" method="POST" >
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">House#/Lot#/Block</label>
                    <input type="text" class="form-control input-sm" name="house_number" value="{{Auth::user()->house_number}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Barangay</label>
                    <select name="barangay" id="" class="form-control">
                        @foreach (App\Barangay::all() as $item)
                            <option value="{{$item->id}}" {{$item->id == Auth::user()->barangay ? 'selected': ''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <input type="hidden" name="product_id" value="">
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>

        <h3 class="mt-4 text-center">Change Password</h3>

        <form action="{{route('updatePassword')}}" method="POST" >
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Current Password</label>
                        <input type="password" class="form-control input-sm" name="current_password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">New Password</label>
                        <input type="password" class="form-control input-sm" name="password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Confirm New Password</label>
                        <input type="password" class="form-control input-sm" name="password_confirmation">
                    </div>
                </div>
                <input type="hidden" name="product_id" value="">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

    </div>
    </div>
</div>
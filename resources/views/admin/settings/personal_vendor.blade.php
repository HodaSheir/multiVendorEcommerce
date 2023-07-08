<div class="row">
    <div class="col-md-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Update vendor Details</h4>
                @if (Session::has('error_message'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error : </strong> {{ Session()->get('error_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success : </strong> {{ Session()->get('success_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form class="forms-sample" action="{{ url('admin/update-vendor-details/personal') }}" method="post"
                    name="updateVendorDetailsForm" id="updateVendorDetailsForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Vendor Username / Email</label>
                        <input class="form-control" placeholder="Username" readonly
                            value={{ Auth::guard('admin')->user()->email }}>
                    </div>
                    <div class="form-group">
                        <label for="shop_name">Name</label>
                        <input type="text" class="form-control" placeholder="Enter Name" id="shop_name"
                            name="shop_name" required value="{{ Auth::guard('admin')->user()->name }}">
                    </div>
                    <div class="form-group">
                        <label for="shop_mobile">Mobile</label>
                        <input type="mobile" class="form-control" placeholder="Enter Mobile no." maxlength="10"
                            minlength="10" id="shop_mobile" name="shop_mobile" required
                            value="{{ $vendorDetails['mobile'] }}">
                    </div>
                    <div class="form-group">
                        <label for="shop_address">Address</label>
                        <input type="text" class="form-control" placeholder="Enter Address" id="shop_address"
                            name="shop_address" required value="{{ $vendorDetails['address'] }}">
                    </div>
                    <div class="form-group">
                        <label for="shop_city">City</label>
                        <input type="text" class="form-control" placeholder="Enter City" id="shop_city"
                            name="shop_city" required value="{{ $vendorDetails['city'] }}">
                    </div>
                    <div class="form-group">
                        <label for="shop_state">State</label>
                        <input type="text" class="form-control" placeholder="Enter State" id="shop_state"
                            name="shop_state" required value="{{ $vendorDetails['state'] }}">
                    </div>
                    <div class="form-group">
                        <label for="shop_country">Country</label>
                        <input type="text" class="form-control" placeholder="Enter Country" id="shop_country"
                            name="shop_country" required value="{{ $vendorDetails['country'] }}">
                    </div>
                    <div class="form-group">
                        <label for="shop_pincode">Pincode</label>
                        <input type="text" class="form-control" placeholder="Enter Pincode" id="shop_pincode"
                            name="shop_pincode" required value="{{ $vendorDetails['pincode'] }}">
                    </div>
                    <div class="form-group">
                        <label for="shop_image">Vendor Photo</label>
                        <input type="file" class="form-control" maxlength="10" minlength="10" id="shop_image"
                            name="shop_image">
                        @if (!empty(Auth::guard('admin')->user()->image))
                            <a href="{{ url('admin/images/photos/' . Auth::guard('admin')->user()->image) }}"
                                target="_blank"> View Image</a>
                            <input type="hidden" name="current_image"
                                value="{{ Auth::guard('admin')->user()->image }}">
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a class="btn btn-light" href={{ url('admin/dashboard') }}>Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

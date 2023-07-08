<div class="row">
    <div class="col-md-9 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Update vendor Business Details</h4>
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
          <form class="forms-sample" action="{{ url('admin/update-vendor-details/business') }}" method="post"
           name="updateVendorBusinessDetailsForm" id="updateVendorBusinessDetailsForm" enctype="multipart/form-data">
           @csrf
            <div class="form-group">
              <label >Vendor Username / Email</label>
              <input  class="form-control" placeholder="Username" readonly 
              value={{ Auth::guard('admin')->user()->email}}>
            </div>
            <div class="form-group">
              <label for="shop_name">Shop Name</label>
              <input type="text" class="form-control"  placeholder="Enter Name" 
              id="shop_name" name="shop_name"  value="{{ $vendorDetails['shop_name'] }}">
            </div>
            <div class="form-group">
              <label for="shop_mobile">Shop Mobile</label>
              <input type="mobile" class="form-control"  placeholder="Enter Mobile no." maxlength="10"
                minlength="10" id="shop_mobile" name="shop_mobile"  value="{{ $vendorDetails['shop_mobile'] }}">
            </div>
            <div class="form-group">
                <label for="shop_address">Shop Address</label>
                <input type="text" class="form-control"  placeholder="Enter Address" 
                id="shop_address" name="shop_address"  value="{{ $vendorDetails['shop_address'] }}">
            </div>
            <div class="form-group">
                <label for="shop_city">Shop City</label>
                <input type="text" class="form-control"  placeholder="Enter City" 
                id="shop_city" name="shop_city"  value="{{ $vendorDetails['shop_city'] }}">
              </div>
              <div class="form-group">
                <label for="shop_state">Shop State</label>
                <input type="text" class="form-control"  placeholder="Enter State" 
                id="shop_state" name="shop_state"  value="{{ $vendorDetails['shop_state'] }}">
              </div>
              <div class="form-group">
                <label for="shop_country">Shop Country</label>
                <input type="text" class="form-control"  placeholder="Enter Country" 
                id="shop_country" name="shop_country"  value="{{ $vendorDetails['shop_country'] }}">
              </div>
              <div class="form-group">
                <label for="shop_pincode">Shop Pincode</label>
                <input type="text" class="form-control"  placeholder="Enter Pincode" 
                id="shop_pincode" name="shop_pincode"  value="{{ $vendorDetails['shop_pincode'] }}">
              </div>
              <div class="form-group">
                <label for="shop_website">Shop website</label>
                <input type="text" class="form-control"  placeholder="Enter Shop website" 
                id="shop_website" name="shop_website"  value="{{ $vendorDetails['shop_website'] }}">
              </div>
              <div class="form-group">
                <label for="shop_email">Shop Email</label>
                <input type="text" class="form-control"  placeholder="Enter Shop Email" 
                id="shop_email" name="shop_email"  value="{{ $vendorDetails['shop_email'] }}">
              </div>
              <div class="form-group">
                <label for="shop_address_proof">Adress Proof</label>
                <select class="form-control" name="shop_address_proof" id="shop_address_proof">
                    <option @if ($vendorDetails['address_proof'] == 'Passport') selected @endif 
                    value="Passport">Passport</option>
                    <option @if ($vendorDetails['address_proof'] == 'Voting card') selected @endif
                    value="Voting card">Voting card</option>
                    <option @if ($vendorDetails['address_proof'] == 'pan') selected @endif
                    value="pan">Pan</option>
                    <option @if ($vendorDetails['address_proof'] == 'driving_license') selected @endif
                    value="driving_license">Driving license</option>
                </select>
              </div>
              <div class="form-group">
                <label for="business_license_number">Business License Number </label>
                <input type="text" class="form-control"  placeholder="Enter Business License number" 
                id="business_license_number" name="business_license_number"  value="{{ $vendorDetails['business_license_number'] }}">
              </div>
              <div class="form-group">
                <label for="gst_number ">GST Number</label>
                <input type="text" class="form-control"  placeholder="Enter GST Number" 
                id="gst_number" name="gst_number"  value="{{ $vendorDetails['gst_number'] }}">
              </div>
              <div class="form-group">
                <label for="pan_number">GST Number</label>
                <input type="text" class="form-control"  placeholder="Enter PAN Number" 
                id="pan_number" name="pan_number"  value="{{ $vendorDetails['pan_number'] }}">
              </div>
              <div class="form-group">
                <label for="shop_address_proof_image">Adress Proof Photo</label>
                <input type="file" class="form-control"  maxlength="10"
                  minlength="10" id="shop_address_proof_image" name="shop_address_proof_image"  >
                  @if (!empty($vendorDetails['address_proof_image']))
                    <a href="{{ url('admin/images/proofs/'.$vendorDetails['address_proof_image']) }}" target="_blank"> View Image</a>
                    <input type="hidden" name="current_vendor_business_image" value="{{ $vendorDetails['address_proof_image'] }}" >
                  @endif
              </div>
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <a class="btn btn-light" href = {{ url('admin/dashboard') }}>Cancel</a>
          </form>
        </div>
      </div>
    </div>
</div>
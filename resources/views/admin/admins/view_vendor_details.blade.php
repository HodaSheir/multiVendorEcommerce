@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold"> Vendor Details</h3>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                    id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="true">
                                    <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                    <a class="dropdown-item" href="#">January - March</a>
                                    <a class="dropdown-item" href="#">March - June</a>
                                    <a class="dropdown-item" href="#">June - August</a>
                                    <a class="dropdown-item" href="#">August - November</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Personal Information</h4>
                            <div class="form-group">
                                <label> Email</label>
                                <input class="form-control"   readonly
                                    value={{ $vendorDetails['vendor']['email']  }}>
                            </div>
                            <div class="form-group">
                                <label for="shop_name">Name</label>
                                <input type="text" class="form-control"  readonly
                                value="{{ $vendorDetails['vendor']['name'] }}">
                            </div>
                            <div class="form-group">
                                <label for="shop_mobile">Mobile</label>
                                <input type="mobile" class="form-control"  readonly
                                    value="{{ $vendorDetails['vendor']['mobile'] }}">
                            </div>
                            <div class="form-group">
                                <label for="shop_address">Address</label>
                                <input type="text" class="form-control"  readonly 
                                value="{{ $vendorDetails['vendor']['address'] }}">
                            </div>
                            <div class="form-group">
                                <label for="shop_city">City</label>
                                <input type="text" class="form-control" readonly 
                                 value="{{ $vendorDetails['vendor']['city'] }}">
                            </div>
                            <div class="form-group">
                                <label for="shop_state">State</label>
                                <input type="text" class="form-control"  readonly 
                                 value="{{ $vendorDetails['vendor']['state'] }}">
                            </div>
                            <div class="form-group">
                                <label for="shop_country">Country</label>
                                <input type="text" class="form-control"  readonly 
                                value="{{ $vendorDetails['vendor']['country'] }}">
                            </div>
                            <div class="form-group">
                                <label for="shop_pincode">Pincode</label>
                                <input type="text" class="form-control" readonly 
                                 value="{{ $vendorDetails['vendor']['pincode'] }}">
                            </div>
                            
                            @if (!empty($vendorDetails['image']))
                                <div class="form-group">
                                    <label for="shop_image">Vendor Photo</label>
                                    <img src="{{ url('admin/images/photos/' .$vendorDetails['image']) }}" width="200px">
                                </div>        
                             @endif
                            
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Business Information</h4>
                            <div class="form-group">
                                <label for="shop_name">Shop Name</label>
                                <input type="text" class="form-control"  readonly
                                value="{{ $vendorDetails['vendor_business']['shop_name'] }}">
                            </div>
                            <div class="form-group">
                                <label> Shop Email</label>
                                <input class="form-control"   readonly
                                    value={{ $vendorDetails['vendor_business']['shop_email']  }}>
                            </div>
                            <div class="form-group">
                                <label for="shop_mobile">Shop Mobile</label>
                                <input type="mobile" class="form-control"  readonly
                                    value="{{ $vendorDetails['vendor_business']['shop_mobile'] }}">
                            </div>
                            <div class="form-group">
                                <label for="shop_address">Shop Address</label>
                                <input type="text" class="form-control"  readonly 
                                value="{{ $vendorDetails['vendor_business']['shop_address'] }}">
                            </div>
                            <div class="form-group">
                                <label for="shop_city">Shop City</label>
                                <input type="text" class="form-control" readonly 
                                 value="{{ $vendorDetails['vendor_business']['shop_city'] }}">
                            </div>
                            <div class="form-group">
                                <label for="shop_state">Shop State</label>
                                <input type="text" class="form-control"  readonly 
                                 value="{{ $vendorDetails['vendor_business']['shop_state'] }}">
                            </div>
                            <div class="form-group">
                                <label for="shop_country">Shop Country</label>
                                <input type="text" class="form-control"  readonly 
                                value="{{ $vendorDetails['vendor_business']['shop_country'] }}">
                            </div>
                            <div class="form-group">
                                <label for="shop_pincode">Shop Pincode</label>
                                <input type="text" class="form-control" readonly 
                                 value="{{ $vendorDetails['vendor_business']['shop_pincode'] }}">
                            </div>
                            <div class="form-group">
                                <label for="shop_pincode">Shop website</label>
                                <input type="text" class="form-control" readonly 
                                 value="{{ $vendorDetails['vendor_business']['shop_website'] }}">
                            </div>
                            <div class="form-group">
                                <label for="shop_pincode">Address Proof</label>
                                <input type="text" class="form-control" readonly 
                                 value="{{ $vendorDetails['vendor_business']['address_proof'] }}">
                            </div>

                            @if (!empty($vendorDetails['vendor_business']['address_proof_image']))
                                <div class="form-group">
                                    <label for="shop_image">Address proof Image</label>
                                    <br>
                                    <img src="{{ url('admin/images/proofs/' .$vendorDetails['vendor_business']['address_proof_image']) }}" width="200px">
                                </div>        
                            @endif
                            
                            <div class="form-group">
                                <label >Business license number</label>
                                <input type="text" class="form-control" readonly 
                                 value="{{ $vendorDetails['vendor_business']['business_license_number'] }}">
                            </div>
                            <div class="form-group">
                                <label for="shop_pincode">GST number</label>
                                <input type="text" class="form-control" readonly 
                                 value="{{ $vendorDetails['vendor_business']['gst_number'] }}">
                            </div>
                            <div class="form-group">
                                <label for="shop_pincode">PAN number</label>
                                <input type="text" class="form-control" readonly 
                                 value="{{ $vendorDetails['vendor_business']['pan_number'] }}">
                            </div>
                            
                           
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Bank Information</h4>
                            
                            <div class="form-group">
                                <label for="shop_name">Account Holder Name</label>
                                <input type="text" class="form-control"  readonly
                                value="{{ $vendorDetails['vendor_bank']['account_holder_name'] }}">
                            </div>
                            <div class="form-group">
                                <label> Bank Name</label>
                                <input class="form-control"   readonly
                                    value={{ $vendorDetails['vendor_bank']['bank_name']  }}>
                            </div>
                            <div class="form-group">
                                <label for="shop_mobile">Bank Ifsc Code</label>
                                <input type="mobile" class="form-control"  readonly
                                    value="{{ $vendorDetails['vendor_bank']['bank_ifsc_code'] }}">
                            </div>
                            <div class="form-group">
                                <label for="shop_address">Account Number</label>
                                <input type="text" class="form-control"  readonly 
                                value="{{ $vendorDetails['vendor_bank']['account_number'] }}">
                            </div>
                    </div>
                </div>
            </div>
        </div>
       
       
    </div> 
</div>    




@endsection
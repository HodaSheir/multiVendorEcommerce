<div class="row">
    <div class="col-md-9 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Update Bank Details</h4>
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
          <form class="forms-sample" action="{{ url('admin/update-vendor-details/bank') }}" method="post"
           name="updateBankForm" id="updateVBankForm" enctype="multipart/form-data">
           @csrf
            <div class="form-group">
              <label >Vendor Username / Email</label>
              <input  class="form-control" placeholder="Username" readonly 
              value={{ Auth::guard('admin')->user()->email}}>
            </div>
            <div class="form-group">
              <label for="account_holder_name">Account holder name</label>
              <input type="text" class="form-control"  placeholder="Enter Account Holder Name" 
                id="account_holder_name" name="account_holder_name"  value="{{ $vendorDetails['account_holder_name'] }}">
            </div>
            <div class="form-group">
                <label for="bank_name">Bank name</label>
                <input type="text" class="form-control"  placeholder="Enter Bank Name" 
                id="bank_name" name="bank_name"  value="{{ $vendorDetails['bank_name'] }}">
            </div>
            <div class="form-group">
                <label for="bank_ifsc_code">IFSC code</label>
                <input type="text" class="form-control"  placeholder="Enter Bank IFSC code" 
                id="bank_ifsc_code" name="bank_ifsc_code"  value="{{ $vendorDetails['bank_ifsc_code'] }}">
              </div>
              <div class="form-group">
                <label for="account_number">Account number</label>
                <input type="text" class="form-control"  placeholder="Enter Account Number" 
                id="account_number" name="account_number"  value="{{ $vendorDetails['account_number'] }}">
              </div>
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <a class="btn btn-light" href = {{ url('admin/dashboard') }}>Cancel</a>
          </form>
        </div>
      </div>
    </div>
</div>
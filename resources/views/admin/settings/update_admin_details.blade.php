@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Settings</h3>
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
            <div class="col-md-9 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update admin Details</h4>
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
                  <form class="forms-sample" action="{{ url('admin/update-admin-details') }}" method="post"
                   name="updateAdminDetailsForm" id="updateAdminDetailsForm" enctype="multipart/form-data">
                   @csrf
                    <div class="form-group">
                      <label >Username / Email</label>
                      <input  class="form-control" placeholder="Username" readonly 
                      value={{ Auth::guard('admin')->user()->email}}>
                    </div>
                    <div class="form-group">
                      <label for="type">Admin Type</label>
                      <input name="type" class="form-control"  placeholder="Type" readonly value={{Auth::guard('admin')->user()->type }}>
                    </div>
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control"  placeholder="Enter Name" 
                      id="name" name="name" required value="{{ Auth::guard('admin')->user()->name }}">
                    </div>
                    <div class="form-group">
                      <label for="mobile">Mobile</label>
                      <input type="mobile" class="form-control"  placeholder="Enter Mobile no." maxlength="10"
                        minlength="10" id="mobile" name="mobile" required value="{{ Auth::guard('admin')->user()->mobile }}">
                    </div>
                    <div class="form-group">
                      <label for="admin_image">Admin Photo</label>
                      <input type="file" class="form-control"  maxlength="10"
                        minlength="10" id="admin_image" name="admin_image"  >
                        @if (!empty(Auth::guard('admin')->user()->image))
                          <a href="{{ url('admin/images/photos/'.Auth::guard('admin')->user()->image) }}" target="_blank"> View Image</a>
                          <input type="hidden" name="current_image" value="g{{ Auth::guard('admin')->user()->image }}" >
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a class="btn btn-light" href = {{ url('admin/dashboard') }}>Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            
          </div>
    </div> 
</div>           
@endsection
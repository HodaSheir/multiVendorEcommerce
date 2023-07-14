<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\VendorBankDetails;
use App\Models\VendorBusinessDetails;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Image;

class adminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];

            $customMessages = [
                'email.required' => 'Emailllll is required',
                'email.email' => 'Valid Email is Required',
                'password.required' => 'Password is required',
            ];

            $this->validate($request, $rules, $customMessages);

            if (
                Auth::guard('admin')->attempt([
                    'password' => $data['password'],
                    'email' => $data['email'],
                    'status' => 1
                ])
            ) {
                return redirect('admin/dashboard');
            } else {
                return redirect()->back()->with('error_message', 'Invalid email or password');
            }
        }
        return view('admin.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function updateAdminPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            //check if current password is correct 
            if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
                if ($data['new_password'] == $data['confirm_password']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(
                        ['password' => bcrypt($data['new_password'])]
                    );
                    return redirect()->back()->with('success_message', 'Password updated successfully');
                } else {
                    return redirect()->back()->with('error_message', 'Your new password is not matched');
                }
            } else {
                return redirect()->back()->with('error_message', 'Your current password is incorrect');
            }
        }
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update_admin_password')->with(compact('adminDetails'));
    }

    public function updateAdminDetails(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'mobile' => 'required|numeric',
            ];

            $this->validate($request, $rules);

            //Upload admin photo 
            if ($request->hasFile('admin_image')) {
                $tmp_image = $request->file('admin_image');
                if ($tmp_image->isValid()) {
                    $extension = $tmp_image->getClientOriginalExtension();
                    $image_name = rand(111, 999999) . '' . $extension;
                    $image_path = 'admin/images/photos/' . $image_name;
                    Image::make($tmp_image)->save($image_path);
                }
            }elseif (!empty($data['current_image'])) {
                $image_name = $data['current_image'];
            }else{
                $image_name = '';
            }


            Admin::where('id', Auth::guard('admin')->user()->id)->update(
                ['name' => $data['name'], 'mobile' => $data['mobile'], 'image' => $image_name]
            );
            return redirect()->back()->with('success_message', 'Admin details updated successfully');

        }
        return view('admin.settings.update_admin_details');
    }

    public function checkAdminPassword(Request $request)
    {
        $data = $request->all();
        if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }

    public function updateVendorDetails($slug, Request $request){
        if($slug == 'personal'){
            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    'vendor_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_mobile' => 'required|numeric',
                    'vendor_city' => 'required|regex:/^[\pL\s\-]+$/u',
                ];
                $customMessages = [
                    'vendor_name.required' => 'Name is required',
                    'vendor_name.regex' => 'Valid name is rqeuired',
                    'vendor_mobile.required' => 'Mobile is required',
                    'vendor_mobile.numeric' => 'Mobile must be number',
                    'vendor_city.required' => 'City is rqeuired',
                ];
                $this->validate($request, $rules,$customMessages);
    
                //Upload admin photo 
                if ($request->hasFile('vendor_image')) {
                    $tmp_image = $request->file('vendor_image');
                    if ($tmp_image->isValid()) {
                        $extension = $tmp_image->getClientOriginalExtension();
                        $image_name = rand(111, 999999) . '' . $extension;
                        $image_path = 'admin/images/photos/' . $image_name;
                        Image::make($tmp_image)->save($image_path);
                    }
                }elseif (!empty($data['current_image'])) {
                    $image_name = $data['current_image'];
                }else{
                    $image_name = '';
                }
                //update in admins table
                Admin::where('id', Auth::guard('admin')->user()->id)->update(
                    ['name' => $data['vendor_name'], 'mobile' => $data['vendor_mobile'], 'image' => $image_name]
                );
                //update in vendors table
                Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->update(
                    ['name' => $data['vendor_name'], 'mobile' => $data['vendor_mobile'],
                    'address' => $data['vendor_address'], 'city' => $data['vendor_city'],
                    'state' => $data['vendor_state'], 'country' => $data['vendor_country'],
                    'pincode' => $data['vendor_pincode']
                    ]
                );
                return redirect()->back()->with('success_message', 'Vendor details updated successfully');
            }
            $vendorDetails = Vendor::where('id', Auth::guard('admin')->user()->id)->first()->toArray();

        }else if($slug == 'business'){

            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    'shop_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_mobile' => 'required|numeric',
                    'shop_city' => 'required',
                    'shop_address'=>'required',
                    'shop_address_proof'=>'required',
                    'shop_address_proof_image' => 'image'
                ];
                $customMessages = [
                    'shop_name.required' => 'Name is required',
                    'shop_name.regex' => 'Valid name is rqeuired',
                    'shop_mobile.required' => 'Mobile is required',
                    'shop_mobile.numeric' => 'Mobile must be number',
                    'shop_city.required' => 'City is rqeuired',
                    'shop_address.required' => 'Shop Address is rqeuired',
                    'shop_address_proof.required' => 'Address proof is rqeuired',
                    'shop_address_proof_image.image' => 'Valid Address proof image is rqeuired',
                ];
                $this->validate($request, $rules,$customMessages);
    
                //Upload admin photo 
                if ($request->hasFile('shop_address_proof_image')) {
                    $tmp_image = $request->file('shop_address_proof_image');
                    if ($tmp_image->isValid()) {
                        $extension = $tmp_image->getClientOriginalExtension();
                        $image_name = rand(111, 999999) . '' . $extension;
                        $image_path = 'admin/images/proofs/' . $image_name;
                        Image::make($tmp_image)->save($image_path);
                    }
                }elseif (!empty($data['current_vendor_business_image'])) {
                    $image_name = $data['current_vendor_business_image'];
                }else{
                    $image_name = '';
                }
               
                //update in vendors business details table
                VendorBusinessDetails::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update(
                    ['shop_name' => $data['shop_name'], 'shop_mobile' => $data['shop_mobile'],
                    'shop_address' => $data['shop_address'], 'shop_city' => $data['shop_city'],
                    'shop_state' => $data['shop_state'], 'shop_country' => $data['shop_country'],
                    'shop_pincode' => $data['shop_pincode'], 'shop_website' =>$data['shop_website'] ,
                    'shop_email' =>$data['shop_email'],  'address_proof' =>$data['shop_address_proof']
                    , 'address_proof_image' =>$image_name, 'business_license_number' =>$data['business_license_number']
                    , 'gst_number' =>$data['gst_number'], 'pan_number' =>$data['pan_number']
                    ]
                );
                return redirect()->back()->with('success_message', 'Vendor Business details updated successfully');
            }
            $vendorDetails = VendorBusinessDetails::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        }else if($slug == 'bank'){
            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    'account_holder_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'bank_name' => 'required',
                    'account_number' => 'required|numeric',
                    'bank_ifsc_code' =>'required'
                ];
                $customMessages = [
                    'account_holder_name.required' => 'Account holder Name is required',
                    'account_holder_name.regex' => 'Valid name is rqeuired',
                    'bank_name.required' => 'Bank is required',
                    'account_number.numeric' => 'Account number must be number',
                    'account_number.required' => 'Account number is rqeuired',
                    'bank_ifsc_code.required' => 'IFSC code is required'
                ];
                $this->validate($request, $rules,$customMessages);
                //update in vendors bank details table
                VendorBankDetails::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update(
                    ['bank_name' => $data['bank_name'], 'bank_ifsc_code' => $data['bank_ifsc_code'],
                    'account_holder_name' => $data['account_holder_name'], 'account_number' => $data['account_number']
                    ]
                );
                return redirect()->back()->with('success_message', 'Vendor Bank details updated successfully');
            }    
            $vendorDetails = VendorBankDetails::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        }
        return view('admin.settings.update_vendor_details')->with(compact('slug','vendorDetails'));
    }

    public function admins($type = null){
        $admins = Admin::query();
        if($type){
            $admins = $admins->where('type',$type);
            $title = ucfirst($type).'s';
        }else{
            $title = 'All Admins/SubAdmins/Vendors';
        }
        $admins = $admins->get()->toArray();
        return view('admin.admins.admins')->with(compact('admins','title'));
    }

    public function viewVendorDetails($id){
        $vendorDetails = Admin::where('id',$id)
        ->with('vendor','vendorBusiness','vendorBank')->firstOrFail()->toArray();
        return view('admin.admins.view_vendor_details')->with(compact('vendorDetails'));
    }

    public function updateAdminStatus(Request $request){
        if($request->ajax()){
            $data  = $request->all();
            if($data['status'] == 'active'){
                $status  = 0;
            }else{
                $status = 1;
            }
            Admin::where('id',$data['admin_id'])->update(['status' => $status]);
            return response()->json(['status' => $status]);
        }
    }
}
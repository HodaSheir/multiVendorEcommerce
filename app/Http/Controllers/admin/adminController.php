<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
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
}
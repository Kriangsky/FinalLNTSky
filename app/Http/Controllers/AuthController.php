<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6|max:12',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $email = $request->email;
        $password = $request->password;

        $user = Auth::attempt(['email' => $email, 'password' => $password]);

        if($user){
            return redirect('home');
        }

        return redirect()->back();
    
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:40',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|max:12',
            'handphone' => 'required|string|regex:/^08[0-9]{9,}$/',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'handphone' => $request->handphone,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/');
    }

    public function admin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_id' => 'required',
            'password' => 'required|min:6|max:12',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $admin_id = $request->admin_id;
        $password = $request->password;
    
        $admin = Admin::where('admin_id', $admin_id)->first();
    
        if ($admin && $password === $admin->password) {
            return redirect('/admin-index');
        }   
    
        return redirect()->back()->with('error', 'Invalid admin ID or password.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); 
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

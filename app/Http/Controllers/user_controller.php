<?php

namespace App\Http\Controllers;

use App\Models\User;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class user_controller extends Controller
{
    public function regist(Request $request) {
        // Validasi input
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phoneNumber' => 'required|string|max:20',
            'password' => 'required|string|min:6',
        ]);
    
        // Simpan user baru
        $user = new User();
        $user->fullname = $request->input('fullname');
        $user->email = $request->input('email');
        $user->phoneNumber = $request->input('phoneNumber'); 
        $user->password = Hash::make($request->input('password'));
        $user->role = 'user';
        $user->save();
    
        return redirect('/')->with('success', 'Akun berhasil dibuat');
    }
    public function adminLogin(Request $request){
   
        $user = User::where('email', $request->email)->first();

  
        if ($user && Hash::check($request->password, $user->password) && $user->role === 'organizer') {
      
            session(['admin_login' => true]);
            session(['adminID' => $user->id]);

            return redirect('/admin');
        } else {
    
            session()->flash('errors', ['Check your email, password, or role again']);
            return redirect()->back();
        }

        
        
    }


    public function userLogin(Request $request) {
        $data = [
            'email'=>$request->email,
            'password'=>$request->password
        ];
        if(Auth::guard("web")->attempt($data)) {
            $user = Auth::guard("web")->user();
            session(['user_id' => $user->id]);
            return redirect('/home');

        } else {
            session()->flash('errors', ['Check Your Username and Password is Correct']);
            return redirect()->back();
        }
    }

    public function showRegisterForm()
    {
        return view('userRegister');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

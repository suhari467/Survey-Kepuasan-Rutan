<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->user()->id)->first();

        $data = [
            'title' => 'Data Profile',
            'slug' => 'profile',
            'user' => $user,
        ];

        // ddd($data);
        return view('profile.index', $data);
    }

    public function edit()
    {
        $user = User::where('id', auth()->user()->id)->first();

        $validation = auth()->user()->id;
        if($validation!=$user->id){
            return redirect('/profile')->with('error', 'Data profile tidak dapat diedit');
        }
        
        $data = [
            'title' => 'Edit Profile Pengguna',
            'slug' => 'profile',
            'user' => $user
        ];

        // ddd($data);
        return view('profile.edit', $data);
    }

    public function update(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $rules = [
            'name' => 'required|max:255'
        ];

        if($request->email != $user->email) {
            $rules['email'] = 'required|unique:users|email:dns';
        }

        $validate = $request->validate($rules);

        // ddd($validate);
        $update = User::where('id', auth()->user()->id)->update($validate);

        if($update){
            return redirect('/profile')->with('success', 'Data Profile Pengguna berhasil diubah');
        }else{
            return redirect('/profile')->with('error', 'Data Profile Pengguna gagal diubah');
        }
    }

    public function password()
    {
        $user = User::where('id', auth()->user()->id)->first();

        $validation = auth()->user()->id;
        if($validation!=$user->id){
            return redirect('/profile')->with('error', 'Data profile tidak dapat diedit');
        }
        
        $data = [
            'title' => 'Reset Password Pengguna',
            'slug' => 'profile',
            'user' => $user
        ];

        // ddd($data);
        return view('profile.password', $data);
    }

    public function reset(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();

        $validate = $request->validate([
            'password' => 'required|min:8|max:255',
            'new_password' => 'required|min:8|max:255',
            'repeat_password' => 'same:new_password'
        ]);

        $old_password = bcrypt($request->password);
        $check = Hash::check($request->password, $user->password);
        if(!$check){
            return redirect('profile/password')->with('error', 'password lama tidak sesuai');
        }

        $data['password'] = Hash::make($validate['new_password']);

        $resetPassword = User::where('id', $user->id)->update($data);
        if($resetPassword){
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('login')->with('success', 'Data password pengguna telah berhasil diubah');
        }else{
            return redirect('profile/password')->with('error', 'Data password pengguna tidak dapat diubah. Harap coba kembali');
        }
    }
}

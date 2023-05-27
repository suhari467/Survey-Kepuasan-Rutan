<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        $data = [
            'title' => 'Data Pengguna',
            'slug' => 'user',
            'users' => $users
        ];

        // ddd($data);

        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Pengguna',
            'slug' => 'user',
        ];

        return view('admin.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users|max:255',
            'password' => 'required|min:8|max:255',
            'confirm_password' => 'required|same:password'
        ]);

        $validate['password'] = bcrypt($request->password);
        $validate['role_id'] = 2; //Pengguna

        // ddd($validate);
        $create = User::create($validate);

        if($create){
            return redirect('/setting/user')->with('success', 'Akun telah berhasil dibuat');
        }else{
            return redirect('/setting/user')->with('error', 'Akun gagal dibuat');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $data = [
            'title' => 'Informasi Pengguna',
            'slug' => 'user',
            'user' => $user
        ];

        // ddd($data);

        return view('admin.user.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data = [
            'title' => 'Edit Pengguna',
            'slug' => 'user',
            'user' => $user
        ];

        // ddd($data);

        return view('admin.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:255',
            'role_id' => 'required|numeric'
        ];

        if($request->email != $user->email) {
            $rules['email'] = 'required|unique:users|email:dns';
        }

        $validate = $request->validate($rules);

        // ddd($validate);
        $update = User::where('id', $user->id)->update($validate);

        if($update){
            return redirect('/setting/user')->with('success', 'Data Pengguna berhasil diubah');
        }else{
            return redirect('/setting/user')->with('error', 'Data Pengguna gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $destroy = User::destroy($user->id);
        if($destroy){
            return redirect('/setting/user')->with('success', 'Data pengguna telah berhasil dihapus');
        }else{
            return redirect('/setting/user')->with('error', 'Data pengguna tidak dapat dihapus');
        }
    }

    public function password(User $user)
    {
        $data = [
            'title' => 'Ubah Password',
            'slug' => 'user',
            'user' => $user
        ];

        return view('admin.user.password', $data);
    }

    public function password_verification(Request $request, User $user)
    {
        $validate = $request->validate([
            'new_password' => 'required|min:8|max:255',
            'repeat_password' => 'same:new_password'
        ]);

        $data['password'] = Hash::make($validate['new_password']);

        $update_password = User::where('id', $user->id)->update($data);
        if($update_password){
            return redirect('/setting/user')->with('success', 'Data password pengguna telah berhasil diubah');
        }else{
            return redirect('/setting/user')->with('error', 'Data password pengguna tidak dapat diubah. Harap coba kembali');
        }

    }
}

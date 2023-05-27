<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_instansi = Instansi::orderBy('status', 'desc')->get();
        $status = Instansi::status();

        $data = [
            'data_instansi' => $data_instansi,
            'title' => 'Data Pengaturan Instansi',
            'status' => $status,
            'slug' => 'instansi'
        ];

        return view('admin.instansi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Instansi',
            'slug' => 'instansi'
        ];

        return view('admin.instansi.create', $data);
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
            'nama_instansi' => 'required|max:255',
            'alamat_instansi' => 'required',
            'informasi_instansi' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email',
            'logo' => 'required|file|mimes:jpeg,png,gif|max:2048',
            'ukuran_logo' => 'required|numeric|max:255'
        ]);

        $validate['status'] = 0; //non-aktif

        // ddd($validate);

        if($request->file('logo')){
            $namaBerkas = str_replace(" ", "_", $validate['nama_instansi']);
            $timestamp = time();
            $extension = $request->file('logo')->getClientOriginalExtension();
            $filenameSimpan = $namaBerkas.'_'.$timestamp.'.'.$extension;
            $upload = $request->file('logo')->move('storage/instansi', $filenameSimpan);

            $validate['logo'] = $upload->getFilename();
        }
        

        $create = Instansi::create($validate);

        if($create){
            return redirect('/setting/instansi')->with('success', 'Instansi berhasil dibuat');
        }else{
            return redirect('/setting/instansi')->with('error', 'Instansi gagal dibuat');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function show(Instansi $instansi)
    {
        $data = [
            'instansi' => $instansi,
            'title' => 'Informasi Pengaturan Instansi',
            'slug' => 'instansi'
        ];

        return view('admin.instansi.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function edit(Instansi $instansi)
    {
        $data = [
            'instansi' => $instansi,
            'title' => 'Edit Pengaturan Instansi',
            'slug' => 'instansi'
        ];

        return view('admin.instansi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instansi $instansi)
    {
        $validate = $request->validate([
            'nama_instansi' => 'required|max:255',
            'alamat_instansi' => 'required',
            'informasi_instansi' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email',
            'logo' => 'file|mimes:jpeg,png,gif|max:2048',
            'ukuran_logo' => 'required|numeric|max:255'
        ]);

        // ddd($validate);

        if($request->file('logo')){
            if($request->oldFile){
                $deleteFile = Storage::disk('public')->delete('instansi/'.$instansi->logo);
                if(!$deleteFile){
                    return redirect('/setting/instansi')->with('error', 'Logo tidak dapat diedit');
                }
            }
            $namaBerkas = str_replace(" ", "_", $validate['nama_instansi']);
            $timestamp = time();
            $extension = $request->file('logo')->getClientOriginalExtension();
            $filenameSimpan = $namaBerkas.'_'.$timestamp.'.'.$extension;
            $upload = $request->file('logo')->move('storage/instansi', $filenameSimpan);

            $validate['logo'] = $upload->getFilename();
        }

        // ddd($validate);

        $update = Instansi::where(['id' => $instansi->id])->update($validate);

        if($update){
            if($request->file('logo')){
                session([
                    'nama_instansi' => $validate['nama_instansi'],
                    'logo' => $validate['logo']
                ]);
            }else{
                session([
                    'nama_instansi' => $validate['nama_instansi'],
                ]);
            }

            return redirect('/setting/instansi')->with('success', 'Pengaturan berhasil diedit');
        }else{
            return redirect('/setting/instansi')->with('error', 'Pengaturan gagal diedit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instansi $instansi)
    {
        if($instansi->status == 1){
            return redirect('/setting/instansi')->with('error', 'Instansi tidak dapat dihapus, karena masih aktif');
        }

        if($instansi->logo) {
            $deleteFile = Storage::disk('public')->delete('instansi/'.$instansi->logo);
            if(!$deleteFile){
                return redirect('/setting/instansi')->with('error', 'Logo tidak dapat dihapus');
            }
        }

        $destroy = Instansi::destroy($instansi->id);

        if($destroy){
            return redirect('/setting/instansi')->with('success', 'Pengaturan berhasil dihapus');
        }else{
            return redirect('/setting/instansi')->with('error', 'Pengaturan gagal dihapus');
        }
    }

    public function status(Instansi $instansi)
    {
        // $status = Instansi::status();
        // ddd($instansi);
        $aktif = Instansi::where('status', 1)->first();

        $old_update = Instansi::where('id', $aktif->id)->update(['status' => 0]);
        $new_update = Instansi::where('id', $instansi->id)->update(['status' => 1]);

        if($new_update && $old_update){
            $new_aktif = Instansi::where('status', 1)->first();

            session([
                'nama_instansi' => $new_aktif->nama_instansi,
                'logo' => $new_aktif->logo
            ]);

            return redirect('/setting/instansi')->with('success', 'Pengaturan terpilih telah aktif!');
        }else{
            return redirect('/setting/instansi')->with('error', 'Pengaturan terpilih gagal aktif!');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fetch = json_decode(Storage::disk('public')->get('pin.json'));
        $pin = collect($fetch)->first();

        $data = [
            'title' => 'Data PIN Antarmuka',
            'slug' => 'pin',
            'pin' => $pin
        ];

        // ddd($data);

        return view('admin.pin.index', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validate = $request->validate([
            'pin' => 'required|numeric|min:6'
        ]);

        $file = json_decode(Storage::disk('public')->get('pin.json'));
        $data_pin = collect($file)->first();

        $id = $data_pin->id;

        $pin = $validate['pin'];

        $data = [
            'id' => $id,
            'pin' => $pin
        ];

        $array = ['data' => $data];

        $update = Storage::disk('public')->put('pin.json', json_encode($array));

        if($update){
            return redirect('setting/pin')->with('success', 'PIN Antarmuka berhasil di ubah');
        }else{
            return redirect('setting/pin')->with('error', 'PIN Antarmuka gagal untuk di ubah');
        }
    }
}

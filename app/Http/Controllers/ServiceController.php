<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::orderBy('created_at', 'desc')->get();

        $data = [
            'services' => $services,
            'title' => 'Data Layanan',
            'slug' => 'service',
        ];

        return view('service.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Layanan',
            'slug' => 'service'
        ];

        return view('service.create', $data);
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
            'name' => 'required|max:255'
        ]);

        // ddd($validate);
        $create = Service::create($validate);

        if($create){
            return redirect('/layanan')->with('success', 'Layanan telah berhasil dibuat');
        }else{
            return redirect('/layanan')->with('error', 'Layanan gagal dibuat');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        $data = [
            'title' => 'Informasi Layanan',
            'slug' => 'service',
            'service' => $service
        ];

        // ddd($data);

        return view('service.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $data = [
            'title' => 'Edit Layanan',
            'slug' => 'service',
            'service' => $service
        ];

        return view('service.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $validate = $request->validate([
            'name' => 'required|max:255'
        ]);

        // ddd($validate);
        $update = Service::where('id', $service->id)->update($validate);

        if($update){
            return redirect('/layanan')->with('success', 'Layanan telah berhasil diedit');
        }else{
            return redirect('/layanan')->with('error', 'Layanan gagal diedit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $count_surveys = $service->surveys->count();
        if($count_surveys>0){
            return redirect('/layanan')->with('error', 'Data Layanan tidak dapat dihapus, dikarenakan ada survey terkait');
        }

        $destroy = Service::destroy($service->id);
        if($destroy){
            return redirect('/layanan')->with('success', 'Data Layanan telah berhasil dihapus');
        }else{
            return redirect('/layanan')->with('error', 'Data Layanan tidak dapat dihapus');
        }
    }
}

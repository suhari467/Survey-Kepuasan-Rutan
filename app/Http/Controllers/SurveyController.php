<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Service;
use App\Models\Question;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SurveyController extends Controller
{
    public function layanan()
    {
        $services = Service::orderBy('created_at', 'desc')->get();
        $questions = Question::orderBy('created_at', 'desc')->get();

        $data = [
            'title' => 'Antarmuka Layanan',
            'slug' => 'survey',
            'instansi' => Instansi::where('status', 1)->first(),
            'services' => $services,
            'questions' => $questions
        ];

        return view('survey.layanan', $data);
    }

    public function prosesLayanan(Request $request)
    {
        $layanan_id = $request->layanan_id;
        $pertanyaan_id = $request->pertanyaan_id;

        if($layanan_id == null || $pertanyaan_id == null){
            return redirect('antarmuka/layanan')->with('error', 'Layanan dan Pertanyaan belum di set');
        }

        $instansi = Instansi::where('status', 1)->first();
        $service = Service::where('id', $layanan_id)->first();
        $question = Question::where('id', $pertanyaan_id)->first();
        $feedback = Survey::feedback();

        $data = [
            'title' => 'Antarmuka Survey',
            'slug' => 'survey',
            'instansi' => $instansi,
            'service' => $service,
            'question' => $question,
            'feedback' => $feedback
        ];

        return view('survey.antarmuka', $data);
    }

    public function storeSurvey(Request $request)
    {
        $rules = [
            'service_id' => 'required|numeric',
            'question_id' => 'required|numeric',
            'feedback' => 'required|numeric',
        ];

        if($request->feedback != 3){
            $rules['kritik'] = 'required|min:10';
            if($request->kritik == null){
                $data = [
                    'type' => 'error',
                    'message' => 'Survey gagal dibuat, kritik wajib di isi'
                ];
                return json_encode($data);
            }else if(strlen($request->kritik) <= 10){
                $data = [
                    'type' => 'error',
                    'message' => 'Survey gagal dibuat, kritik wajib di isi (minimal 10 karakter)'
                ];
                return json_encode($data);
            }
        }else {
            $rules['kritik'] = 'nullable';
        }

        $validate = $request->validate($rules);

        $create = Survey::create($validate);

        if($create){
            $data = [
                'type' => 'success',
                'message' => 'Survey telah berhasil dibuat'
            ];
            return json_encode($data);
        }else{
            $data = [
                'type' => 'error',
                'message' => 'Survey gagal dibuat'
            ];
            return json_encode($data);
        }
    }

    public function signOut()
    {
        return redirect('antarmuka/layanan')->with('success', 'Silahkan masukkan layanan dan pertanyaan');
    }

    public function getKategori()
    {
        $kategori = Survey::feedback();

        return json_encode($kategori);
    }
}

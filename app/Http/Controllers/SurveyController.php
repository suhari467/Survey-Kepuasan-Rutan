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
    public function auth()
    {
        $data = [
            'instansi' => Instansi::where('status', 1)->first(),
            'title' => 'Antarmuka Survey',
            'slug' => 'survey'
        ];

        return view('survey.auth', $data);
    }

    public function checkPin(Request $request)
    {
        $validate = $request->validate([
            'pin' => 'required|numeric|min:6'
        ]);

        $file = json_decode(Storage::disk('public')->get('pin.json'));
        $data = collect($file)->first();
        // dd($data->pin);

        if($data->pin != $request->pin){
            return redirect('antarmuka/auth')->with('error', 'PIN tidak cocok, silahkan coba lagi');
        }else{
            session([
                'pin' => true,
            ]);
            return redirect('antarmuka/layanan');
        }
    }

    public function layanan()
    {
        $services = Service::orderBy('created_at', 'desc')->get();

        $data = [
            'title' => 'Antarmuka Layanan',
            'slug' => 'survey',
            'services' => $services
        ];

        return view('survey.layanan', $data);
    }

    public function getPertanyaan(Request $request)
    {
        $layanan_id = $request->layanan_id;

        $questions = Question::where('service_id', $layanan_id)->get();

        return json_encode($questions);
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
        $validate = $request->validate([
            'service_id' => 'required|numeric',
            'question_id' => 'required|numeric',
            'feedback' => 'required|numeric',
            'kritik' => 'nullable',
        ]);

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
        if(session()->has('pin')){

            session()->forget('pin');

            return redirect('antarmuka/auth')->with('success', 'Session antarmuka berhasil keluar');
        }else{
            return redirect('antarmuka/auth')->with('error', 'masukkan pin untuk kembali masuk');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Question;
use App\Models\Survey;
use App\Models\Instansi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $questions = Question::orderBy('created_at', 'desc')->get();
        $instansi = Instansi::where('status', 1)->first();

        $data = [
            'title' => 'Data Laporan',
            'slug' => 'laporan',
            'questions' => $questions,
            'instansi' => $instansi,
        ];

        return view('laporan.index', $data);
    }

    public function getLayanan(Request $request)
    {
        $validate = $request->validate([
            'question_id' => 'required|numeric'
        ]);

        $question_id = $request->question_id;

        $question = Question::where('id', $question_id)->first();
        $service = Service::where('id', $question->service_id)->first();

        $data = [
            'service' => $service
        ];

        return json_encode($data);
    }

    public function cariLaporan(Request $request)
    {
        $validate = $request->validate([
            'question_id' => 'required|numeric',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date'
        ]);

        $question_id = $validate['question_id'];
        $question = Question::where('id', $question_id)->first();
        $service_id = $question->service->id;

        $tanggal_awal = $validate['tanggal_awal'];
        $tanggal_akhir = $validate['tanggal_akhir'];

        $feedback = Survey::feedback();

        if($tanggal_awal == $tanggal_akhir){
            $count_survey = Survey::whereDate('created_at', $tanggal_awal)
                                 ->where('service_id', $service_id)
                                 ->where('question_id', $question_id)
                                 ->count();
            $jenis_tanggal = 'tunggal';
        }else{
            $count_survey = Survey::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])
                                 ->where('service_id', $service_id)
                                 ->where('question_id', $question_id)
                                 ->count();
            $jenis_tanggal = 'jamak';
        }

        if($count_survey > 0 && $jenis_tanggal == 'tunggal'){
            $survey = DB::table('surveys')
                        ->join('services', 'surveys.service_id', 'services.id')
                        ->join('questions', 'surveys.question_id', 'questions.id')
                        ->select('surveys.*', 'services.name', 'questions.pertanyaan')
                        ->whereDate('surveys.created_at', $tanggal_awal)
                        ->where('surveys.service_id', $service_id)
                        ->where('surveys.question_id', $question_id)
                        ->first();
            $laporan = DB::table('surveys')
                            ->select(DB::raw('CAST(created_at AS DATE) as tanggal, COUNT(feedback) as jumlah, feedback'))
                            ->whereDate('created_at', $tanggal_awal)
                            ->where('service_id', $service_id)
                            ->where('question_id', $question_id)
                            ->groupBy('tanggal', 'feedback')
                            ->get();
            $count_kritik_survey = Survey::whereDate('created_at', $tanggal_awal)
                                        ->where('service_id', $service_id)
                                        ->where('question_id', $question_id)
                                        ->where('kritik', '!=', null)
                                        ->count();
            $feedback_sangat_puas = Survey::whereDate('created_at', $tanggal_awal)
                                    ->where('service_id', $service_id)
                                    ->where('question_id', $question_id)
                                    ->where('feedback', 3)
                                    ->count();
            $feedback_puas = Survey::whereDate('created_at', $tanggal_awal)
                                    ->where('service_id', $service_id)
                                    ->where('question_id', $question_id)
                                    ->where('feedback', 2)
                                    ->count();
            $feedback_cukup_puas = Survey::whereDate('created_at', $tanggal_awal)
                                    ->where('service_id', $service_id)
                                    ->where('question_id', $question_id)
                                    ->where('feedback', 1)
                                    ->count();
        }else if($count_survey > 0 && $jenis_tanggal == 'jamak'){
            $survey = DB::table('surveys')
                        ->join('services', 'surveys.service_id', 'services.id')
                        ->join('questions', 'surveys.question_id', 'questions.id')
                        ->select('surveys.*', 'services.name', 'questions.pertanyaan')
                        ->whereBetween('surveys.created_at', [$tanggal_awal, $tanggal_akhir])
                        ->where('surveys.service_id', $service_id)
                        ->where('surveys.question_id', $question_id)
                        ->first();
            $laporan = DB::table('surveys')
                            ->select(DB::raw('CAST(created_at AS DATE) as tanggal, COUNT(feedback) as jumlah, feedback'))
                            ->whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])
                            ->where('service_id', $service_id)
                            ->where('question_id', $question_id)
                            ->groupBy('tanggal', 'feedback')
                            ->get();
            $count_kritik_survey = Survey::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])
                                        ->where('service_id', $service_id)
                                        ->where('question_id', $question_id)
                                        ->where('kritik', '!=', null)
                                        ->count();
            $feedback_sangat_puas = Survey::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])
                                    ->where('service_id', $service_id)
                                    ->where('question_id', $question_id)
                                    ->where('feedback', 3)
                                    ->count();
            $feedback_puas = Survey::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])
                                    ->where('service_id', $service_id)
                                    ->where('question_id', $question_id)
                                    ->where('feedback', 2)
                                    ->count();
            $feedback_cukup_puas = Survey::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])
                                    ->where('service_id', $service_id)
                                    ->where('question_id', $question_id)
                                    ->where('feedback', 1)
                                    ->count();
        }else{
            $survey = [];
            $laporan = null;
            $count_kritik_survey = 0;
            $feedback_sangat_puas = [];
            $feedback_puas = [];
            $feedback_cukup_puas = [];
        }

        if($count_kritik_survey > 0 && $jenis_tanggal == 'tunggal'){
            $kritik_survey = DB::table('surveys')
                                        ->join('services', 'surveys.service_id', 'services.id')
                                        ->join('questions', 'surveys.question_id', 'questions.id')
                                        ->select('surveys.*', 'services.name', 'questions.pertanyaan')
                                        ->whereDate('surveys.created_at', $tanggal_awal)
                                        ->where('surveys.service_id', $service_id)
                                        ->where('surveys.question_id', $question_id)
                                        ->where('surveys.kritik', '!=', null)
                                        ->orderBy('surveys.created_at', 'desc')
                                        ->get();
        }else if($count_kritik_survey > 0 && $jenis_tanggal == 'jamak'){
            $kritik_survey = DB::table('surveys')
                                        ->join('services', 'surveys.service_id', 'services.id')
                                        ->join('questions', 'surveys.question_id', 'questions.id')
                                        ->select('surveys.*', 'services.name', 'questions.pertanyaan')
                                        ->whereBetween('surveys.created_at', [$tanggal_awal, $tanggal_akhir])
                                        ->where('surveys.service_id', $service_id)
                                        ->where('surveys.question_id', $question_id)
                                        ->where('surveys.kritik', '!=', null)
                                        ->orderBy('surveys.created_at', 'desc')
                                        ->get();
        }else{
            $kritik_survey = null;
        }

        $data = [
            'question' => $question,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'count_survey' => $count_survey,
            'survey' => $survey,
            'laporan' => $laporan,
            'count_kritik_survey' => $count_kritik_survey,
            'kritik_survey' => $kritik_survey,
            'feedback_sangat_puas' => $feedback_sangat_puas,
            'feedback_puas' => $feedback_puas,
            'feedback_cukup_puas' => $feedback_cukup_puas
        ];

        return json_encode($data);
    }
}

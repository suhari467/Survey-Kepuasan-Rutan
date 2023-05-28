<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Service;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::orderBy('created_at', 'desc')->get();

        $data = [
            'questions' => $questions,
            'title' => 'Data Pertanyaan',
            'slug' => 'question',
        ];

        return view('question.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'services' => Service::get(),
            'title' => 'Tambah Pertanyaan',
            'slug' => 'question'
        ];

        return view('question.create', $data);
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
            'layanan_id' => 'required|numeric',
            'pertanyaan' => 'required|max:255'
        ]);

        $data = [
            'service_id' => $validate['layanan_id'],
            'pertanyaan' => $validate['pertanyaan']
        ];

        $create = Question::create($data);

        if($create){
            return redirect('/pertanyaan')->with('success', 'Pertanyaan telah berhasil dibuat');
        }else{
            return redirect('/pertanyaan')->with('error', 'Pertanyaan gagal dibuat');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $data = [
            'title' => 'Informasi Pertanyaan',
            'slug' => 'question',
            'question' => $question
        ];

        // ddd($data);

        return view('question.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $data = [
            'title' => 'Edit Pertanyaan',
            'slug' => 'question',
            'services' => Service::get(),
            'question' => $question
        ];

        return view('question.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $validate = $request->validate([
            'layanan_id' => 'required|numeric',
            'pertanyaan' => 'required|max:255'
        ]);

        $data = [
            'service_id' => $validate['layanan_id'],
            'pertanyaan' => $validate['pertanyaan']
        ];

        $update = Question::where('id', $question->id)->update($data);

        if($update){
            return redirect('/pertanyaan')->with('success', 'Pertanyaan telah berhasil diedit');
        }else{
            return redirect('/pertanyaan')->with('error', 'Pertanyaan gagal diedit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $count_surveys = $question->surveys->count();
        if($count_surveys>0){
            return redirect('/pertanyaan')->with('error', 'Data pertanyaan tidak dapat dihapus, dikarenakan ada pertanyaan terkait');
        }

        $destroy = Question::destroy($question->id);
        if($destroy){
            return redirect('/pertanyaan')->with('success', 'Data pertanyaan telah berhasil dihapus');
        }else{
            return redirect('/pertanyaan')->with('error', 'Data pertanyaan tidak dapat dihapus');
        }
    }
}

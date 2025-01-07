<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\SurveyQuestion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveyQuestionController extends Controller
{
    public function index()
    {
        // Mengambil semua pertanyaan dari database
        $data = DB::table('survey_questions')
            ->join('surveys', 'survey_questions.survey_id', '=', 'surveys.id')
            ->select(
                'surveys.title as survey_title',
                'survey_questions.survey_id',
                DB::raw('GROUP_CONCAT(survey_questions.question SEPARATOR "<br>") as questions')
            )
            ->groupBy('survey_questions.survey_id', 'surveys.title')
            ->get();

        $survey = Survey::all();

        return view('admin.question.index', ['data' => $data, 'survey' => $survey]);
    }
    public function create(Request $request)
    {
        try {
            $request->validate([
                'survey_id' => 'required',
                'question' => 'required'
            ]);
            SurveyQuestion::create([
                'survey_id' => $request->survey_id,
                'question' => $request->question
            ]);
            return redirect()->route('admin.question')->with('success','create data successfully!');

        } catch (Exception $e) {
            return redirect()->route('admin.question')->with('error', $e->getMessage());
        }
    }
}

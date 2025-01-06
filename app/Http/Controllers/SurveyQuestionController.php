<?php

namespace App\Http\Controllers;

use App\Models\SurveyQuestion;
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
    
        return view('admin.question.index', ['data' => $data]);
    }
}

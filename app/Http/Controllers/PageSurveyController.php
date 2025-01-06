<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\SurveyQuestion;
use Illuminate\Http\Request;

class PageSurveyController extends Controller
{
    public function userIndex()
    {
        // Ambil survei aktif
        $survey = Survey::where('status', 'active')->get();

        return view('user.index', compact('survey'));
    }

    public function userQuest(Survey $survey)
    {
        $questions = SurveyQuestion::where('survey_id', $survey->id)->get();
        return response()->json($questions);
    }

    public function userThankyou(){
        return view('user.thankyou');
    }
}

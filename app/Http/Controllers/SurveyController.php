<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\SurveyQuestion;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index(){
        $surveys = Survey::all();
        return view('admin.surveys.surveys', [
            'surveys' => $surveys
        ]);
    }
}

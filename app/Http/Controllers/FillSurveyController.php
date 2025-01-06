<?php

namespace App\Http\Controllers;

use App\Models\fillSurveys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FillSurveyController extends Controller
{
    public function index()
    {
        $data = DB::table('fill_surveys')
            ->join('survey_questions', 'fill_surveys.survey_question_id', '=', 'survey_questions.id')
            ->join('surveys', 'fill_surveys.survey_id', '=', 'surveys.id')
            ->select(
                'surveys.title as survey_title',
                'fill_surveys.name_user',
                DB::raw('GROUP_CONCAT(CONCAT(survey_questions.question, " ", fill_surveys.fill_survey) SEPARATOR "<br>") as question_response')
            )
            ->groupBy('fill_surveys.survey_id', 'fill_surveys.name_user', 'surveys.title')
            ->get();
        return view('admin.fill_survey.index', ['data' => $data]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'survey_id' => 'required|exists:surveys,id',
            'name_user' => 'required|string|max:255',
            'answers' => 'required|array',
            // 'answers.*' => 'required|string|in:sangat_tidak,tidak,cukup,puas,sangat_puas',
        ]);
        $exists = DB::table('fill_surveys')->where('survey_id', $validated['survey_id'])
            ->where('user_id', auth()->user()->id || 1)->exists();

        if ($exists) {
            return response()->json(['success' => false, 'message' => 'Anda sudah memberi aduan']);
        }

        try {
            // Menyimpan data ke dalam tabel fill_surveys
            foreach ($validated['answers'] as $questionId => $answer) {
                fillSurveys::create([
                    'survey_id' => $validated['survey_id'],
                    'survey_question_id' => $questionId,
                    'user_id' => auth()->id() || 1, // Jika Anda ingin menyertakan ID pengguna yang login
                    'name_user' => $validated['name_user'],
                    'fill_survey' => $answer,
                ]);
            }
            return response()->json(['success' => true, 'message' => 'Survey submitted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error submitting survey: ' . $e->getMessage()], 500);
        };
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\SurveyQuestion;
use Exception;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::all();
        return view('admin.surveys.surveys', [
            'surveys' => $surveys
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|unique:surveys,title',
                'description' => 'required'
            ]);
            Survey::create([
                'title' => $request->title,
                'description' => $request->description
            ]);

            return redirect()->route('admin.layanan')->with('success', 'Create data successful!');
        } catch (Exception $e) {
            return redirect()->route('admin.layanan')->with('error', $e->getMessage());
        }
    }

    public function edit(Survey $survey){
        try {
            return view('admin.surveys.edit', [
                'survey' => $survey
            ]);
        } catch (Exception $e) {
            return redirect()->route('admin.layanan')->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, Survey $survey){
        try {
            $request->validate([
                'title' => 'required|unique:surveys,title,'.$survey->id,
                'description' => 'required'
            ]);

            $survey->update([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status
            ]);

            return redirect()->route('admin.layanan')->with('success', 'Update data successful!');
        } catch (Exception $e) {
            return redirect()->route('admin.layanan')->with('error', $e->getMessage());
        }        
    }

    public function delete(Survey $survey){
        try {
            $survey->delete();

            return redirect()->route('admin.layanan')->with('success', 'Delete data successful!');
        } catch (Exception $e) {
            return redirect()->route('admin.layanan')->with('error', $e->getMessage());
        }
    }
}

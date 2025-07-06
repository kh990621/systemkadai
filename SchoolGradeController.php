<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\SchoolGrade;

class SchoolGradeController extends Controller
{
    public function create($studentId)
    {
        $student = Student::findOrFail($studentId);
        return view('grade_register', compact('student'));
    }

    public function store(Request $request, $studentId)
    {
        $validated = $request->validate([
            'grade' => 'required|integer',
            'term' => 'required|integer',
            'japanese' => 'required|integer',
            'math' => 'required|integer',
            'science' => 'required|integer',
            'social_studies' => 'required|integer',
            'music' => 'required|integer',
            'home_economics' => 'required|integer',
            'english' => 'required|integer',
            'art' => 'required|integer',
            'health_and_physical_education' => 'required|integer',
        ]);

        $validated['student_id'] = $studentId;

        SchoolGrade::create($validated);

        return redirect()->route('students.show', $studentId)->with('success', '成績を登録しました');
    }

    public function edit($id)
    {
    $grade = \App\Models\SchoolGrade::findOrFail($id);
    return view('school_grades_edit', compact('grade'));
    }
    

    public function update(Request $request, $id)
    {
    $validated = $request->validate([
        'grade' => 'required|integer',
        'term' => 'required|integer',
        'japanese' => 'required|integer',
        'math' => 'required|integer',
        'science' => 'required|integer',
        'social_studies' => 'required|integer',
        'music' => 'required|integer',
        'home_economics' => 'required|integer',
        'english' => 'required|integer',
        'art' => 'required|integer',
        'health_and_physical_education' => 'required|integer',
    ]);

    $grade = \App\Models\SchoolGrade::findOrFail($id);
    $grade->update($validated);

    return redirect()->route('students.show', $grade->student_id)
        ->with('success', '成績を更新しました');
    }

}
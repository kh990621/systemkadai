<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\SchoolGrade;

/**
 * 成績登録・編集用コントローラ
 */
class SchoolGradeController extends Controller
{
    /**
     * 成績登録フォーム表示
     *
     * @param int $studentId
     */
    public function create($studentId)
    {
        // 学生情報を取得
        $student = Student::findOrFail($studentId);

        // 成績登録画面を表示
        return view('grade_register', compact('student'));
    }

    /**
     * 成績登録処理
     *
     * @param Request $request
     * @param int $studentId
     */
    public function store(Request $request, $studentId)
    {
        // バリデーション
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

        // 学生IDをセット
        $validated['student_id'] = $studentId;

        // 成績を保存
        SchoolGrade::create($validated);

        // 詳細画面にリダイレクト
        return redirect()->route('students.show', $studentId)
            ->with('success', '成績を登録しました');
    }

    /**
     * 成績編集フォーム表示
     *
     * @param int $id
     */
    public function edit($id)
    {
        // 成績を取得
        $grade = SchoolGrade::findOrFail($id);

        // 編集画面を表示
        return view('school_grades_edit', compact('grade'));
    }

    /**
     * 成績更新処理
     *
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, $id)
    {
        // バリデーション
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

        // 成績を取得
        $grade = SchoolGrade::findOrFail($id);

        // 更新処理
        $grade->update($validated);

        // 詳細画面にリダイレクト
        return redirect()->route('students.show', $grade->student_id)
            ->with('success', '成績を更新しました');
    }
}

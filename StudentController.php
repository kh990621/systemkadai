<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

/**
 * 学生管理コントローラ
 * 学生の登録・編集・削除・成績取得を担当
 */
class StudentController extends Controller
{
    /**
     * 学生登録画面表示
     */
    public function create()
    {
        return view('student_register');
    }

    /**
     * 学生登録処理
     */
    public function store(Request $request)
    {
        // 入力バリデーション
        $validated = $request->validate([
            'grade' => 'required|string|max:10',
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'img_path' => 'nullable|image|max:2048',
        ]);

        // 画像がある場合は保存
        if ($request->hasFile('img_path')) {
            $path = $request->file('img_path')->store('images', 'public');
            $validated['img_path'] = $path;
        }

        // データ登録
        Student::create($validated);

        return redirect()->route('menu')->with('success', '学生が登録されました');
    }

    /**
     * 学生一覧表示 + 検索 + ソート
     */
    public function index(Request $request)
    {
        $query = Student::query();

        // 学年で絞り込み
        if ($request->filled('grade')) {
            $query->where('grade', $request->grade);
        }

        // 名前で絞り込み
        if ($request->filled('name')) {
            $query->where('name', 'LIKE', "%{$request->name}%");
        }

        // ソート（昇順・降順）
        $sortOrder = $request->get('sort', 'asc');
        $query->orderBy('grade', $sortOrder);

        $students = $query->get();

        // AjaxリクエストならJSON返却
        if ($request->ajax()) {
            return response()->json($students);
        }

        return view('students', compact('students'));
    }

    /**
     * 学生詳細表示 + 成績絞り込み
     */
    public function show($id, Request $request)
    {
        $student = Student::findOrFail($id);

        // 成績クエリ
        $gradesQuery = $student->schoolGrades();

        if ($request->filled('grade')) {
            $gradesQuery->where('grade', $request->grade);
        }

        if ($request->filled('term')) {
            $gradesQuery->where('term', $request->term);
        }

        // 最新の成績1件取得
        $grades = $gradesQuery->orderBy('id', 'desc')->first();

        return view('student_show', compact('student', 'grades'));
    }

    /**
     * 学生編集画面表示
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('student_edit', compact('student'));
    }

    /**
     * 学生情報更新処理
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        // 入力バリデーション
        $validated = $request->validate([
            'grade' => 'required|string|max:10',
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'comment' => 'nullable|string|max:500',
        ]);

        $student->update($validated);

        return redirect()->route('students.show', $student->id)
            ->with('success', '学生情報を更新しました。');
    }

    /**
     * 学生削除処理
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', '学生を削除しました');
    }

    /**
     * 全学生の学年繰り上げ処理
     */
    public function gradeUp()
    {
        Student::query()->update([
            'grade' => \DB::raw('grade + 1')
        ]);

        return redirect()->route('menu')
            ->with('success', '全学生の学年を繰り上げました。');
    }

    /**
     * Ajax用 成績情報取得
     */
    public function getGrades($id, Request $request)
    {
        $student = Student::findOrFail($id);

        $gradesQuery = $student->schoolGrades();

        if ($request->filled('grade')) {
            $gradesQuery->where('grade', $request->grade);
        }

        if ($request->filled('term')) {
            $gradesQuery->where('term', $request->term);
        }

        $grades = $gradesQuery->orderBy('id', 'desc')->first();

        return response()->json($grades);
    }
}

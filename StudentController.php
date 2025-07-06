<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    // 登録画面表示
    public function create()
{
    return view('student_register'); // ← フォルダ名 + ファイル名（.blade.phpは不要）
}


    // 登録処理
    public function store(Request $request)
    {
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

        Student::create($validated);

        return redirect()->route('menu')->with('success', '学生が登録されました');
    }

    public function index(Request $request)
    {
        $query = Student::query();

        // 学年での絞り込み
        if ($request->filled('grade')) {
            $query->where('grade', $request->grade);
        }

           // 名前での絞り込み
    if ($request->filled('name')) {
        $query->where('name', 'LIKE', "%{$request->name}%");
    }

        $students = $query->orderBy('grade')->get();

        return view('students', compact('students'));
    }

    
    public function show($id)
{
    $student = Student::findOrFail($id);
    $grades = $student->schoolGrades()->orderBy('id', 'desc')->first();

    return view('student_show', compact('student', 'grades'));
}
    
public function edit($id)
{
    $student = Student::findOrFail($id);
    return view('student_edit', compact('student'));
}

public function update(Request $request, $id)
{
    $student = Student::findOrFail($id);

    $validated = $request->validate([
        'grade' => 'required|string|max:10',
        'name' => 'required|string|max:255',
        'address' => 'nullable|string|max:255',
        'comment' => 'nullable|string|max:500',
    ]);

    $student->update($validated);

    return redirect()->route('students.show', $student->id)->with('success', '学生情報を更新しました。');
}



public function destroy($id)
{
    $student = \App\Models\Student::findOrFail($id);
    $student->delete();

    return redirect()->route('students.index')->with('success', '学生を削除しました');
}



public function gradeUp()
{
    // 全学生の grade を繰り上げ
    Student::query()->update([
                'grade' => \DB::raw('grade + 1')
    ]);

    return redirect()->route('menu')->with('success', '全学生の学年を繰り上げました。');
}



}

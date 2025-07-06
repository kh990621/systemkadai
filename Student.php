<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Studentモデル
 * 
 * 学生情報を管理
 */
class Student extends Model
{
    /**
     * 一括代入可能な属性
     */
    protected $fillable = [
        'grade',       // 学年
        'name',        // 名前
        'address',     // 住所
        'img_path',    // 顔写真のパス
    ];

    /**
     * 学生と成績のリレーション
     * 
     * 1人の学生は複数の成績を持つ
     * 
     * 使用例:
     *   $student->schoolGrades
     */
    public function schoolGrades()
    {
        return $this->hasMany(\App\Models\SchoolGrade::class, 'student_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * SchoolGradeモデル
 * 
 * 学生の成績データを管理
 */
class SchoolGrade extends Model
{
    /**
     * 一括代入可能な属性
     */
    protected $fillable = [
        'student_id',                       // 学生ID（外部キー）
        'grade',                            // 学年
        'term',                             // 学期
        'japanese',                         // 国語
        'math',                             // 数学
        'science',                          // 理科
        'social_studies',                   // 社会
        'music',                            // 音楽
        'home_economics',                   // 家庭科
        'english',                          // 英語
        'art',                              // 美術
        'health_and_physical_education',    // 保健体育
    ];

    /**
     * タイムスタンプ無効化
     * created_at, updated_atを使わない
     */
    public $timestamps = false;

    /**
     * 学生とのリレーション
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

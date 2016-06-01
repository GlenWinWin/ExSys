<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
  protected $fillable = [
    'exam_name',
    'exam_time_limit',
    'prof_id',
    'group_id',
  ];

  public $timestamps = false;

  protected $table = 'exams';
}

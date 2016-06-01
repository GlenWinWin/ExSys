<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
  protected $fillable = [
    'exam_id',
    'question',
    'answers',
    'a',
    'b',
    'c',
    'd',
    'type_of_question'
  ];

  public $timestamps = false;

  protected $table = 'questions';
}

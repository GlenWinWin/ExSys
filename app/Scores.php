<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scores extends Model
{
  protected $fillable = [
    'exam_id',
    'user_id',
    'score',
    'total'
  ];

  public $timestamps = false;

  protected $table = 'scores';
}

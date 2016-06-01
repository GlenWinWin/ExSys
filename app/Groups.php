<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
  protected $fillable = [
    'group_name',
    'group_passCode',
    'prof_id',
  ];

  public $timestamps = false;

  protected $table = 'groups';
}

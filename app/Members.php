<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
  protected $fillable = [
    'group_id',
    'user_id',
    'typeOfUser'
  ];

  public $timestamps = false;

  protected $table = 'group_members';
}

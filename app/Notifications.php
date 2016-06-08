<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;

use Auth;

class Notifications extends Model
{
  protected $fillable = [
    'user_id',
    'has_read',
    'fromUser',
    'notif_message'
  ];

  public $timestamps = false;

  protected $table = 'notifications';
}

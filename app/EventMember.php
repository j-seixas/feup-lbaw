<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventMember extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  protected $primaryKey = 'id';

  protected $table = 'event_member';
}

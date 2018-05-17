<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  protected $primaryKey = 'id';

  protected $table = 'event';

  /**
   * The user this event belongs to
   */
  public function member() {
    return $this->belongsTo('App\Member');
  }

  /**
   * Comments inside this event
   */
  public function comments() {
    return $this->hasMany('App\Comment', 'id_event');
  }
}

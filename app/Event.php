<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  /**
   * The user this card belongs to
   */
  public function user() {
    return $this->belongsTo('App\Member');
  }

  /**
   * Items inside this card
   */
  public function items() {
    return $this->hasMany('App\Comments');
  }
}

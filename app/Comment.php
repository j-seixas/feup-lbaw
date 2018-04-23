<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  /**
   * The event this comment belongs to.
   */
  public function comment() {
    return $this->belongsTo('App\Event');
  }
}

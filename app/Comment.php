<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  /**
   * The comment this item belongs to.
   */
  public function comment() {
    return $this->belongsTo('App\Event');
  }
}

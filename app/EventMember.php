<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventMember extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  protected $primaryKey = 'id_event';

  protected $table = 'event_member';

  /**
   * The user this card belongs to
   */
  public function member() {
    return $this->belongsTo('App\Member');
  }

  /**
   * Items inside this card
   */
  public function items() {
    return $this->hasMany('App\Comments');
  }
}

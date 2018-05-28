<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $primaryKey = 'id';

    protected $table = 'friend';

    /**
     * The user this event belongs to
     */
    public function member() {
        return $this->belongsTo('App\Member', 'id_member');
    }

    public function friend() {
        return $this->belongsTo('App\Member', 'id_friend');
    }
}
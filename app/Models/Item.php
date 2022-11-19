<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  /**
   * The post this item belongs to.
   */
  public function post() {
    return $this->belongsTo('App\Models\Post');
  }
}

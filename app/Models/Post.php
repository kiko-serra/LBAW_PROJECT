<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  protected $primaryKey = 'id_post';

  protected $table = 'post';

  /**
   * The user this card belongs to
   */
  public function user() {
    return $this->belongsTo('App\Models\User');
  }
}

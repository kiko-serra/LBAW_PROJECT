<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $primaryKey = 'account2_id';

    protected $table = 'friendship';

     /**
   * The user that sent the request
   */
  public function user_sent() {
    return $this->account1_id;
  }

   /**
   * The user that received the request
   */
  public function user_received() {
    return $this->account2_id;
  }

}

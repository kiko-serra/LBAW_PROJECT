<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Account as Authenticatable;

class Account extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_account';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ // Campos a usar na funcao create //TODO: this
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The posts this user owns.
     */
    public function posts() {
      return $this->hasMany('App\Models\Post');
    }

    /**
     * The communities this user owns.
     */
    public function communities() {
        return $this->hasMany('App\Models\Community');
    }

    /**
     * The account reports this user owns.
     */
    public function accountReports() {
        return $this->hasMany('App\Models\AccountReport');
    }

    /**
     * The post reports this user owns.
     */
    public function postReports() {
        return $this->hasMany('App\Models\PostReport');
    }

    /**
     * The friendRequests this user owns.
     */
    public function friendRequests() {
        return $this->hasMany('App\Models\FriendRequest');
    }

    /**
     * The notifications this user owns.
     */
    public function notifications() {
        return $this->hasMany('App\Models\Notification');
    }

    /**
     * The recovery code this user owns.
     */
    public function recoveryCode() {
        return $this->hasOne('App\Models\RecoveryCode');
    }

    /**
     * The relationships this user owns.
     */
    public function relationships() { // related to communities
        return $this->hasMany('App\Models\Relationship');
    }

    /**
     * The posts promoted by this user.
     */
    public function promotedPosts() {
        return $this->hasMany('App\Models\PostPromotion');
    }

    /**
     * The posts reacted by this user.
     */
    public function reactedPosts() {
        return $this->hasMany('App\Models\PostReaction');
    }

    /**
     * The friendships this user owns.
     */
    public function friends() { 
        return $this->hasMany('App\Models\Friendship');
    }

}

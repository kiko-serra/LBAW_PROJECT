<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Pivot;

class Relationship extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}

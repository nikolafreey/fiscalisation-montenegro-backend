<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Djelatnost extends Model
{
    protected $table = "djelatnosti";

    protected $fillable = array('naziv');
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategorija extends Model
{
    protected $table = "kategorije";

    protected $fillable = array('naziv');
}

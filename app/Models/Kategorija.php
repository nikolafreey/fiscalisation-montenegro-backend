<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Node\Expr\FuncCall;

class Kategorija extends Model
{
    use SoftDeletes;

    protected $table = "kategorije";

    protected $fillable = array('naziv');

    public function preduzeca()
    {
        return $this->hasMany('App\Models\Preduzece');
    }
}

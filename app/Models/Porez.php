<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Porez extends Model
{
    use HasFactory;

    protected $table = 'porezi';

    protected $fillable = [
        'naziv',
        'stopa'
    ];
}

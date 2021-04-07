<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use HasFactory;

    protected $table = "pozivnice";

    protected $fillable = [
        'email',
        'route',
        'token',
        'racun_id'
    ];
}

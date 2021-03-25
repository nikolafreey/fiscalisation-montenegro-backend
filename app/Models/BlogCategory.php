<?php

namespace App\Models;

use App\Traits\ImaAktivnost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory, ImaAktivnost;

    protected $naziv = 'naziv';

    protected $fillable = [
        'naziv'
    ];
}

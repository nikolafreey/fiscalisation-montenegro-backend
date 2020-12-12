<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DozvolaTipKorisnika extends Model
{
    use HasFactory;

    protected $table = 'dozvole_tip_korisnika';

    protected $fillable = [
        'tip_korisnika_id',
        'model',
        'can_read',
        'can_create',
        'can_edit',
        'can_delete',
    ];

    public function tip_korisnika()
    {
        return $this->belongsTo('App\Models\TipKorisnika', 'tip_korisnika_id');
    }
}

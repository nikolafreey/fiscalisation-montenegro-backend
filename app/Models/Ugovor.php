<?php

namespace App\Models;

use App\Traits\ImaAktivnost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ugovor extends Model
{
    use HasFactory, ImaAktivnost;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UserScope);
    }

    protected $naziv = 'naziv';

    protected $table = 'ugovori';

    protected $fillable = [
        'naziv',
        'file'
    ];

    public function setFileAttribute($value)
    {
        return $this->attributes['file'] = Storage::disk('public')->putFile('ugovori', $value);
    }
}

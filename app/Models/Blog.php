<?php

namespace App\Models;

use App\Services\ContentDomService;
use App\Traits\ImaAktivnost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class Blog extends Model
{
    use HasFactory, ImaAktivnost;

    protected $table = 'blogovi';

    protected $naziv = 'naziv';

    protected $fillable = [
        'naziv',
        'slika',
        'tekst',
        'blog_category_id'
    ];

    public function categories()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function setSlikaAttribute($value)
    {
        if ( !file_exists('public/blogs/')) {
            File::makeDirectory('public/blogs/', $mode = 0777, true, true);
        }

        $oldImage = str_replace(config('app.url'). '/storage', 'public', $value);

        $newImage = str_replace(config('app.url'). '/storage/temp/', 'public/blogs/', $value);

        Storage::move($oldImage, $newImage);

        ImageOptimizer::optimize(storage_path('app/' . $newImage));

        $this->attributes['slika'] = $newImage;
    }

    public function setTekstAttribute($value)
    {
        $newImage = ContentDomService::uploadTemporaryImages($value, 'blogs/tekst/');

        $image = str_replace("/public", "", $newImage);

        $this->attributes['tekst'] = $image;
    }
}

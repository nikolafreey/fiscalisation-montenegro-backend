<?php

namespace App\Services;

use App\Jobs\OptimizeImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

/**
 * Upload temporary images to specified folders and
 * replace src attribute
 */
class ContentDomService
{
    public static function uploadTemporaryImages($content, $dir)
    {
        if (! $content) {
            return;
        }

        $dom = new \DOMDocument();
        $dom->encoding = 'utf-8';

        libxml_use_internal_errors(true);

        $dom->loadHTML(
            mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'),
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );

        foreach ($dom->getElementsByTagName('img') as $image) {
            $path = $image->getAttribute('src');

            $pathArray = explode('/', $path);

            // skip if the image is not in the 'temp' folder
            if (! in_array('temp', $pathArray, true)) {
                continue;
            }

            $newImagePath = self::moveAndOptimizeImage($dir, $path);

            $image->removeAttribute('src');
            $image->setAttribute('src', config('app.url') . '/storage/' . $newImagePath);
        }

        return $dom->saveHTML();
    }

    public static function moveAndOptimizeImage($dir, $value)
    {
        if ( !file_exists($dir)) {
            File::makeDirectory($dir, $mode = 0777, true, true);
        }

        $oldImage = str_replace(config('app.url'). '/storage', 'public', $value);

        $newImage = str_replace(config('app.url'). '/storage/temp/', 'public/blogs/tekst/', $value);

        Storage::move($oldImage, $newImage);

        ImageOptimizer::optimize(storage_path('app/' . $newImage));

        return $newImage;
    }

    private static function move($pathArray, $dir)
    {
        $imageName = array_values(array_slice($pathArray, -1))[0];

        $temporaryImage = 'public/temp/' . $imageName;
        $permanentImage = $dir . '/' . $imageName;

        Storage::move($temporaryImage, 'public/' . $permanentImage);
        OptimizeImage::dispatch(public_path(Storage::url('public/' . $permanentImage)))->delay(5);

        return $permanentImage;
    }

    private static function upload($path, $dir)
    {
        $data = substr($path, strpos($path, ',') + 1);
        $data = base64_decode($data);
        $imageName = uniqid() . '.png';

        $folder = 'public/' . $dir;
        if (! Storage::exists($folder)) {
            Storage::makeDirectory($folder);
        }

        $imageName = $folder . '/' . uniqid();

        Storage::put($imageName, $data);
        OptimizeImage::dispatch(public_path(Storage::url($imageName)))->delay(5);

        return str_replace('public/', '', $imageName);
    }

    /**
     * Copy original images to /temp folder and use them in cloned object content
     * @param  string $content Content to be manipulated
     * @return string          Content
     */
    public static function cloneOriginalImages($content)
    {
        preg_match_all('/<img(.*?)src=("|\'|)(.*?)("|\'| )(.*?)>/s', $content, $images);

        $tempImages = [];
        foreach ($images[3] ?? [] as $image) {
            $image = absoluteToStoragePath($image);
            $newImage = 'public/temp/' . Str::random('4') . basename($image);
            Storage::copy($image, $newImage);
            $tempImages[] = file_path($newImage);
        }
        $newContent = str_replace($images[3], $tempImages, $content);

        return $newContent;
    }
}

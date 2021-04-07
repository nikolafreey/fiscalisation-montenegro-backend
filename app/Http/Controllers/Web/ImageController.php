<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\FileService;

class ImageController extends Controller
{
    /**
     * @var FileService
     */
    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function store(Request $request)
    {
        $image = $this->fileService->upload(
            $request->image,
            'temp',
            $request->name ?? ''
        );
        return response()->json(
            config('app.url') . '/' . str_replace('public', 'storage', $image)
        );
    }
}

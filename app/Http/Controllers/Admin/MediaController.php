<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Intervention\Image\ImageManagerStatic as Image;

class MediaController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }

        $mime = $request->file->getMimeType();

        if ($mime === 'image/svg+xml' || $mime === 'image/svg') {
            $extension = 'svg';
        } else {
            $extension = $request->file->extension();
        }

        if (! $extension) {
            return response()->json([
                'message' => __('This file format is not supported.'),
            ], Response::HTTP_BAD_REQUEST);
        }

        $title = $request->file->getClientOriginalName();
        $title = pathinfo($title, PATHINFO_FILENAME);
        $title = Str::slug($title);

        $folder = time().uniqid();

        $fileUrl = Storage::putFileAs('public/'. $folder, request('file'), $title.'.'.$extension);

        $fileUrl = '/storage/' . $folder . '/' . $title.'.'.$extension;

        $sizes = null;

        if ($extension !== 'svg') {
            $sizes = $this->generateSizes($folder, $request->file, $title, $extension);
        }

        return [
            'title' => $title,
            'source' => $fileUrl,
            'type' => $mime,
            'extension' => $extension,
            'sizes' => $sizes,
        ];
    }

    protected function generateSizes($folder, $image, $title, $extension)
    {
        $sizes = [
            'small' => 500,
            'medium' => 1080,
            'large' => 1920,
        ];

        $out = [];

        foreach ($sizes as $key => $size) {
            $out[$key] = $this->createImage($folder, $image, $title, $extension, $size);
        }

        return $out;
    }

    protected function createImage($folder, $image, $name, $extension, $size)
    {
        $name = $name . '-' . $size . 'px' . '.' . $extension;

        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize($size, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $path = base_path() . '/storage/app/public/' . $folder .  '/' . $name;
        $image_resize->save($path);

        return [
            'url' => '/storage/' . $folder .  '/' . $name,
            'width' => $image_resize->width(),
            'height' => $image_resize->height(),
        ];
    }
}

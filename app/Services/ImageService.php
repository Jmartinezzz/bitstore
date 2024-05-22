<?php
namespace App\Services;

use Illuminate\Support\Facades\File;

class ImageService
{
    public function uploadImage($file, $path)
    {
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($path), $filename);
        return $filename;
    }

    public function deleteImage($imagePath)
    {
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
    }

}
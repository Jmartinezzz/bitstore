<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function uploadImage($file, $path)
    {
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('avatares', $filename, 'public');
        return $filename;
    }

    public function deleteImage($imagePath)
    {
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }

}
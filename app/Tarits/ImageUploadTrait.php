<?php

namespace App\Tarits;

use Illuminate\Http\UploadedFile;

trait ImageUploadTrait
{
    public function uploadImage(UploadedFile $file, $directory = 'uploads')
    {
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($directory), $filename);

        return $directory . '/' . $filename; // Returns the file path
    }
}

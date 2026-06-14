<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\File as LaravelFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\ValidationException;
use App\Tarits\ImageUploadTrait;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    use ImageUploadTrait;

    public function model(array $row)
    {
        if (empty($row['title']) || empty($row['image_urls'])) {
            throw ValidationException::withMessages([
                'image_urls' => 'Image URLs are required for product: ' . ($row['title'] ?? '[unknown title]')
            ]);
        }

        $product = Product::create([
            'category_id' => $row['category_id'],
            'sku' => $row['sku'],
            'title' => $row['title'],
            'slug' => $this->generateUniqueSlug($row['slug'] ?? Str::slug($row['title'])),
            'content' => $row['content'],
            'meta_tags' => $row['meta_tags'],
            'order' => $row['order'] ?? 0,
        ]);

        $imageUrls = explode(';', $row['image_urls']);
        $savedImageCount = 0;

        foreach ($imageUrls as $index => $url) {
            $url = trim($url);
            if (!$url) continue;

            try {
                // Download image to temporary file
                $tempPath = tempnam(sys_get_temp_dir(), 'img');
                file_put_contents($tempPath, file_get_contents($url));

                // Create UploadedFile instance
                $tempFile = new UploadedFile(
                    $tempPath,
                    basename(parse_url($url, PHP_URL_PATH)),
                    null,
                    null,
                    true // $testMode = true
                );

                // Use your trait's method
                $imagePath = $this->uploadImage($tempFile, 'uploads/products');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $imagePath,
                    'image_order' => $index + 1,
                ]);

                $savedImageCount++;
            } catch (\Exception $e) {
                continue;
            }
        }

        if ($savedImageCount === 0) {
            $product->delete();
            throw ValidationException::withMessages([
                'image_urls' => 'No valid images were saved for product: ' . $row['title']
            ]);
        }

        return $product;
    }

    private function generateUniqueSlug($baseSlug)
    {
        $slug = $baseSlug;
        $counter = 1;

        while (\App\Models\Product::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}

<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageCompressionService
{
    /**
     * Compress an image file to target size
     * 
     * @param string $path Path relative to storage disk
     * @param string $disk Storage disk name
     * @param int $maxSizeKb Maximum file size in KB
     * @return bool Success status
     */
    public static function compress(string $path, string $disk = 'public', int $maxSizeKb = 500): bool
    {
        try {
            $fullPath = Storage::disk($disk)->path($path);
            
            if (!file_exists($fullPath)) {
                return false;
            }

            // Try Imagick first (better quality)
            if (extension_loaded('imagick') && class_exists('Imagick')) {
                return self::compressWithImagick($fullPath, $maxSizeKb);
            }
            
            // Fallback to GD
            if (extension_loaded('gd')) {
                return self::compressWithGd($fullPath, $maxSizeKb);
            }
            
            return false;
        } catch (\Exception $e) {
            \Log::error('Image compression failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Compress image using Imagick
     */
    private static function compressWithImagick(string $path, int $maxSizeKb): bool
    {
        try {
            $imagick = new \Imagick($path);
            $imagick->setImageFormat('jpeg');
            
            // Start with quality 85
            $quality = 85;
            $imagick->setImageCompressionQuality($quality);
            $imagick->writeImage($path);
            
            // Reduce quality until size is acceptable
            while (filesize($path) > ($maxSizeKb * 1024) && $quality > 30) {
                $quality -= 10;
                $imagick->setImageCompressionQuality($quality);
                $imagick->writeImage($path);
            }
            
            // If still too large, resize image
            if (filesize($path) > ($maxSizeKb * 1024)) {
                $imagick->resizeImage(1200, 0, \Imagick::FILTER_LANCZOS, 1);
                $imagick->setImageCompressionQuality(70);
                $imagick->writeImage($path);
            }
            
            $imagick->destroy();
            return true;
        } catch (\Exception $e) {
            \Log::error('Imagick compression failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Compress image using GD
     */
    private static function compressWithGd(string $path, int $maxSizeKb): bool
    {
        try {
            $info = getimagesize($path);
            if (!$info) {
                return false;
            }

            // Create image resource
            $image = match ($info[2]) {
                IMAGETYPE_JPEG => imagecreatefromjpeg($path),
                IMAGETYPE_PNG => imagecreatefrompng($path),
                IMAGETYPE_WEBP => imagecreatefromwebp($path),
                default => null
            };

            if (!$image) {
                return false;
            }

            // Start with quality 85
            $quality = 85;
            imagejpeg($image, $path, $quality);
            
            // Reduce quality until size is acceptable
            while (filesize($path) > ($maxSizeKb * 1024) && $quality > 30) {
                $quality -= 10;
                imagejpeg($image, $path, $quality);
            }
            
            // If still too large, resize
            if (filesize($path) > ($maxSizeKb * 1024)) {
                $width = imagesx($image);
                $height = imagesy($image);
                $newWidth = 1200;
                $newHeight = (int) ($height * ($newWidth / $width));
                
                $resized = imagecreatetruecolor($newWidth, $newHeight);
                imagecopyresampled($resized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                
                imagejpeg($resized, $path, 70);
                imagedestroy($resized);
            }
            
            imagedestroy($image);
            return true;
        } catch (\Exception $e) {
            \Log::error('GD compression failed: ' . $e->getMessage());
            return false;
        }
    }
}

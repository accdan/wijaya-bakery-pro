<?php

namespace App\Helpers;

class ImageOptimizer
{
    /**
     * Compress and resize image
     * 
     * @param string $sourcePath Full path to source image
     * @param string $destinationPath Full path to save compressed image
     * @param int $maxWidth Maximum width (default 800px)
     * @param int $quality JPEG quality 0-100 (default 80)
     * @return bool
     */
    public static function compress($sourcePath, $destinationPath, $maxWidth = 800, $quality = 80)
    {
        // Get image info
        $imageInfo = getimagesize($sourcePath);
        if (!$imageInfo) {
            return false;
        }

        $mimeType = $imageInfo['mime'];
        $originalWidth = $imageInfo[0];
        $originalHeight = $imageInfo[1];

        // Create image resource based on type
        switch ($mimeType) {
            case 'image/jpeg':
                $source = imagecreatefromjpeg($sourcePath);
                break;
            case 'image/png':
                $source = imagecreatefrompng($sourcePath);
                break;
            case 'image/gif':
                $source = imagecreatefromgif($sourcePath);
                break;
            case 'image/webp':
                $source = imagecreatefromwebp($sourcePath);
                break;
            default:
                return false;
        }

        if (!$source) {
            return false;
        }

        // Calculate new dimensions
        // If maxWidth is 0 or null, preserve original dimensions (no resize)
        if ($maxWidth && $maxWidth > 0 && $originalWidth > $maxWidth) {
            $ratio = $maxWidth / $originalWidth;
            $newWidth = $maxWidth;
            $newHeight = (int) ($originalHeight * $ratio);
        } else {
            $newWidth = $originalWidth;
            $newHeight = $originalHeight;
        }

        // Create new image
        $destination = imagecreatetruecolor($newWidth, $newHeight);

        // Preserve transparency for PNG, GIF, and WebP
        if (in_array($mimeType, ['image/png', 'image/gif', 'image/webp'])) {
            // Enable alpha blending
            imagealphablending($destination, false);
            imagesavealpha($destination, true);

            // Fill with transparent background
            $transparent = imagecolorallocatealpha($destination, 0, 0, 0, 127);
            imagefilledrectangle($destination, 0, 0, $newWidth, $newHeight, $transparent);

            // For GIF, also handle the source transparency
            if ($mimeType == 'image/gif') {
                $transparentIndex = imagecolortransparent($source);
                if ($transparentIndex >= 0) {
                    $transparentColor = imagecolorsforindex($source, $transparentIndex);
                    $transparentNew = imagecolorallocate($destination, $transparentColor['red'], $transparentColor['green'], $transparentColor['blue']);
                    imagefill($destination, 0, 0, $transparentNew);
                    imagecolortransparent($destination, $transparentNew);
                }
            }
        }

        // Resize
        imagecopyresampled(
            $destination,
            $source,
            0,
            0,
            0,
            0,
            $newWidth,
            $newHeight,
            $originalWidth,
            $originalHeight
        );

        // Save based on original type
        $result = false;
        switch ($mimeType) {
            case 'image/jpeg':
                $result = imagejpeg($destination, $destinationPath, $quality);
                break;
            case 'image/png':
                // PNG quality is 0-9 (inverse of JPEG)
                $pngQuality = (int) ((100 - $quality) / 10);
                $result = imagepng($destination, $destinationPath, $pngQuality);
                break;
            case 'image/gif':
                $result = imagegif($destination, $destinationPath);
                break;
            case 'image/webp':
                $result = imagewebp($destination, $destinationPath, $quality);
                break;
        }

        // Free memory
        imagedestroy($source);
        imagedestroy($destination);

        return $result;
    }

    /**
     * Process uploaded file - compress and move
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $destinationFolder
     * @param string|null $filename Custom filename (optional)
     * @param int $maxWidth
     * @param int $quality
     * @return string|false Returns filename on success, false on failure
     */
    public static function processUpload($file, $destinationFolder, $filename = null, $maxWidth = 800, $quality = 80)
    {
        // Generate filename if not provided
        if (!$filename) {
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        }

        // Ensure destination folder exists
        if (!file_exists($destinationFolder)) {
            mkdir($destinationFolder, 0755, true);
        }

        $destinationPath = $destinationFolder . DIRECTORY_SEPARATOR . $filename;
        $tempPath = $file->getPathname();

        // Check if image type
        $mimeType = $file->getMimeType();
        $imageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

        if (in_array($mimeType, $imageTypes)) {
            // Compress and save
            $result = self::compress($tempPath, $destinationPath, $maxWidth, $quality);
            if ($result) {
                return $filename;
            }
        }

        // Fallback: just move file without compression
        if ($file->move($destinationFolder, $filename)) {
            return $filename;
        }

        return false;
    }
}

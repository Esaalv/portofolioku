<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

/**
 * CloudinaryUploadHandler Trait
 * 
 * Menyediakan helper method untuk upload file ke Cloudinary dengan
 * error handling dan retry logic yang lebih robust, terutama untuk
 * environment production seperti Azure App Service.
 */
trait CloudinaryUploadHandler
{
    /**
     * Upload file ke Cloudinary dengan retry dan timeout handling
     * 
     * @param UploadedFile $file
     * @param array $options Cloudinary upload options
     * @param int $maxRetries Jumlah retry attempt (default: 3)
     * @return array|false Cloudinary response atau false jika gagal
     */
    protected function uploadToCloudinary(UploadedFile $file, array $options = [], int $maxRetries = 3)
    {
        // Validasi file size sebelum upload
        $maxFileSize = $this->getMaxFileSizeInBytes();
        if ($file->getSize() > $maxFileSize) {
            throw new \Exception("File size ({$file->getSize()} bytes) exceeds maximum ({$maxFileSize} bytes)");
        }

        // Default options
        $defaultOptions = [
            'quality' => 'auto',
            'resource_type' => 'auto',
            'timeout' => 120, // 2 menit timeout
        ];

        $uploadOptions = array_merge($defaultOptions, $options);

        // Retry logic untuk handle temporary network issues
        $lastException = null;
        for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
            try {
                \Log::info("Cloudinary upload attempt {$attempt}/{$maxRetries}", [
                    'filename' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'folder' => $uploadOptions['folder'] ?? 'portfolio'
                ]);

              $uploadedFile = $file->storeOnCloudinary($uploadOptions['folder'] ?? 'portfolio');

                \Log::info("Cloudinary upload successful", [
                    'public_id' => $uploadedFile->getPublicId(),
                    'url' => $uploadedFile->getSecurePath()
                ]);

                return $uploadedFile;
            } catch (\Exception $e) {
                $lastException = $e;
                \Log::warning("Cloudinary upload attempt {$attempt} failed", [
                    'error' => $e->getMessage(),
                    'retry' => $attempt < $maxRetries
                ]);

                // Jangan retry jika validation error
                if ($this->isValidationError($e)) {
                    throw $e;
                }

                // Wait sebelum retry (exponential backoff)
                if ($attempt < $maxRetries) {
                    sleep(2 ** ($attempt - 1)); // 1s, 2s, 4s
                }
            }
        }

        throw new \Exception("Upload gagal setelah {$maxRetries} attempt: " . $lastException->getMessage());
    }

    /**
     * Get maximum file size yang diperbolehkan (dalam bytes)
     * Disesuaikan untuk Azure App Service
     * 
     * @return int
     */
    protected function getMaxFileSizeInBytes(): int
    {
        // Ambil dari php.ini upload_max_filesize
        $uploadMaxFilesize = $this->parseSize(ini_get('upload_max_filesize'));
        
        // Ambil dari php.ini post_max_size
        $postMaxSize = $this->parseSize(ini_get('post_max_size'));
        
        // Gunakan yang lebih kecil, dengan limit 10MB untuk safety di Azure
        $maxSize = min($uploadMaxFilesize, $postMaxSize, 10 * 1024 * 1024);
        
        return $maxSize;
    }

    /**
     * Parse size string (e.g., "10M" -> bytes)
     * 
     * @param string $value
     * @return int
     */
    protected function parseSize(string $value): int
    {
        $value = trim($value);
        $lastChar = strtoupper($value[strlen($value) - 1]);
        $value = (int)$value;

        switch ($lastChar) {
            case 'G':
                $value *= 1024;
            case 'M':
                $value *= 1024;
            case 'K':
                $value *= 1024;
        }

        return $value;
    }

    /**
     * Cek apakah exception adalah validation error
     * 
     * @param \Exception $e
     * @return bool
     */
    protected function isValidationError(\Exception $e): bool
    {
        $message = strtolower($e->getMessage());
        
        return strpos($message, 'invalid') !== false ||
               strpos($message, 'format') !== false ||
               strpos($message, 'type') !== false ||
               strpos($message, 'unsupported') !== false;
    }

    /**
     * Generate unique public_id untuk file
     * 
     * @param string $originalName
     * @return string
     */
    protected function generatePublicId(string $originalName): string
    {
        $timestamp = now()->format('YmdHis');
        $random = \Str::random(8);
        $name = pathinfo($originalName, PATHINFO_FILENAME);
        $name = \Str::slug($name);

        return "{$timestamp}-{$random}-{$name}";
    }
}

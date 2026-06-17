<?php

/**
 * Azure App Service Configuration untuk Upload File
 * 
 * File ini berisi optimasi untuk Azure App Service termasuk:
 * - Timeout handling
 * - Memory optimization
 * - Temporary file handling
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Upload Configuration
    |--------------------------------------------------------------------------
    */
    
    'upload' => [
        // Maximum file size untuk upload (dalam bytes)
        // Default: 10MB
        'max_file_size' => env('UPLOAD_MAX_FILE_SIZE', 10 * 1024 * 1024),

        // Upload timeout di detik (untuk Cloudinary)
        'timeout' => env('UPLOAD_TIMEOUT', 120),

        // Retry attempts untuk upload yang gagal
        'max_retries' => env('UPLOAD_MAX_RETRIES', 3),

        // Backoff strategy untuk retry ('fixed', 'exponential')
        'retry_strategy' => 'exponential',

        // Delay antar retry dalam detik
        'retry_delay' => 1,
    ],

    /*
    |--------------------------------------------------------------------------
    | Cloudinary Configuration untuk Azure
    |--------------------------------------------------------------------------
    */

    'cloudinary' => [
        // Folder structure untuk uploads
        'folders' => [
            'certificates' => 'portfolio/certificates',
            'projects' => 'portfolio/projects',
            'profiles' => 'portfolio/profiles',
        ],

        // Default upload options
        'options' => [
            'quality' => 'auto',
            'format' => 'auto',
            'fetch_format' => 'auto',
        ],

        // Enable HTTPS URLs
        'secure_url' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Azure Specific Settings
    |--------------------------------------------------------------------------
    */

    'azure' => [
        // Enable Azure Storage fallback (jika Cloudinary gagal)
        'use_storage_fallback' => env('AZURE_USE_STORAGE_FALLBACK', false),

        // Azure Storage container untuk fallback
        'storage_container' => 'portfolio-uploads',

        // Timeout untuk Azure Operations (dalam detik)
        'operation_timeout' => 60,
    ],

    /*
    |--------------------------------------------------------------------------
    | Logging
    |--------------------------------------------------------------------------
    */

    'logging' => [
        // Enable detailed logging untuk upload
        'enabled' => env('UPLOAD_LOGGING_ENABLED', true),

        // Log channel
        'channel' => env('LOG_CHANNEL', 'stack'),
    ],
];

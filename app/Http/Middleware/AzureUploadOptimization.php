<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * AzureUploadOptimization Middleware
 * 
 * Middleware untuk optimize request handling khususnya untuk file upload
 * di Azure App Service environment.
 */
class AzureUploadOptimization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika bukan upload request, lanjut
        if (!$this->isUploadRequest($request)) {
            return $next($request);
        }

        // Optimize untuk upload
        $this->optimizeForUpload();

        return $next($request);
    }

    /**
     * Check apakah ini upload request
     */
    private function isUploadRequest(Request $request): bool
    {
        return $request->isMethod('post') && 
               $request->hasFile('image') &&
               in_array($request->getRouteKey() ?? '', [
                   'admin.certificates.store',
                   'admin.certificates.update',
                   'admin.projects.store',
                   'admin.projects.update',
               ]);
    }

    /**
     * Optimize PHP settings untuk upload
     */
    private function optimizeForUpload(): void
    {
        // Set timeout yang lebih panjang untuk upload
        ini_set('default_socket_timeout', 300);
        set_time_limit(300); // 5 menit
        
        // Increase memory untuk upload besar
        if (function_exists('memory_get_usage')) {
            $current = memory_get_usage();
            $max = ini_get('memory_limit');
            
            // Jika memory available < 50MB, naikkan limit
            if ($max !== '-1') { // unlimited tidak perlu diedit
                $maxBytes = $this->parseSize($max);
                $available = $maxBytes - $current;
                
                if ($available < 50 * 1024 * 1024) {
                    ini_set('memory_limit', '256M');
                }
            }
        }
    }

    /**
     * Parse size string (e.g. "128M" -> bytes)
     */
    private function parseSize(string $value): int
    {
        $value = trim($value);
        $lastChar = strtoupper($value[strlen($value) - 1] ?? '');
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
}

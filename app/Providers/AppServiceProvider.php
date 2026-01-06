<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS in production
        if (config('app.env') === 'production') {
            URL::forceScheme('https');

            // Set secure cookies for HTTPS
            config(['session.secure' => true]);
            config(['session.same_site' => 'lax']);
        }

        // Register a global helper for image URLs
        Blade::directive('imageUrl', function ($expression) {
            return "<?php echo \App\Providers\AppServiceProvider::getImageUrl($expression); ?>";
        });
    }

    /**
     * Get image URL - handles Base64 data URLs, full URLs, and local storage paths
     */
    public static function getImageUrl(?string $path): string
    {
        if (empty($path)) {
            return '';
        }

        // If it's a Base64 data URL, return as-is
        if (str_starts_with($path, 'data:')) {
            return $path;
        }

        // If it's already a full URL (Cloudinary or other), return as-is
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        // Otherwise, use Storage URL for local files
        return Storage::url($path);
    }
}

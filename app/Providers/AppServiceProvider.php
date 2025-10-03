<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Fix for Cloudflare Tunnel: Trust all proxies
        $this->configureCloudflareProxies();
        
        // Force HTTPS when behind Cloudflare Tunnel
        $this->forceHttpsScheme();
        
        // Disable Livewire asset URL (prevents signed URL issues with Cloudflare Tunnel)
        config(['livewire.asset_url' => null]);
    }

    /**
     * Configure trusted proxies for Cloudflare Tunnel
     */
    protected function configureCloudflareProxies(): void
    {
        // Trust all proxies (Cloudflare, Nginx, etc.)
        \Illuminate\Http\Request::setTrustedProxies(
            ['*'], // Trust all proxies
            \Illuminate\Http\Request::HEADER_X_FORWARDED_FOR |
            \Illuminate\Http\Request::HEADER_X_FORWARDED_HOST |
            \Illuminate\Http\Request::HEADER_X_FORWARDED_PORT |
            \Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO |
            \Illuminate\Http\Request::HEADER_X_FORWARDED_PREFIX
        );
    }

    /**
     * Force HTTPS scheme when behind proxy
     */
    protected function forceHttpsScheme(): void
    {
        // Check if request comes through HTTPS proxy (Cloudflare Tunnel)
        if (
            (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ||
            (isset($_SERVER['HTTP_CF_VISITOR']) && strpos($_SERVER['HTTP_CF_VISITOR'], 'https') !== false) ||
            (config('app.url') && str_starts_with(config('app.url'), 'https'))
        ) {
            URL::forceScheme('https');
        }
    }
}

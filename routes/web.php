<?php

use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\Api\ContactInfoController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ProgramController;
use App\Http\Controllers\Api\TestimonialController;
use App\Models\Berita;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

if (!function_exists('generate_social_image')) {
    function generate_social_image(string $sourcePath, string $targetPath): bool
    {
        // Try Imagick first (more powerful and modern)
        if (extension_loaded('imagick') && class_exists('Imagick')) {
            try {
                $imagick = new Imagick($sourcePath);
                
                $targetWidth = 1200;
                $targetHeight = 630;
                
                // Get original dimensions
                $width = $imagick->getImageWidth();
                $height = $imagick->getImageHeight();
                
                // Calculate resize ratio
                $ratio = min($targetWidth / $width, $targetHeight / $height, 1);
                $resizedWidth = (int) round($width * $ratio);
                $resizedHeight = (int) round($height * $ratio);
                
                // Create canvas with background
                $canvas = new Imagick();
                $canvas->newImage($targetWidth, $targetHeight, new ImagickPixel('#F0F4F7'));
                $canvas->setImageFormat('jpeg');
                
                // Resize source image
                $imagick->resizeImage($resizedWidth, $resizedHeight, Imagick::FILTER_LANCZOS, 1);
                
                // Center image on canvas
                $dstX = (int) floor(($targetWidth - $resizedWidth) / 2);
                $dstY = (int) floor(($targetHeight - $resizedHeight) / 2);
                
                $canvas->compositeImage($imagick, Imagick::COMPOSITE_OVER, $dstX, $dstY);
                
                // Set quality and save
                $canvas->setImageCompressionQuality(85);
                $canvas->writeImage($targetPath);
                
                $imagick->destroy();
                $canvas->destroy();
                
                return true;
            } catch (Exception $e) {
                // If Imagick fails, fallback to GD
            }
        }
        
        // Fallback to GD if available
        if (!extension_loaded('gd')) {
            return false;
        }

        [$width, $height, $type] = @getimagesize($sourcePath) ?: [0, 0, 0];

        if ($width === 0 || $height === 0) {
            return false;
        }

        $createImage = null;

        if ($type === IMAGETYPE_JPEG) {
            $createImage = 'imagecreatefromjpeg';
        } elseif ($type === IMAGETYPE_PNG) {
            $createImage = 'imagecreatefrompng';
        } elseif (defined('IMAGETYPE_WEBP') && $type === IMAGETYPE_WEBP && function_exists('imagecreatefromwebp')) {
            $createImage = 'imagecreatefromwebp';
        }

        if ($createImage === null || !is_callable($createImage)) {
            return false;
        }

        $src = $createImage($sourcePath);

        if (!$src) {
            return false;
        }

        $targetWidth = 1200;
        $targetHeight = 630;

        $ratio = min($targetWidth / $width, $targetHeight / $height, 1);

        $resizedWidth = (int) round($width * $ratio);
        $resizedHeight = (int) round($height * $ratio);

        $dest = imagecreatetruecolor($targetWidth, $targetHeight);

        if ($type === IMAGETYPE_PNG) {
            imagealphablending($src, true);
        }

        $backgroundColor = imagecolorallocate($dest, 240, 244, 247);
        imagefill($dest, 0, 0, $backgroundColor);

        $dstX = (int) floor(($targetWidth - $resizedWidth) / 2);
        $dstY = (int) floor(($targetHeight - $resizedHeight) / 2);

        imagecopyresampled(
            $dest,
            $src,
            $dstX,
            $dstY,
            0,
            0,
            $resizedWidth,
            $resizedHeight,
            $width,
            $height
        );

        $result = imagejpeg($dest, $targetPath, 85);

        imagedestroy($src);
        imagedestroy($dest);

        return $result;
    }
}



Route::prefix('api')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::get('/galleries', [GalleryController::class, 'index']);
    Route::get('/galleries/{id}', [GalleryController::class, 'show']);
    Route::get('/programs', [ProgramController::class, 'show']);
    Route::get('/v2/programs', [ProgramController::class, 'index']);
    Route::get('/testimonials', [TestimonialController::class, 'show']);
    Route::get('/berita', [BeritaController::class, 'index']);
    Route::get('/berita/{slug}', [BeritaController::class, 'show']);
    Route::get('/contact', [ContactInfoController::class, 'show']);
});

Route::get('/berita/{slug}', function ($slug) {
    $request = request();
    $indexPath = public_path('ui/index.html');

    if (!File::exists($indexPath)) {
        abort(404);
    }

    $html = File::get($indexPath);

    $berita = Berita::where('slug', $slug)->first();

    if (!$berita) {
        return response($html, 200)->header('Content-Type', 'text/html; charset=UTF-8');
    }

    $escape = static fn ($value) => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');

    $configuredUrl = config('app.url');
    if (is_string($configuredUrl) && $configuredUrl !== '') {
        $baseUrl = rtrim($configuredUrl, '/');
    } else {
        $schemeHost = $request->getSchemeAndHttpHost();
        $baseUrl = $schemeHost !== '' ? rtrim($schemeHost, '/') : rtrim(url('/'), '/');
    }

    $articleUrl = $baseUrl . $request->getRequestUri();

    $rawDescription = strip_tags($berita->konten ?? '');
    $normalized = trim(preg_replace('/\s+/', ' ', $rawDescription));
    $description = $normalized !== ''
        ? Str::limit($normalized, 160, '...')
        : 'Baca berita terkini dari Pondok Pesantren Jauharul Falah Al-Islamy.';

    $imageUrl = $berita->thumbnail
        ? route('social-image', ['slug' => $berita->slug])
        : asset('ui/images/logo.png');

    $title = $berita->judul . ' | Pondok Pesantren Jauharul Falah Al-Islamy';

    $escapedTitle = $escape($title);
    $escapedDescription = $escape($description);
    $escapedArticleUrl = $escape($articleUrl);
    $escapedImageUrl = $escape($imageUrl);
    $escapedImageAlt = $escape($berita->judul);

    $html = preg_replace('/<title>.*?<\/title>/s', '<title>' . $escapedTitle . '</title>', $html, 1);
    $html = preg_replace(
        '/<meta name="description" content=".*?" \/>/',
        '<meta name="description" content="' . $escapedDescription . '" />',
        $html,
        1
    );

    $html = preg_replace(
        '/<meta property="og:title" content=".*?" \/>/',
        '<meta property="og:title" content="' . $escapedTitle . '" />',
        $html,
        1
    );

    $html = preg_replace(
        '/<meta property="og:description" content=".*?" \/>/',
        '<meta property="og:description" content="' . $escapedDescription . '" />',
        $html,
        1
    );

    $html = preg_replace(
        '/<meta property="og:type" content=".*?" \/>/',
        '<meta property="og:type" content="article" />',
        $html,
        1
    );

    $ogExtras = <<<HTML
    <meta property="og:url" content="{$escapedArticleUrl}" />
    <meta property="og:image" content="{$escapedImageUrl}" />
    <meta property="og:image:alt" content="{$escapedImageAlt}" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
HTML;

    if (strpos($html, 'property="og:url"') !== false) {
        $html = preg_replace(
            '/<meta property="og:url" content=".*?" \/>/',
            '<meta property="og:url" content="' . $escapedArticleUrl . '" />',
            $html
        );
    } else {
        $html = str_replace('<meta property="og:type" content="article" />', '<meta property="og:type" content="article" />' . "\n" . $ogExtras, $html);
    }

    if (strpos($html, 'property="og:image"') !== false) {
        $html = preg_replace(
            '/<meta property="og:image" content=".*?" \/>/',
            '<meta property="og:image" content="' . $escapedImageUrl . '" />',
            $html
        );
    }

    if (strpos($html, 'property="og:image:alt"') !== false) {
        $html = preg_replace(
            '/<meta property="og:image:alt" content=".*?" \/>/',
            '<meta property="og:image:alt" content="' . $escapedImageAlt . '" />',
            $html
        );
    }

    $twitterExtras = <<<HTML
    <meta name="twitter:title" content="{$escapedTitle}" />
    <meta name="twitter:description" content="{$escapedDescription}" />
    <meta name="twitter:image" content="{$escapedImageUrl}" />
    <meta name="twitter:image:alt" content="{$escapedImageAlt}" />
HTML;

    if (strpos($html, 'name="twitter:title"') !== false) {
        $html = preg_replace(
            '/<meta name="twitter:title" content=".*?" \/>/',
            '<meta name="twitter:title" content="' . $escapedTitle . '" />',
            $html
        );
    } else {
        $html = str_replace('<meta name="twitter:card" content="summary_large_image" />', '<meta name="twitter:card" content="summary_large_image" />' . "\n" . $twitterExtras, $html);
    }

    if (strpos($html, 'name="twitter:description"') !== false) {
        $html = preg_replace(
            '/<meta name="twitter:description" content=".*?" \/>/',
            '<meta name="twitter:description" content="' . $escapedDescription . '" />',
            $html
        );
    }

    if (strpos($html, 'name="twitter:image"') !== false) {
        $html = preg_replace(
            '/<meta name="twitter:image" content=".*?" \/>/',
            '<meta name="twitter:image" content="' . $escapedImageUrl . '" />',
            $html
        );
    }

    if (strpos($html, 'name="twitter:image:alt"') !== false) {
        $html = preg_replace(
            '/<meta name="twitter:image:alt" content=".*?" \/>/',
            '<meta name="twitter:image:alt" content="' . $escapedImageAlt . '" />',
            $html
        );
    }

    if (strpos($html, 'rel="canonical"') !== false) {
        $html = preg_replace(
            '/<link rel="canonical" href=".*?" \/>/',
            '<link rel="canonical" href="' . $escapedArticleUrl . '" />',
            $html
        );
    } else {
        $html = str_replace('</head>', "    <link rel=\"canonical\" href=\"{$escapedArticleUrl}\" />\n  </head>", $html);
    }

    return response($html, 200)->header('Content-Type', 'text/html; charset=UTF-8');
});

Route::get('/social-image/{slug}.jpg', function ($slug) {
    $berita = Berita::where('slug', $slug)->first();

    if (!$berita || !$berita->thumbnail) {
        abort(404, 'Berita or thumbnail not found');
    }

    // Clean thumbnail path
    $thumbnail = ltrim((string) $berita->thumbnail, '/');
    
    // Remove prefixes if present
    $thumbnail = preg_replace('#^(public/|storage/)#', '', $thumbnail);
    
    // Build source path - check multiple possible locations
    $possiblePaths = [
        storage_path('app/public/' . $thumbnail),
        storage_path('app/' . $thumbnail),
        public_path('storage/' . $thumbnail),
    ];
    
    $sourcePath = null;
    foreach ($possiblePaths as $path) {
        if (File::exists($path)) {
            $sourcePath = $path;
            break;
        }
    }
    
    if (!$sourcePath) {
        \Log::error('Social image source not found', [
            'slug' => $slug,
            'thumbnail' => $berita->thumbnail,
            'checked_paths' => $possiblePaths
        ]);
        abort(404, 'Image file not found');
    }

    // Cache directory for optimized social images
    $cacheDir = storage_path('app/public/social');
    File::ensureDirectoryExists($cacheDir);

    $cachePath = $cacheDir . '/' . $slug . '.jpg';

    // Generate optimized social image if not cached
    if (!File::exists($cachePath)) {
        $generated = \generate_social_image($sourcePath, $cachePath);

        if (!$generated) {
            // Fallback: serve original image if generation fails
            return response()->file($sourcePath, [
                'Cache-Control' => 'public, max-age=604800, immutable',
                'Content-Type' => File::mimeType($sourcePath) ?? 'image/jpeg',
            ]);
        }
    }

    // Serve cached optimized image
    return response()->file($cachePath, [
        'Cache-Control' => 'public, max-age=2592000, immutable', // 30 days
        'Content-Type' => 'image/jpeg',
    ]);
})->where('slug', '[A-Za-z0-9\-_.]+')->name('social-image');

Route::get('/{any}', function () {
    return File::get(public_path('ui/index.html'));
})->where('any', '^(?!api).*$');

// // Temporary fix: Return 404 for non-API routes
// Route::get('/{any}', function () {
//     abort(404);
// })->where('any', '^(?!api).*$');

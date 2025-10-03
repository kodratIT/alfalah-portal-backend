# Production Image Fix Guide

## Problem
Images show gray/broken in production but work in local.

Example: https://demo-1.jauharulfalah-alislamy.ponpes.id/berita/a

## Possible Causes

1. ❌ Storage link not created
2. ❌ Wrong file permissions
3. ❌ Image files not uploaded
4. ❌ GD/Imagick extension missing
5. ❌ Social image generation fails

## Step-by-Step Fix

### 1. Create Storage Symlink

```bash
cd /path/to/backend
php artisan storage:link
```

Should output:
```
The [public/storage] link has been connected to [storage/app/public].
```

### 2. Check Storage Link

```bash
ls -la public/ | grep storage
```

Should show:
```
lrwxrwxrwx 1 www-data www-data storage -> /path/to/backend/storage/app/public
```

### 3. Fix File Permissions

```bash
# Fix storage permissions
sudo chown -R www-data:www-data storage/
sudo chmod -R 775 storage/

# Fix public storage permissions
sudo chown -R www-data:www-data public/storage/
sudo chmod -R 755 public/storage/

# Create social cache directory
mkdir -p storage/app/public/social
sudo chown -R www-data:www-data storage/app/public/social
sudo chmod -R 775 storage/app/public/social
```

### 4. Check PHP Extensions

```bash
php -m | grep -E "gd|imagick"
```

Should show:
```
gd
imagick  # or at least gd
```

**If missing:**

```bash
# Install GD
sudo apt-get install php8.2-gd

# Or install Imagick (better quality)
sudo apt-get install php8.2-imagick

# Restart PHP-FPM
sudo systemctl restart php8.2-fpm
```

### 5. Test Image Path

```bash
cd /path/to/backend
php artisan tinker
```

```php
// Get a berita record
$berita = \App\Models\Berita::first();
echo "Thumbnail: " . $berita->thumbnail . "\n";

// Check if file exists
$paths = [
    storage_path('app/public/' . $berita->thumbnail),
    public_path('storage/' . $berita->thumbnail),
];

foreach ($paths as $path) {
    echo $path . ': ';
    echo (file_exists($path) ? '✅ EXISTS' : '❌ NOT FOUND') . "\n";
}

exit
```

### 6. Test Social Image Generation

```bash
php artisan tinker
```

```php
// Test if generate_social_image function works
$berita = \App\Models\Berita::where('slug', 'a')->first();
$thumbnail = preg_replace('#^(public/|storage/)#', '', $berita->thumbnail);
$sourcePath = storage_path('app/public/' . $thumbnail);
$cachePath = storage_path('app/public/social/test.jpg');

if (file_exists($sourcePath)) {
    $result = generate_social_image($sourcePath, $cachePath);
    echo $result ? "✅ Generation SUCCESS\n" : "❌ Generation FAILED\n";
    echo "Check: " . $cachePath . "\n";
} else {
    echo "❌ Source file not found: " . $sourcePath . "\n";
}

exit
```

### 7. Check Web Server Access

Test direct file access:

```bash
# Get thumbnail path from database
php artisan tinker
$berita = \App\Models\Berita::where('slug', 'a')->first();
echo $berita->thumbnail;
exit

# Replace {thumbnail} with actual path
curl -I https://demo-1.jauharulfalah-alislamy.ponpes.id/storage/{thumbnail}
```

Should return `200 OK`, not `404`.

### 8. Check Nginx Configuration

Ensure Nginx serves static files:

```nginx
location ~* \.(jpg|jpeg|png|gif|webp)$ {
    expires 30d;
    add_header Cache-Control "public, immutable";
    access_log off;
}

location /storage {
    alias /path/to/backend/storage/app/public;
    expires 30d;
    add_header Cache-Control "public, immutable";
}
```

Reload Nginx:
```bash
sudo nginx -t
sudo systemctl reload nginx
```

### 9. Clear All Caches

```bash
cd /path/to/backend
php artisan optimize:clear
php artisan config:clear
php artisan view:clear
```

### 10. Check Laravel Logs

```bash
tail -f storage/logs/laravel.log
```

Then visit: https://demo-1.jauharulfalah-alislamy.ponpes.id/social-image/a.jpg

Look for errors like:
- `Social image source not found`
- File path issues
- Permission denied

## Quick Check Commands

```bash
# 1. Check storage link
ls -la public/storage

# 2. Check if images exist
ls -la storage/app/public/berita/

# 3. Check permissions
ls -la storage/app/public/ | head -20

# 4. Check PHP extensions
php -m | grep -E "gd|imagick"

# 5. Test route
curl -I https://demo-1.jauharulfalah-alislamy.ponpes.id/social-image/a.jpg
```

## Common Issues & Solutions

### Issue 1: "No such file or directory"
**Solution:** Run `php artisan storage:link`

### Issue 2: "Permission denied"
**Solution:** 
```bash
sudo chown -R www-data:www-data storage/
sudo chmod -R 775 storage/
```

### Issue 3: GD/Imagick not installed
**Solution:**
```bash
sudo apt-get install php8.2-gd php8.2-imagick
sudo systemctl restart php8.2-fpm
```

### Issue 4: Gray placeholder image
**Cause:** Social image generation failing
**Solution:** 
- Check extensions installed
- Check source file exists
- Check logs for errors

### Issue 5: 404 on /storage/ URLs
**Solution:**
- Recreate symlink: `rm public/storage && php artisan storage:link`
- Check Nginx serves /storage correctly

## Expected Result

✅ Images load properly  
✅ Social images cached in storage/app/public/social/  
✅ Direct access works: `/storage/berita/image.jpg`  
✅ Social image works: `/social-image/slug.jpg`  
✅ No gray placeholders  

## Test URLs

After fixes, test these:

1. **Direct storage access:**
   ```
   https://demo-1.jauharulfalah-alislamy.ponpes.id/storage/berita/{filename}
   ```

2. **Social image route:**
   ```
   https://demo-1.jauharulfalah-alislamy.ponpes.id/social-image/a.jpg
   ```

3. **Berita page:**
   ```
   https://demo-1.jauharulfalah-alislamy.ponpes.id/berita/a
   ```

All should show images, not gray placeholders!

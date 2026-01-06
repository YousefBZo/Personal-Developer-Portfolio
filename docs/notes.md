# Technical Notes

Some lessons I learned while building this project.

---

## Deployment Challenges (Render/VPS)

Deploying to Render's free tier was challenging. Here are the main issues I faced and how I solved them:

### 1. PHP Version Mismatch
**Problem:** The `composer.lock` file had Symfony packages requiring PHP 8.4, but my Dockerfile used PHP 8.3.

**Error:**
```
symfony/clock v8.0.0 requires php >=8.4 -> your php version (8.3.29) does not satisfy that requirement
```

**Solution:** Updated the Dockerfile to use `php:8.4-cli-alpine` instead of `php:8.3-cli-alpine`.

---

### 2. Database Connection Refused
**Problem:** After deployment, the app couldn't connect to PostgreSQL, showing "connection refused" at `127.0.0.1:5432`.

**Solution:** The database environment variables weren't set in Render. I had to manually add `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in the Render Web Service environment settings, using the internal hostname from the Render PostgreSQL service.

---

### 3. CSS/JS Not Loading (HTTP vs HTTPS)
**Problem:** The site loaded but without any styling. Looking at the source, assets were being requested over `http://` while the site was served over `https://`, causing mixed content blocking.

**Solution:** Added `URL::forceScheme('https')` in `AppServiceProvider.php` for production environment:
```php
if (config('app.env') === 'production') {
    URL::forceScheme('https');
}
```

---

### 4. Login 500 Error (Session Issues)
**Problem:** Login worked but redirected to a 500 error. This was caused by session cookie configuration issues with HTTPS.

**Solution:** 
1. Changed `SESSION_DRIVER` from `cookie` to `file` in environment variables
2. Added secure cookie settings in AppServiceProvider:
```php
config(['session.secure' => true]);
config(['session.same_site' => 'lax']);
```

---

### 5. Images Not Persisting (Ephemeral Filesystem)
**Problem:** Uploaded images would work initially but disappear after each deployment. This is because Render uses an ephemeral filesystem - any files written to disk are lost when the container restarts.

**Solution:** Instead of storing images on the filesystem, I converted them to Base64 and stored them directly in the PostgreSQL database:

1. Created a migration to change `image` columns from `string` to `longText`
2. Updated the service classes to convert uploaded images to Base64:
```php
$imageData = file_get_contents($file->getRealPath());
$mimeType = $file->getMimeType();
$base64 = base64_encode($imageData);
$data['image'] = 'data:' . $mimeType . ';base64,' . $base64;
```

This way, images persist in the database and survive redeployments.

---

### 6. Database Seeder Duplicate Key Error
**Problem:** On redeploy, the seeder tried to insert the admin user again, causing a "duplicate key" error.

**Solution:** Changed `User::create()` to `User::firstOrCreate()` in the seeder, so it only creates the user if they don't already exist.

---

### Key Takeaways for Render Deployment:
- Always use `config()` instead of `env()` in code (env doesn't work after config is cached)
- Set all environment variables in Render dashboard before deploying
- Use the **internal hostname** for database connections (not external)
- Keep database and web service in the **same region**
- For file uploads, use external storage (Cloudinary, S3) or Base64 in database

---

## Docker Problem I Faced

The biggest issue I ran into was with the **Vite dev server not being accessible from the browser**. 

When I first set up Docker, Vite was running fine inside the container but I kept getting "connection refused" when trying to access `localhost:5173`. Spent like an hour trying to figure out what was wrong.

Turns out the problem was that Vite by default binds to `127.0.0.1` which only allows connections from inside the container itself. To fix it, I had to configure Vite to bind to `0.0.0.0` so it accepts connections from outside the container.

I added this to my `vite.config.js`:

```js
server: {
    host: '0.0.0.0',
    port: 5173
}
```

Also had to make sure the port was properly exposed in `docker-compose.yml`. After that everything worked fine.

Another smaller issue was the PostgreSQL container failing to start because of permission problems with the data volume on Windows. Fixed it by letting Docker manage the volume instead of binding to a local folder.

---

## Git/GitHub Lesson

The most important thing I learned about Git in this assignment is to **commit often and write meaningful commit messages**.

At first I was making huge commits with vague messages like "updated stuff" or "fixed things". This made it really hard to track what changed and when. When something broke, I had no idea which commit caused it.

Now I try to:
- Make small, focused commits that do one thing
- Write clear messages that explain WHY not just what (e.g., "fix email links missing mailto protocol" instead of "fixed links")
- Use conventional commit format when it makes sense (feat:, fix:, refactor:, etc.)

Also learned the hard way to always pull before pushing when working with remote repos. Got some messy merge conflicts because I forgot to do that a couple times.

The `.gitignore` file is super important too - almost pushed my `.env` file with database passwords by accident. Always double check what you're committing!


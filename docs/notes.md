# Technical Notes

Some lessons I learned while building this project.

---

## Deployment to Render - What Went Wrong

Deploying to Render was honestly a pain. Here's what I struggled with:

### PHP Version Issue
My Dockerfile had PHP 8.3 but the composer packages needed 8.4. Simple fix - just changed the base image to `php:8.4-cli-alpine`.

### Database Wouldn't Connect
Kept getting "connection refused" errors. Turns out I forgot to add the database environment variables in Render's dashboard. Had to copy the hostname, username, password etc from the PostgreSQL service I created.

### CSS Wasn't Loading
The site looked broken - no styling at all. The problem was that Laravel was generating `http://` URLs but Render serves everything over `https://`. Fixed it by adding this to AppServiceProvider:
```php
URL::forceScheme('https');
```

### Login Kept Breaking
Would login successfully then get a 500 error. Session cookies were the issue. Changed `SESSION_DRIVER` to `file` and added secure cookie config.

### Images Disappeared After Deploy
This one took forever to figure out. Render has an "ephemeral filesystem" which means any uploaded files get deleted when the container restarts. My solution was to store images as Base64 strings directly in the database. Not ideal for large images but works fine for a portfolio.

### Seeder Errors on Redeploy
The admin user seeder kept failing because it tried to create the same user twice. Changed `User::create()` to `User::firstOrCreate()` so it skips if user exists.

**Main lesson:** Always set your environment variables BEFORE deploying, and remember that Render's free tier doesn't persist files.

---

## Docker Problem I Faced

Spent way too long on this one - Vite dev server wouldn't work from the browser. Kept getting "connection refused" on `localhost:5173`.

The issue was Vite binds to `127.0.0.1` by default, which doesn't work inside Docker. Had to change it to `0.0.0.0` in vite.config.js:

```js
server: {
    host: '0.0.0.0',
    port: 5173
}
```

Also had PostgreSQL permission issues on Windows with mounted volumes. Fixed by letting Docker manage the volume instead.

---

## Git Lessons

**Commit often with good messages.** I used to make huge commits with messages like "fixed stuff" - terrible idea. Now I do small commits with clear messages like "fix: force HTTPS for asset URLs".

**Always pull before push.** Got burned by merge conflicts a few times.

**Check .gitignore carefully.** Almost pushed my `.env` file with database passwords. That would've been bad.


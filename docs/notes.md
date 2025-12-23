# Technical Notes

Some lessons I learned while building this project.

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


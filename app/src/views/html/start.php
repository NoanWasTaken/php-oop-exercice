<!DOCTYPE html>
<html lang="fr" class="h-full">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>titre</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="min-h-full">
    <main class="min-h-full">
      <div class="flex flex-col min-h-full w-full items-center justify-start">
        <div
          class="flex flex-row w-full h-24 bg-gray-900 items-center justify-center"
        >
          <div class="w-11/12 flex flex-row items-center justify-end space-x-4">
            <a href="/" class="text-white">Homepage</a>
            <?php if ($this->isLoggedIn()): ?>
            <a href="/blogs/new.php" class="text-white">Create post</a>
            <a href="/profile.php" class="text-white">Profile</a>
            <a href="/logout" class="text-white">Logout</a>
            <?php else: ?>
            <a href="/login" class="text-white">Login</a>
            <a href="/register" class="text-white">Register</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>

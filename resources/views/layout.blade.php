<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Jose’s Portfolio</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <header>
    <nav>
      <a href="/">Home</a>
      <a href="/about">About</a>
      <a href="/projects">Projects</a>
      <a href="/contact">Contact</a>
    </nav>
  </header>

  <main>
    @yield('content')
  </main>

  <footer>
    <p>© 2025 Jose — Built with Laravel 💻</p>
  </footer>
</body>
</html>

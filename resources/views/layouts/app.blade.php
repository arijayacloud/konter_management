<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
    body {
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }

    /* Sidebar styles */
    nav.sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      color: white;
      padding-top: 1rem;
      transition: width 0.3s ease;
      overflow-x: hidden;
      overflow-y: auto;
      z-index: 100;
    }

    /* Default sidebar width besar (desktop) */
    @media(min-width: 768px) {
      nav.sidebar {
        width: 250px;
      }
      main.content {
        margin-left: 250px;
        transition: margin-left 0.3s ease;
      }
      nav.sidebar .nav-link span.text-label {
        display: inline;
      }
    }

    /* Sidebar kecil di mobile */
    @media(max-width: 767.98px) {
      nav.sidebar {
        width: 80px;
      }
      main.content {
        margin-left: 80px;
        transition: margin-left 0.3s ease;
      }
      /* Sembunyikan label teks */
      nav.sidebar .nav-link span.text-label {
        display: none;
      }
      /* Center icon */
      nav.sidebar .nav-link {
        justify-content: center;
      }
    }

    /* Nav link style */
    nav.sidebar .nav-link {
      color: white;
      padding: 0.75rem 1rem;
      display: flex;
      align-items: center;
      transition: background-color 0.2s;
      white-space: nowrap;
    }
    nav.sidebar .nav-link:hover,
    nav.sidebar .nav-link.active {
      background-color: #495057;
      color: white;
    }

    nav.sidebar .nav-link i {
      font-size: 1.5rem;
      min-width: 30px;
      text-align: center;
    }

    /* Header menu */
    nav.sidebar h4 {
      margin-bottom: 1.5rem;
      text-align: center;
    }

    /* Konten utama */
    main.content {
      padding: 1rem;
      min-height: 100vh;
    }
  </style>
</head>
<body>
  <nav class="sidebar bg-primary">
    <h4 class="d-none d-md-block">Menu</h4>
    <ul class="nav flex-column">
      <li class="nav-item mb-2">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
          <i class="bi bi-speedometer2"></i>
          <span class="text-label ms-2">Dashboard</span>
        </a>
      </li>
      <li class="nav-item mb-2">
        <a href="{{ route('list') }}" class="nav-link {{ request()->routeIs('list') ? 'active' : '' }}">
          <i class="bi bi-list-ul"></i>
          <span class="text-label ms-2">List</span>
        </a>
      </li>
    </ul>
  </nav>

  <main class="content bg-light">
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
    <h1>@yield('title')</h1>
    @yield('content')
  </main>
</body>
</html>



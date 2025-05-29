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
      nav.sidebar .nav-link span.text-label, button.text-label {
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
      background-color: white;
      color: #0d6efd;
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
  <nav class="sidebar bg-primary d-flex flex-column gap-3">
    <div class="w-75 bg-white rounded align-self-center overflow-hidden">
        <img class="img-fluid" src="{{ asset('images/logo.jpg')}}" alt="logo">
    </div>
    <div class="d-flex flex-column grow-1 justify-content-between">
        <ul class="flex flex-column p-0">
          <li class="nav-item mb-2">
            <a href="{{ route('dashboard') }}" class="nav-link mx-3 rounded {{ request()->routeIs('dashboard') ? 'active' : '' }}">
              <i class="bi bi-speedometer2"></i>
              <span class="text-label ms-2">Dashboard</span>
            </a>
          </li>
          <li class="nav-item mb-2">
            <a href="{{ route('list') }}" class="nav-link mx-3 rounded {{ request()->routeIs('list') ? 'active' : '' }}">
              <i class="bi bi-list-ul"></i>
              <span class="text-label ms-2">List</span>
            </a>
          </li>
        </ul>
        <form class="mb-4 nav-item" action="{{ route('logout') }}" method="POST">
            @csrf
            <div class="nav-link mx-3 rounded">
                <i class="bi bi-box-arrow-left"></i>
                <button class="text-label ms-2" type="submit">Logout</button>
            </div>
        </form>
    </div>
  </nav>

  <main class="content bg-light">
    <h1>@yield('title')</h1>
    @yield('content')
  </main>
</body>
</html>



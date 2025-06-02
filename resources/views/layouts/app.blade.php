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

    /* Sidebar desktop */
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

    @media (min-width: 768px) {
      nav.sidebar {
        width: 250px;
        display: flex;
      }

      main.content {
        margin-left: 250px;
        #margin-top: 0;
        transition: margin-left 0.3s ease;
      }

      nav.sidebar .nav-link span.text-label {
        display: inline;
      }

      .navbar-toggle,
      nav.mobile-navbar {
        display: none !important;
      }

      main.content main {
          padding: 23px;
      }

        main.content main #rowInfo {
            display: flex;
        }

      #formWrapper {
          margin-top: 0px;
      }

        #addButton {
            display: flex;
        }
    }

    @media (max-width: 576px) {
      #formWrapper {
          margin-top: 20px;
      }
    }

    /* Mobile styling */
    @media (max-width: 767.98px) {
      nav.sidebar {
        display: none;
      }

        #addButton {
            display: none;
        }

      .navbar-toggle {
        display: block;
        background-color: #0d6efd;
        border: none;
        color: white;
        font-size: 20px;
        border-radius: 4px;
      }

      .navbar-toggle-wrapper {
        display: block;
        position: fixed;
        top: 10px;
        left: 23px;
        right: 23px;
        z-index: 101;
        background-color: #0d6efd;
        border: none;
        color: white;
        padding: 10px;
        font-size: 20px;
        border-radius: 4px;
      }

      nav.mobile-navbar {
        display: flex;
        flex-direction: column;
        background-color: #3d8bfd;
        gap: 10px;
        color: white;
        position: fixed;
        border-radius: 4px;
        top: 10px;
        left: 23px;
        right: 23px;
        z-index: 100;
        padding-top: 0;
        height: 0px;
        overflow: hidden;
        transition: all 0.3s ease;
      }

      nav.mobile-navbar.active {
        padding-top: 3.8rem;
        height: 345px;
      }

      main.content {
        #margin-top: 50px !important;
        margin-left: 0 !important;
      }

      nav.mobile-navbar .nav-link {
        padding: 1rem;
        color: white;
      }

      nav.mobile-navbar .nav-link.active,
      nav.mobile-navbar .nav-link:hover {
        background-color: white;
        color: #0d6efd;
      }


        main.content main {
            padding: 80px 23px 23px 23px;
        }

        main.content main #rowInfo {
            display: flex;
            flex-direction: column;
        }
    }

    nav.sidebar .nav-link,
    nav.mobile-navbar .nav-link {
      color: white;
      padding: 0.75rem 1rem;
      display: flex;
      align-items: center;
      transition: background-color 0.2s;
      white-space: nowrap;
      text-decoration: none;
    }

    nav.sidebar .nav-link:hover,
    nav.sidebar .nav-link.active {
      background-color: white;
      color: #0d6efd;
    }

    nav.sidebar .nav-link i,
    nav.mobile-navbar .nav-link i {
      font-size: 1.5rem;
      min-width: 30px;
      text-align: center;
    }

    nav.sidebar h4 {
      margin-bottom: 1.5rem;
      text-align: center;
    }

    main.content {
      padding: 0;
    }
  </style>
</head>
<body>
  <!-- Toggle Button for Mobile -->
  <div class="navbar-toggle-wrapper">
      <button class="navbar-toggle" onclick="toggleNavbar()"><i class="bi bi-list"></i></button>
  </div>

  <!-- Mobile Navbar -->
  <nav class="mobile-navbar px-2 pb-2">
    <a href="{{ route('dashboard') }}" class="nav-link rounded {{ request()->routeIs('dashboard') ? 'active' : '' }}">
      <i class="bi bi-speedometer2"></i> <span class="ms-2">Dashboard</span>
    </a>
    <a href="{{ route('list') }}" class="nav-link rounded {{ request()->routeIs('list') ? 'active' : '' }}">
      <i class="bi bi-list-ul"></i> <span class="ms-2">List</span>
    </a>
    <button onclick="toggleNavbar()" type="button" class="nav-link rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">
      <i class="bi bi-plus me-2"></i> Add
    </button>
    <form action="{{ route('logout') }}" method="POST" class="w-100">
      @csrf
      <button type="submit" class="nav-link w-100 text-start rounded">
        <i class="bi bi-box-arrow-left"></i> <span class="ms-2">Logout</span>
      </button>
    </form>
  </nav>

  <!-- Desktop Sidebar -->
  <nav class="sidebar bg-primary flex-column gap-3">
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
      <form class="mb-4 px-3 nav-item" action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="nav-link rounded w-100" type="submit">
          <i class="bi bi-box-arrow-left"></i>
          <span class="text-label ms-2">Logout</span>
        </button>
      </form>
    </div>
  </nav>

  <main class="content">
    @yield('content')
  </main>

  <!-- Toggle Script -->
  <script>
    function toggleNavbar() {
      document.querySelector('.mobile-navbar').classList.toggle('active');
    }
  </script>
</body>
</html>

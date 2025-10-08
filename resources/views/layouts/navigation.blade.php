<!DOCTYPE html>
<html lang="en" class="bg-gray-100">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Navbar with Dark Mode</title>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class'
    }
  </script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 transition duration-300">
  <header>
    <nav x-data="{ isOpen: false }" class="bg-white dark:bg-gray-900 shadow-md">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
          
          <!-- Logo -->
          <div class="flex-shrink-0">
            <a href="#" class="text-2xl font-bold text-gray-800 dark:text-white">E-Learning</a>
          </div>

          <!-- Desktop Navigation -->
          <div class="hidden lg:flex space-x-4 items-center">
            @auth
            <a href="/dashboard" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:bg-gray-700 px-3 py-2 rounded-md text-base font-medium">Home</a>
            <a href="/quizzes" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:bg-gray-700 px-3 py-2 rounded-md text-base font-medium">Kuis</a>
            <a href="/courses" class="block text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 px-3 py-2 rounded-md text-base font-medium">Modul</a>
            @endauth
            @auth
            @if(Auth::user()->role == 'admin')
            <a href="/classrooms" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:bg-gray-700 px-3 py-2 rounded-md text-base font-medium">Kelas</a>
            <a href="/users" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:bg-gray-700 px-3 py-2 rounded-md text-base font-medium">Pengguna</a>
            @endif
            @endauth

            <!-- Dark Mode Toggle -->
            <button 
              @click="document.documentElement.classList.toggle('dark');
                      localStorage.theme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';"
              class="ml-4 p-2 rounded bg-gray-200 dark:bg-gray-700 dark:text-white transition">
              🌙
            </button>

            <!-- User Dropdown -->
            <div x-data="{ isOpen: false }" class="relative">
              <button @click="isOpen = !isOpen" class="flex items-center gap-x-1 text-gray-700 dark:text-gray-300 px-3 py-2 rounded-md text-sm font-medium hover:text-gray-900 dark:hover:text-white">
                <span>
                  @auth
                  {{ Auth::user()->name }}
                  @else
                  Login
                  @endauth
                </span>
                <svg class="w-5 h-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M5.23 7.23a.75.75 0 01.53-.22h8.48a.75.75 0 01.53 1.28L10 12.94l-4.77-4.77a.75.75 0 010-1.06z" clip-rule="evenodd" />
                </svg>
              </button>
              <div x-show="isOpen" @click.away="isOpen = false" class="absolute right-0 z-10 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-300">
                  @guest
                  <li><a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Login</a></li>
                  @endguest
                  @auth
                  <li><a href="/profile/edit" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Edit User</a></li>
                  <li>
                    <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Logout</button>
                    </form>
                  </li>
                  @endauth
                </ul>
              </div>
            </div>
          </div>

          <!-- Mobile menu button -->
          <div class="flex lg:hidden">
            <button @click="isOpen = !isOpen" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white focus:outline-none">
              <svg x-show="!isOpen" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
              </svg>
              <svg x-show="isOpen" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Mobile Navigation -->
      <div x-show="isOpen" @click.away="isOpen = false" class="lg:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1">
           <a href="/" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
          @auth
          <a href="/courses" class="block text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 px-3 py-2 rounded-md text-base font-medium">Mata Pelajaran</a>
          <a href="/quizzes" class="block text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 px-3 py-2 rounded-md text-base font-medium">Kuis</a>
          @endauth

          @auth
          @if(Auth::user()->role == 'admin')
          <a href="/kelas" class="block text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 px-3 py-2 rounded-md text-base font-medium">Kelas</a>
          <a href="/users" class="block text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 px-3 py-2 rounded-md text-base font-medium">Manajemen Pengguna</a>
          @endif
          @endauth

          <!-- Dark Mode Toggle (Mobile) -->
          <button 
            @click="document.documentElement.classList.toggle('dark');
                    localStorage.theme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';"
            class="w-full text-left px-3 py-2 rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white transition">
            🌙 Dark Mode
          </button>

          <!-- User Dropdown (Mobile) -->
          <div class="block text-gray-700 dark:text-gray-300 px-3 py-2 rounded-md text-base font-medium">
            <div x-data="{ isOpen: false }" class="relative">
              <button @click="isOpen = !isOpen" class="flex items-center">
                <span>
                  @auth
                  {{ Auth::user()->name }}
                  @else
                  Login
                  @endauth
                </span>
                <svg class="w-5 h-5 ml-1 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M5.23 7.23a.75.75 0 01.53-.22h8.48a.75.75 0 01.53 1.28L10 12.94l-4.77-4.77a.75.75 0 010-1.06z" clip-rule="evenodd" />
                </svg>
              </button>
              <div x-show="isOpen" @click.away="isOpen = false" class="absolute z-10 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-300">
                  @guest
                  <li><a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Login</a></li>
                  @endguest
                  @auth
                  <li><a href="/profile" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Edit User</a></li>
                  <li>
                    <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Logout</button>
                    </form>
                  </li>
                  @endauth
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <!-- Script cek preferensi tema -->
  <script>
    if (localStorage.theme === 'dark' ||
        (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark')
    } else {
      document.documentElement.classList.remove('dark')
    }
  </script>
</body>
</html>

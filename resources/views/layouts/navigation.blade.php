<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Navbar</title>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
  <header>
    <nav x-data="{ isOpen: false, isLoggedIn: false }" class="bg-white shadow-md">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
          <!-- Logo -->
          <div class="flex-shrink-0">
            <a href="#" class="text-2xl font-bold text-gray-800">E-Learning</a>
          </div>

          <!-- Desktop Navigation -->
          <div class="hidden lg:flex space-x-4">
            <a href="/" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Home</a>
            <a href="/classrooms" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Kelas</a>
            <a href="/courses" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Mata Pelajaran</a>
            <a href="/exams" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Ujian</a>
            <a href="/exam_scores" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Nilai</a>
           
            <!-- Admin Tab (Visible only for admins) -->
            @auth
            @if(Auth::user()->role == 'admin')
            <a href="/user" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Manajemen Pengguna</a>
            @endif
            @endauth

            <div x-data="{ isOpen: false }" class="relative">
              <button @click="isOpen = !isOpen" class="flex items-center gap-x-1 text-gray-700 px-3 py-2 rounded-md text-sm font-medium hover:text-gray-900">
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
              <div x-show="isOpen" @click.away="isOpen = false" class="absolute z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                <ul class="py-1 text-sm text-gray-700">
                  @guest
                  <li><a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-gray-100">Login</a></li>
                  @endguest
                  @auth
                  <li><a href="/profile" class="block px-4 py-2 hover:bg-gray-100">Edit User</a></li>
                  <li>
                    <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                    </form>
                  </li>
                  @endauth
                </ul>
              </div>
            </div>

          </div>

          <!-- Mobile menu button -->
          <div class="flex lg:hidden">
            <button @click="isOpen = !isOpen" class="text-gray-700 hover:text-gray-900 focus:outline-none focus:text-gray-900">
              <svg x-show="!isOpen" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
              </svg>
              <svg x-show="isOpen" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Mobile Navigation -->
      <div x-show="isOpen" @click.away="isOpen = false" class="lg:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1">
          <a href="/kelas" class="block text-gray-700 hover:bg-gray-100 px-3 py-2 rounded-md text-base font-medium">Kelas</a>
          <a href="/courses" class="block text-gray-700 hover:bg-gray-100 px-3 py-2 rounded-md text-base font-medium">Mata Pelajaran</a>
          <a href="/ujian" class="block text-gray-700 hover:bg-gray-100 px-3 py-2 rounded-md text-base font-medium">Ujian</a>
          <a href="/nilai" class="block text-gray-700 hover:bg-gray-100 px-3 py-2 rounded-md text-base font-medium">Nilai</a>

          <!-- Admin Tab (Visible only for admins) -->
          @auth
          @if(Auth::user()->role == 'admin')
          <a href="/user-management" class="block text-gray-700 hover:bg-gray-100 px-3 py-2 rounded-md text-base font-medium">Manajemen Pengguna</a>
          @endif
          @endauth

          <div class="block text-gray-700 hover:bg-gray-100 px-3 py-2 rounded-md text-base font-medium">
            <div x-data="{ isOpen: false }" class="relative">
              <button @click="isOpen = !isOpen" class="block text-gray-700 hover:bg-gray-100 px-3 py-2 rounded-md text-base font-medium">
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
              <div x-show="isOpen" @click.away="isOpen = false" class="absolute z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                <ul class="py-1 text-sm text-gray-700">
                  @guest
                  <li><a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-gray-100">Login</a></li>
                  @endguest
                  @auth
                  <li><a href="/profile" class="block px-4 py-2 hover:bg-gray-100">Edit User</a></li>

                  <li>
                    <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
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
</body>

</html>
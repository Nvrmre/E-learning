<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Informasi User --}}
                    <div class="flex items-center space-x-4">
                        {{-- Foto User --}}
                        @if(Auth::user()->profile_photo_path)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" 
                                 alt="Foto Profil" 
                                 class="w-16 h-16 rounded-full object-cover">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" 
                                 alt="Default Foto" 
                                 class="w-16 h-16 rounded-full object-cover">
                        @endif

                        {{-- Nama User --}}
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                {{ Auth::user()->name }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                    </div>

                    {{-- Pesan selamat datang --}}
                    <div class="mt-6">
                        <p class="text-gray-800 dark:text-gray-200">
                            {{ __("Selamat datang, ") }} 
                            <strong>{{ Auth::user()->name }}</strong> 
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

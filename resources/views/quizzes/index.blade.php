<x-app-layout>
    <div class="container mx-auto px-4 py-8 transition-colors duration-300">
        <h1 class="text-3xl font-semibold text-center mb-6 text-gray-800 dark:text-gray-100">
            Daftar Kuis
        </h1>

        <!-- Tombol Tambah Kuis (Admin / Guru) -->
        @auth
        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'guru')
        <div class="mb-6 text-center">
            <a href="{{ route('quizzes.create') }}"
                class="bg-blue-600 text-white py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 transition duration-200">
                Tambah Kuis
            </a>
        </div>
        @endif
        @endauth

        <!-- Pesan Sukses -->
        @if(session('success'))
        <div class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-200 px-4 py-3 rounded-lg mb-6 transition-colors duration-300">
            {{ session('success') }}
        </div>
        @endif

        <!-- Daftar Kuis -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
            @foreach ($quizzes as $quiz)
            <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105 border border-gray-100 dark:border-gray-700">
                <h5 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">
                    {{ $quiz->title }}
                </h5>
                <p class="text-gray-600 dark:text-gray-400 mb-4">
                    {{ $quiz->description }}
                </p>

                <!-- Untuk siswa -->
                @auth
                @if(Auth::user()->role == 'siswa')
                <a href="{{ route('quizzes.show', $quiz->id) }}"
                    class="bg-green-600 text-white py-2 px-4 rounded-lg shadow-md hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-600 transition duration-200">
                    Kerjain nih
                </a>
                @endif
                @endauth

                <!-- Untuk admin / guru -->
                @auth
                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'guru')
                <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" class="mt-4"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus kuis ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-600 text-white py-2 px-4 rounded-lg shadow-md hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 transition duration-200">
                        Hapus
                    </button>
                </form>
                @endif
                @endauth
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

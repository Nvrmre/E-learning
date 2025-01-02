<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold text-center mb-6">Daftar Kuis</h1>

        <!-- Tombol Tambah Kuis, hanya tampil jika pengguna adalah admin atau guru -->
        <!-- Tombol Tambah Kuis, hanya tampil jika pengguna adalah admin atau guru -->
        @auth
        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'guru') <!-- Cek jika pengguna memiliki hak untuk membuat kuis -->
        <div class="mb-6 text-center">
            <a href="{{ route('quizzes.create') }}" class="btn btn-primary bg-blue-600 text-white py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 transition duration-200">
                Tambah Kuis
            </a>
        </div>
        @endif
        @endauth

        <!-- Pesan Sukses -->
        @if(session('success'))
        <div class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
        @endif

        <!-- Daftar Kuis -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
            @foreach ($quizzes as $quiz)
            <div class="card bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-200 transform hover:scale-105">
                <h5 class="card-title text-xl font-semibold text-gray-800 mb-4">{{ $quiz->title }}</h5>
                <p class="card-text text-gray-600 mb-4">{{ $quiz->description }}</p>

                @auth
                @if(Auth::user()->role == 'siswa') <!-- Cek jika pengguna adalah siswa -->
                <a href="{{ route('quizzes.show', $quiz->id) }}" class="btn btn-primary bg-green-600 text-white py-2 px-4 rounded-lg shadow-md hover:bg-green-700 transition duration-200">
                    Mengerjakan Kuis
                </a>
                @endif
                @endauth

                @auth
                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'guru') <!-- Cek jika pengguna adalah admin atau guru -->
                <!-- Tombol Hapus Kuis -->
                <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" class="mt-4" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kuis ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger bg-red-600 text-white py-2 px-4 rounded-lg shadow-md hover:bg-red-700 transition duration-200">
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
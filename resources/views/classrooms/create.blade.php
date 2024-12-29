<x-app-layout>
    <div class="container mx-auto mt-8">
        <h2 class="text-2xl font-semibold mb-4">Tambah Kelas</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('classrooms.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="kelas" class="block text-gray-700">Nama Kelas</label>
                <input type="text" id="kelas" name="kelas" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tambah Kelas</button>
        </form>
    </div>
</x-app-layout>

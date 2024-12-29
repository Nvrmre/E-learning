<x-app-layout>
    <div class="container mx-auto mt-8 px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Daftar Kelas</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="border border-gray-300 px-6 py-4 text-left text-sm font-medium">No</th>
                        <th class="border border-gray-300 px-6 py-4 text-left text-sm font-medium">Nama Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classrooms as $index => $classroom)
                    <tr class="hover:bg-gray-50 transition-colors duration-300">
                        <td class="border border-gray-300 px-6 py-4 text-sm">{{ $index + 1 }}</td>
                        <td class="border border-gray-300 px-6 py-4 text-sm">{{ $classroom->kelas }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tombol Tambah Kelas hanya untuk admin -->
        @if(auth()->user()->role === 'admin')
            <div class="mt-6 flex justify-end">
                <a href="{{ route('classrooms.create') }}" class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-all duration-300">
                    Tambah Kelas
                </a>
            </div>
        @endif
    </div>
</x-app-layout>

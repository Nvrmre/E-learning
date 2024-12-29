<!-- resources/views/exam_scores/index.blade.php -->
<x-app-layout>
    <div class="container mx-auto mt-8">
        <h2 class="text-2xl font-semibold mb-4">Daftar Nilai Ujian</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'guru')
            <div class="mb-6 flex justify-end">
                <a href="{{ route('exam_scores.create', $exam->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tambah Nilai</a>
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow-xl rounded-lg">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-gray-200 text-gray-800">
                    <tr>
                        <th class="border border-gray-300 px-6 py-4 text-left">No</th>
                        <th class="border border-gray-300 px-6 py-4 text-left">Nama Siswa</th>
                        <th class="border border-gray-300 px-6 py-4 text-left">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($scores as $index => $score)
                    <tr class="hover:bg-gray-50 transition-colors duration-300">
                        <td class="border border-gray-300 px-6 py-4">{{ $index + 1 }}</td>
                        <td class="border border-gray-300 px-6 py-4">{{ $score->student->nama_siswa }}</td>
                        <td class="border border-gray-300 px-6 py-4">{{ $score->score }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

<!-- resources/views/exam_scores/show.blade.php -->
<x-app-layout>
    <div class="container mx-auto mt-8">
        <h2 class="text-2xl font-semibold mb-4">Detail Nilai Ujian</h2>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-bold mb-2">Ujian: {{ $exam->name }}</h3>
            <p><strong>Nama Siswa:</strong> {{ $student->nama_siswa }}</p>
            <p><strong>Nilai:</strong> {{ $examScore->score }}</p>
            <p><strong>Tanggal Ujian:</strong> {{ $exam->date }}</p> <!-- Asumsikan ada tanggal ujian -->
        </div>

        <div class="mt-6">
            <a href="{{ route('exam_scores.index', $exam) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Kembali ke Daftar Nilai</a>
        </div>
    </div>
</x-app-layout>

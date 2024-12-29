// resources/views/exam_scores/create.blade.php
<x-app-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-6">Tambah Nilai Ujian</h2>

        <form action="{{ route('exam_scores.store', $exam->id) }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="student_id" class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                <select name="student_id" id="student_id" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->nama_siswa }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="score" class="block text-sm font-medium text-gray-700">Nilai</label>
                <input type="number" name="score" id="score" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg" required min="0" max="100">
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Tambah Nilai</button>
        </form>
    </div>
</x-app-layout>


<x-app-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-6">Tambah Ujian</h2>

        <form action="{{ route('exams.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="exam_name" class="block text-sm font-medium text-gray-700">Nama Ujian</label>
                <input type="text" name="exam_name" id="exam_name" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="exam_date" class="block text-sm font-medium text-gray-700">Tanggal Ujian</label>
                <input type="date" name="exam_date" id="exam_date" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="classroom_id" class="block text-sm font-medium text-gray-700">Kelas</label>
                <select name="classroom_id" id="classroom_id" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom->id }}">{{ $classroom->kelas }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Tambah Ujian</button>
        </form>
    </div>
</x-app-layout>

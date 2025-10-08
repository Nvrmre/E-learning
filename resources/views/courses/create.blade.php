<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transition duration-300">
        <h1 class="text-2xl font-bold text-gray-700 dark:text-gray-100 mb-6 text-center">
            Upload Materi
        </h1>

        <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Nama Mata Pelajaran -->
            <div>
                <label for="mapel" class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">
                    Nama Mata Pelajaran
                </label>
                <input type="text" name="mapel" id="mapel" required
                    class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md p-3 focus:ring focus:ring-blue-200 focus:outline-none">
            </div>

            <!-- Judul Materi -->
            <div>
                <label for="materi_judul" class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">
                    Judul Materi
                </label>
                <input type="text" name="materi_judul" id="materi_judul" required
                    class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md p-3 focus:ring focus:ring-blue-200 focus:outline-none">
            </div>

            <!-- Tipe Materi -->
            <div>
                <label for="materi_tipe" class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">
                    Tipe Materi
                </label>
                <select name="materi_tipe" id="materi_tipe" required
                    class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md p-3 focus:ring focus:ring-blue-200 focus:outline-none">
                    <option value="">Pilih Tipe</option>
                    <option value="text">Teks</option>
                    <option value="pdf">PDF</option>
                </select>
            </div>

            <!-- Isi Materi (Teks) -->
            <div id="materi_text_group" class="hidden">
                <label for="materi_text" class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">
                    Isi Materi (Teks)
                </label>
                <textarea name="materi_text" id="materi_text" rows="5"
                    class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md p-3 focus:ring focus:ring-blue-200 focus:outline-none"></textarea>
            </div>

            <!-- Upload File (PDF) -->
            <div id="materi_file_group" class="hidden">
                <label for="materi_file" class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">
                    Upload File PDF
                </label>
                <input type="file" name="materi_file" id="materi_file" accept=".pdf"
                    class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md p-3 focus:ring focus:ring-blue-200 focus:outline-none">
            </div>

            <!-- Pilih Kelas -->
            <div>
                <label for="kelas_id" class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">
                    Pilih Kelas
                </label>
                <select name="kelas_id" id="kelas_id" required
                    class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md p-3 focus:ring focus:ring-blue-200 focus:outline-none">
                    <option value="">Pilih Kelas</option>
                    @foreach ($classrooms as $class)
                        <option value="{{ $class->id }}">{{ $class->kelas }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Pilih Guru -->
            <div>
                <label for="guru_id" class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">
                    Pilih Guru
                </label>
                <select name="guru_id" id="guru_id" required
                    class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md p-3 focus:ring focus:ring-blue-200 focus:outline-none">
                    <option value="">Pilih Guru</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->nama_guru }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol Submit -->
            <button type="submit"
                class="w-full bg-blue-600 dark:bg-blue-700 text-white font-medium py-3 rounded-md hover:bg-blue-700 dark:hover:bg-blue-800 transition duration-300">
                Upload Materi
            </button>
        </form>
    </div>

    <script>
        // Menampilkan input sesuai tipe materi (text/pdf)
        document.getElementById('materi_tipe').addEventListener('change', function() {
            const tipe = this.value;
            document.getElementById('materi_text_group').classList.toggle('hidden', tipe !== 'text');
            document.getElementById('materi_file_group').classList.toggle('hidden', tipe !== 'pdf');
        });
    </script>
</x-app-layout>

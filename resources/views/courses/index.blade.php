<x-app-layout>
  <div class="max-w-4xl mx-auto mt-10 bg-white shadow-md rounded-lg p-6">
    <!-- Tombol Create -->
    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'guru')
      <div class="mb-6 flex justify-end">
        <a href="{{ route('courses.create') }}" class="bg-gray-800 hover:bg-gray-900 text-white font-semibold py-2 px-4 rounded-lg shadow-md">
          Create New Course
        </a>
      </div>
    @endif

    <!-- Tabel Kursus -->
    <div class="overflow-hidden rounded-lg bg-white shadow-md">
      <table class="w-full table-auto border-collapse border border-gray-300">
        <thead class="bg-gray-800 text-white">
          <tr>
            <th class="border border-gray-300 px-6 py-4 text-left">ID</th>
            <th class="border border-gray-300 px-6 py-4 text-left">Nama Kursus</th>
            <th class="border border-gray-300 px-6 py-4 text-left">Guru</th>
            <th class="border border-gray-300 px-6 py-4 text-left">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($courses as $course)
            <tr class="hover:bg-gray-100 transition-colors duration-300">
              <td class="border border-gray-300 px-6 py-4">{{ $course->id }}</td>
              <td class="border border-gray-300 px-6 py-4">{{ $course->mapel }}</td>
              <td class="border border-gray-300 px-6 py-4">{{ $course->guru_id }}</td>
              <td class="border border-gray-300 px-6 py-4">
                <button onclick="toggleMateri('{{ $course->id }}')" class="text-gray-600 hover:text-gray-800">
                  Lihat Materi
                </button>
              </td>
            </tr>
            <tr id="materi-{{ $course->id }}" class="hidden">
              <td colspan="4" class="px-6 py-4 text-gray-700">
                <!-- Tampilkan materi atau informasi terkait -->
                <p class="text-sm">{{ $course->materi_text }}</p>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <script>
    function toggleMateri(courseId) {
      const materiRow = document.getElementById('materi-' + courseId);
      materiRow.classList.toggle('hidden'); // Tampilkan/Sembunyikan materi
    }
  </script>
</x-app-layout>

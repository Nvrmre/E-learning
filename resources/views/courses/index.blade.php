<x-app-layout>
  <div class="max-w-5xl mx-auto mt-10 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 transition duration-300">
    <!-- Tombol Create -->
    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'guru')
      <div class="mb-6 flex justify-end">
        <a href="{{ route('courses.create') }}"
          class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition">
          + Tambah Materi
        </a>
      </div>
    @endif

    <!-- Tabel Kursus -->
    <div class="overflow-hidden rounded-lg shadow-md">
      <table class="w-full border-collapse">
        <thead class="bg-gray-700 dark:bg-gray-900 text-white">
          <tr>
            <th class="border border-gray-600 px-6 py-3 text-left">#</th>
            <th class="border border-gray-600 px-6 py-3 text-left">Mata Pelajaran</th>
            <th class="border border-gray-600 px-6 py-3 text-left">Guru</th>
            <th class="border border-gray-600 px-6 py-3 text-left">Kelas</th>
            <th class="border border-gray-600 px-6 py-3 text-left">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100">
          @forelse ($courses as $course)
            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-300">
              <td class="border border-gray-600 px-6 py-4">{{ $loop->iteration }}</td>
              <td class="border border-gray-600 px-6 py-4 font-semibold">{{ $course->mapel }}</td>
              <td class="border border-gray-600 px-6 py-4">
                {{ $course->teacher->nama_guru ?? 'Tidak diketahui' }}
              </td>
              <td class="border border-gray-600 px-6 py-4">
                {{ $course->classroom->kelas ?? '-' }}
              </td>
              <td class="border border-gray-600 px-6 py-4">
                <button onclick="toggleMateri('{{ $course->id }}')"
                        class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-200">
                  Lihat Materi
                </button>
              </td>
            </tr>

            <!-- Baris Materi -->
          <tr id="materi-{{ $course->id }}" class="hidden bg-gray-50 dark:bg-gray-900">
            <td colspan="5" class="px-6 py-4 text-gray-700 dark:text-gray-200">
              <h3 class="font-semibold mb-2">Judul: {{ $course->materi_judul }}</h3>

              @if($course->materi_tipe === 'text')
                <p class="text-sm leading-relaxed">{{ $course->materi_text }}</p>

              @elseif($course->materi_tipe === 'pdf' && $course->materi_file)
                <a href="{{ Storage::url($course->materi_file) }}" target="_blank"
                  class="inline-block mt-2 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md">
                  Lihat materi
                </a>
              @else
                <p class="text-sm italic text-gray-500">Tidak ada materi tersedia.</p>
              @endif

              {{-- Tombol hapus hanya untuk admin --}}
              @if(Auth::user() && Auth::user()->role === 'admin')
                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="inline-block ml-3"
                      onsubmit="return confirm('Yakin ingin menghapus materi ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                          class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md">
                    Hapus Materi
                  </button>
                </form>
              @endif
            </td>
          </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center py-4 text-gray-500 dark:text-gray-300">
                Belum ada materi yang diupload.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <script>
    // Toggle baris materi
    function toggleMateri(courseId) {
      const materiRow = document.getElementById('materi-' + courseId);
      materiRow.classList.toggle('hidden');
    }
  </script>
</x-app-layout>

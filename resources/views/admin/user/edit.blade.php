<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">Edit Pengguna</h2>

        <!-- Form Edit -->
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm 
                           focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                    required>
            </div>

            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm 
                           focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                    required>
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Password (Kosongkan jika tidak diubah)
                </label>
                <input type="password" name="password" id="password"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm 
                           focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Konfirmasi Password
                </label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm 
                           focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
            </div>

            <!-- Role -->
            <div class="mb-6">
                <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                <select name="role" id="role"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm 
                           bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100" required>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="guru" {{ $user->role == 'guru' ? 'selected' : '' }}>Guru</option>
                    <option value="siswa" {{ $user->role == 'siswa' ? 'selected' : '' }}>Siswa</option>
                </select>
            </div>

            <!-- Kelas (khusus siswa) -->
            <div id="kelas-field" class="mb-6 {{ $user->role === 'siswa' ? '' : 'hidden' }}">
                <label for="kelas_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kelas</label>
                <select name="kelas_id" id="kelas_id"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm 
                           bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($classrooms as $kelas)
                        <option value="{{ $kelas->id }}"
                            {{ $user->student && $user->student->kelas_id == $kelas->id ? 'selected' : '' }}>
                            {{ $kelas->nama_kelas ?? $kelas->kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Foto Profil -->
            <div class="mb-6">
                <label for="profile_photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Foto Profil
                </label>

                @if ($user->profile_photo_path)
                    <div class="mt-3">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Foto Saat Ini:</p>
                        <img src="{{ Storage::url($user->profile_photo_path) }}" alt="Foto Profil"
                            class="w-32 h-32 rounded-lg object-cover border border-gray-300 dark:border-gray-600">
                    </div>
                @endif

                <input type="file" name="profile_photo" id="profile_photo"
                    class="mt-4 block w-full text-sm text-gray-900 dark:text-gray-100 
                           border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer 
                           bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Format: JPG, PNG, maksimal 2MB</p>
            </div>

            <!-- Tombol Submit -->
            <button type="submit"
                class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition">
                Update
            </button>
        </form>
    </div>

    <script>
        const roleSelect = document.getElementById('role');
        const kelasField = document.getElementById('kelas-field');

        roleSelect.addEventListener('change', () => {
            if (roleSelect.value === 'siswa') {
                kelasField.classList.remove('hidden');
            } else {
                kelasField.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>

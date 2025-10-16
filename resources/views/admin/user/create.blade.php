<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <!-- Name -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                <input type="text" name="name" id="name"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm 
                           focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                    required>
            </div>

            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input type="email" name="email" id="email"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm 
                           focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                    required>
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Password
                </label>
                <input type="password" name="password" id="password"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm 
                           focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100" required>
            </div>
            <!-- Password Confirmation -->
            <div class="mb-4">
                <label class="block text-sm font-medium">Konfirmasi Password</label>
                <input type="password" name="password" id="password"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm 
                           focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100" required>
            </div>

              <!-- Role -->
            <div class="mb-6">
                <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                <select name="role" id="role"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm 
                           bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100" required>
                    <option value="admin">Admin</option>
                    <option value="guru" >Guru</option>
                    <option value="siswa">Siswa</option>
                </select>
            </div>

            <!-- Kelas (khusus siswa) -->
            <div id="kelas-wrapper" class="mb-4 hidden">
                <label class="block text-sm font-medium">Kelas</label>
                <select name="kelas_id" id="kelas_id"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm 
                           bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($classrooms as $classroom)
                    <option value="{{ $classroom->id }}">{{ $classroom->kelas }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>

    <script>
        const roleSelect = document.getElementById('role');
        const kelasWrapper = document.getElementById('kelas-wrapper');

        roleSelect.addEventListener('change', function() {
            if (this.value === 'siswa') {
                kelasWrapper.classList.remove('hidden');
            } else {
                kelasWrapper.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>
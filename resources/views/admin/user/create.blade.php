<x-app-layout>
    <div class="container mx-auto p-8 bg-white shadow-md rounded-lg mt-8">
        <h2 class="text-3xl font-semibold text-gray-800 mb-8">Add User</h2>
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Name Field -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Email Field -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Password Field -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Password Confirmation Field -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Role Field -->
            <div class="mb-6">
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" id="role" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500" required>
                    <option value="admin">Admin</option>
                    <option value="siswa">Siswa</option>
                    <option value="guru">Guru</option>
                </select>
            </div>

            <!-- Nama Siswa Field for Siswa -->
            <div class="mb-6" id="nama_siswa_field" style="display: none;">
                <label for="nama_siswa" class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                <input type="text" name="nama_siswa" id="nama_siswa" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Kelas Field for Siswa -->
            <div class="mb-6" id="kelas_field" style="display: none;">
                <label for="kelas_id" class="block text-sm font-medium text-gray-700">Kelas</label>
                <select name="kelas_id" id="kelas_id" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500">
                    @foreach($classrooms as $classroom)
                        <option value="{{ $classroom->id }}">{{ $classroom->kelas }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Nama Guru Field for Guru -->
            <div class="mb-6" id="nama_guru_field" style="display: none;">
                <label for="nama_guru" class="block text-sm font-medium text-gray-700">Nama Guru</label>
                <input type="text" name="nama_guru" id="nama_guru" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Add User</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('role').addEventListener('change', function() {
            var namaSiswaField = document.getElementById('nama_siswa_field');
            var kelasField = document.getElementById('kelas_field');
            var namaGuruField = document.getElementById('nama_guru_field');
            var namaSiswaInput = document.getElementById('nama_siswa');
            var kelasSelect = document.getElementById('kelas_id');
            var namaGuruInput = document.getElementById('nama_guru');

            // Reset required attributes first
            namaSiswaInput.removeAttribute('required');
            kelasSelect.removeAttribute('required');
            namaGuruInput.removeAttribute('required');

            // Show and hide fields based on role
            if (this.value === 'siswa') {
                namaSiswaField.style.display = 'block';
                kelasField.style.display = 'block';
                namaGuruField.style.display = 'none';

                // Set 'required' attribute for siswa fields
                namaSiswaInput.setAttribute('required', true);
                kelasSelect.setAttribute('required', true);
            } else if (this.value === 'guru') {
                namaSiswaField.style.display = 'none';
                kelasField.style.display = 'none';
                namaGuruField.style.display = 'block';

                // Set 'required' attribute for guru fields
                namaGuruInput.setAttribute('required', true);
            } else {
                namaSiswaField.style.display = 'none';
                kelasField.style.display = 'none';
                namaGuruField.style.display = 'none';
            }
        });
    </script>
</x-app-layout>

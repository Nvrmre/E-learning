<form action="{{ route('users.store') }}" method="POST">
    @csrf

    <!-- Name -->
    <div class="mb-4">
        <label class="block text-sm font-medium">Nama</label>
        <input type="text" name="name" class="w-full rounded border-gray-300" required>
    </div>

    <!-- Email -->
    <div class="mb-4">
        <label class="block text-sm font-medium">Email</label>
        <input type="email" name="email" class="w-full rounded border-gray-300" required>
    </div>

    <!-- Password -->
    <div class="mb-4">
        <label class="block text-sm font-medium">Password</label>
        <input type="password" name="password" class="w-full rounded border-gray-300" required>
    </div>

    <!-- Password Confirmation -->
    <div class="mb-4">
        <label class="block text-sm font-medium">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="w-full rounded border-gray-300" required>
    </div>

    <!-- Role -->
    <div class="mb-4">
        <label class="block text-sm font-medium">Role</label>
        <select name="role" id="role" class="w-full rounded border-gray-300" required>
            <option value="admin">Admin</option>
            <option value="guru">Guru</option>
            <option value="siswa">Siswa</option>
        </select>
    </div>

    <!-- Kelas (khusus siswa) -->
    <div id="kelas-wrapper" class="mb-4 hidden">
        <label class="block text-sm font-medium">Kelas</label>
        <select name="kelas_id" class="w-full rounded border-gray-300">
            <option value="">-- Pilih Kelas --</option>
            @foreach($classrooms as $classroom)
                <option value="{{ $classroom->id }}">{{ $classroom->kelas }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
</form>

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

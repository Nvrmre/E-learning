<x-app-layout>
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Daftar Pengguna</h1>

        <div class="mb-4">
            <a href="{{ route('users.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md">Add User</a>
        </div>

        <div class="mb-4">
            <form action="{{ route('users.index') }}" method="GET" class="inline-block">
                <select name="role" class="px-4 py-2 border border-gray-300 rounded-md">
                    <option value="">ALL</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="siswa" {{ request('role') === 'siswa' ? 'selected' : '' }}>Siswa</option>
                    <option value="guru" {{ request('role') === 'guru' ? 'selected' : '' }}>Guru</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Filter</button>
            </form>
        </div>

        @if($users->isEmpty())
            <p class="text-gray-600">Tidak ada data pengguna.</p>
        @else
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600">
                            <th class="px-6 py-3 text-left text-sm font-medium">ID</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Nama</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Sebagai</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $user->id }}</td>

                                <!-- Menampilkan Nama Berdasarkan Role -->
                                <td class="px-6 py-4 text-sm text-gray-800">
                                    @if($user->role === 'admin')
                                        {{ $user->name }} <!-- Nama admin dari kolom name -->
                                    @elseif($user->role === 'guru')
                                        {{ $user->teacher->nama_guru ?? 'Nama Guru Tidak Tersedia' }} <!-- Nama guru dari kolom nama_guru -->
                                    @elseif($user->role === 'siswa')
                                        {{ $user->student->nama_siswa ?? 'Nama Siswa Tidak Tersedia' }} <!-- Nama siswa dari kolom nama_siswa -->
                                    @else
                                        {{ $user->name }} <!-- Default untuk role lainnya -->
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-800">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $user->role }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">
                                  <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                  <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                  </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>

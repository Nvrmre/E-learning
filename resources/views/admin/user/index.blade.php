<x-app-layout>
    <div class="container mx-auto p-8 transition-colors duration-300">
        <h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-100 mb-6">
            Daftar Pengguna
        </h1>

        <!-- Tombol Add User -->
        <div class="mb-4">
            <a href="{{ route('users.create') }}"
                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                Add User
            </a>
        </div>

        <!-- Filter Role -->
        <div class="mb-4">
            <form action="{{ route('users.index') }}" method="GET" class="inline-block">
                <select name="role"
                    class="px-4 py-2 border border-gray-300 dark:border-gray-600 
                           rounded-md bg-white dark:bg-gray-800 
                           text-gray-800 dark:text-gray-100 transition-colors duration-300">
                    <option value="">ALL</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="siswa" {{ request('role') === 'siswa' ? 'selected' : '' }}>Siswa</option>
                    <option value="guru" {{ request('role') === 'guru' ? 'selected' : '' }}>Guru</option>
                </select>
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                    Filter
                </button>
            </form>
        </div>

        <!-- Tabel User -->
        @if($users->isEmpty())
            <p class="text-gray-600 dark:text-gray-400">Tidak ada data pengguna.</p>
        @else
            <div class="overflow-x-auto bg-white dark:bg-gray-900 shadow-md rounded-lg transition-colors duration-300">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300">
                            <th class="px-6 py-3 text-left text-sm font-medium">ID</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Nama</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Sebagai</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $user->id }}</td>

                                <!-- Nama Berdasarkan Role -->
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    @if($user->role === 'admin')
                                        {{ $user->name }}
                                    @elseif($user->role === 'guru')
                                        {{ $user->teacher->nama_guru ?? 'Nama Guru Tidak Tersedia' }}
                                    @elseif($user->role === 'siswa')
                                        {{ $user->student->nama_siswa ?? 'Nama Siswa Tidak Tersedia' }}
                                    @else
                                        {{ $user->name }}
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $user->role }}</td>

                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="text-blue-500 hover:underline dark:text-blue-400">
                                        Edit
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-500 hover:underline dark:text-red-400">
                                            Hapus
                                        </button>
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

<x-app-layout>
    <div class="container mx-auto p-8 bg-white shadow-md rounded-lg mt-8">
        <h2 class="text-3xl font-semibold text-gray-800 mb-8">Edit User</h2>
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Name Field -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Email Field -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Password Field -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500">
                <small class="text-gray-500">Leave blank to keep current password</small>
            </div>

            <!-- Role Field -->
            <div class="mb-6">
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" id="role" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500">
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="siswa" {{ $user->role == 'siswa' ? 'selected' : '' }}>Siswa</option>
                    <option value="guru" {{ $user->role == 'guru' ? 'selected' : '' }}>Guru</option>
                </select>
            </div>

            <!-- Class Field for Siswa -->
            @if($user->role == 'siswa')
            <div class="mb-6">
                <label for="class" class="block text-sm font-medium text-gray-700">Class</label>
                <input type="text" name="class" id="class" value="{{ $user->class }}" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500">
            </div>
            @endif

            <!-- Profile Photo -->
            <div class="mb-6">
                <label for="profile_photo" class="block text-sm font-medium text-gray-700">Profile Photo</label>
                <input type="file" name="profile_photo" id="profile_photo" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Submit Button -->
            <div class="mb-6">
                <button type="submit" class="w-full py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:ring-2 focus:ring-blue-500">Update Profile</button>
            </div>
        </form>
    </div>
</x-app-layout>

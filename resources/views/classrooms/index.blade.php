<x-header></x-header>
<div class="container mx-auto mt-8">
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="border border-gray-300 px-6 py-4 text-left">ID</th>
                    <th class="border border-gray-300 px-6 py-4 text-left">Nama Kursus</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classrooms as $classroom)
                <tr class="hover:bg-gray-100 transition-colors duration-300">
                    <td class="border border-gray-300 px-6 py-4">{{ $classroom->id }}</td>
                    <td class="border border-gray-300 px-6 py-4">{{ $classroom->kelas }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
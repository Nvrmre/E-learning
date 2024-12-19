<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <title>Document</title>
</head>

<body>
  <x-header></x-header>
  <div class="container mx-auto mt-8">
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
      <table class="min-w-full table-auto border-collapse border border-gray-200">
        <thead class="bg-blue-500 text-white">
          <tr>
            <th class="border border-gray-300 px-6 py-4 text-left">ID</th>
            <th class="border border-gray-300 px-6 py-4 text-left">Nama Kursus</th>
            <th class="border border-gray-300 px-6 py-4 text-left">Guru</th>
            <th class="border border-gray-300 px-6 py-4 text-left">---</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($courses as $course)
          <tr class="hover:bg-gray-100 transition-colors duration-300">
            <td class="border border-gray-300 px-6 py-4">{{ $course->id }}</td>
            <td class="border border-gray-300 px-6 py-4">{{ $course->mapel }}</td>
            <td class="border border-gray-300 px-6 py-4">{{ $course->guru_id }}</td>
            <a href="#"><td class="border border-gray-300 px-6 py-4">edit</td></a>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>
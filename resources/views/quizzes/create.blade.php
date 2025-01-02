<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Judul Halaman -->
        <h1 class="text-4xl font-extrabold text-center mb-6 text-gradient bg-clip-text text-transparent 
                    bg-gradient-to-r from-indigo-500 via-purple-600 to-pink-500 
                    shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
            Tambah Kuis
        </h1>

        <!-- Formulir Kuis -->
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg hover:shadow-2xl transition duration-300 ease-in-out transform hover:scale-105">
            <form action="{{ route('quizzes.store') }}" method="POST">
                @csrf

                <!-- Input Judul Kuis -->
                <div class="mb-6">
                    <label for="title" class="block text-lg font-medium text-gray-700">Judul Kuis</label>
                    <input type="text" name="title" id="title" class="form-control w-full mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <h3 class="text-2xl font-medium mb-4">Tambah Soal dan Jawaban</h3>

                <!-- Input Soal dan Jawaban -->
                <div id="questions">
                    <div class="question-block mb-6 p-6 border border-gray-200 rounded-lg shadow-sm">
                        <div class="mb-4">
                            <label for="question_text" class="block text-lg font-medium text-gray-700">Soal</label>
                            <textarea name="question_text[]" class="form-control w-full mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                        </div>

                        <!-- Jawaban A -->
                        <div class="mb-4">
                            <label for="answer_1" class="block text-lg font-medium text-gray-700">Jawaban A</label>
                            <input type="text" name="answer_1[]" class="form-control w-full mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <div class="mt-2">
                                <label class="inline-flex items-center text-sm text-gray-700">Benar</label>
                                <input type="radio" name="correct_answer[0]" value="0" class="ml-2" required>
                            </div>
                        </div>

                        <!-- Jawaban B -->
                        <div class="mb-4">
                            <label for="answer_2" class="block text-lg font-medium text-gray-700">Jawaban B</label>
                            <input type="text" name="answer_2[]" class="form-control w-full mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <div class="mt-2">
                                <label class="inline-flex items-center text-sm text-gray-700">Benar</label>
                                <input type="radio" name="correct_answer[0]" value="1" class="ml-2" required>
                            </div>
                        </div>

                        <!-- Jawaban C -->
                        <div class="mb-4">
                            <label for="answer_3" class="block text-lg font-medium text-gray-700">Jawaban C</label>
                            <input type="text" name="answer_3[]" class="form-control w-full mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <div class="mt-2">
                                <label class="inline-flex items-center text-sm text-gray-700">Benar</label>
                                <input type="radio" name="correct_answer[0]" value="2" class="ml-2" required>
                            </div>
                        </div>

                        <!-- Jawaban D -->
                        <div class="mb-4">
                            <label for="answer_4" class="block text-lg font-medium text-gray-700">Jawaban D</label>
                            <input type="text" name="answer_4[]" class="form-control w-full mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <div class="mt-2">
                                <label class="inline-flex items-center text-sm text-gray-700">Benar</label>
                                <input type="radio" name="correct_answer[0]" value="3" class="ml-2" required>
                            </div>
                        </div>

                        <hr class="border-t my-4">
                    </div>
                </div>

                <!-- Tombol untuk Menambah Soal -->
                <button type="button" class="btn btn-secondary bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-yellow-600 transition duration-200" id="add-question">Tambah Soal</button>

                <!-- Tombol Simpan -->
                <button type="submit" class="btn btn-primary mt-4 bg-blue-600 text-white py-3 px-6 rounded-lg shadow-md hover:bg-blue-700 transition duration-200">
                    Simpan Kuis
                </button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('add-question').addEventListener('click', function() {
            // Menyalin blok soal dan jawaban
            let questionBlock = document.querySelector('.question-block').cloneNode(true);
            document.getElementById('questions').appendChild(questionBlock);
        });
    </script>
</x-app-layout>

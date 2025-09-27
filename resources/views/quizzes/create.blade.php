<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Judul Halaman -->
        <h1 class="text-4xl font-extrabold text-center mb-6 
                   text-gray-700 dark:text-gray-100">
            Tambah Kuis
        </h1>

        <!-- Formulir Kuis -->
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 
                    p-7 rounded-lg shadow-lg 
                    hover:shadow-2xl transition duration-300 ease-in-out transform hover:scale-105">
            <form action="{{ route('quizzes.store') }}" method="POST">
                @csrf

                <!-- Input Judul Kuis -->
                <div class="mb-6">
                    <label for="title" class="block text-lg font-medium text-gray-700 dark:text-gray-200">
                        Judul Kuis
                    </label>
                    <input type="text" name="title" id="title" 
                           class="form-control w-full mt-2 p-3 
                                  border border-gray-300 dark:border-gray-600 
                                  rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 
                                  bg-white dark:bg-gray-700 
                                  text-gray-900 dark:text-gray-100"
                           required>
                </div>

                <h3 class="text-2xl font-medium mb-4 text-gray-700 dark:text-gray-100">
                    Tentukan Pertanyaan Dan Jawaban
                </h3>

                <!-- Input Soal dan Jawaban -->
                <div id="questions">
                    <div class="question-block mb-6 p-2 border border-gray-200 dark:border-gray-600 rounded-lg shadow-sm">
                        <div class="mb-4">
                            <label for="question_text" class="block text-lg font-medium text-gray-700 dark:text-gray-200">
                                Pertanyaan
                            </label>
                            <textarea name="question_text[]" 
                                      class="form-control w-full mt-2 p-3 
                                             border border-gray-300 dark:border-gray-600 
                                             rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 
                                             bg-white dark:bg-gray-700 
                                             text-gray-900 dark:text-gray-100"
                                      required></textarea>
                        </div>

                        <!-- Jawaban A -->
                        <div class="mb-4">
                            <label for="answer_1" class="block text-lg font-medium text-gray-700 dark:text-gray-200">
                                Jawaban A
                            </label>
                            <input type="text" name="answer_1[]" 
                                   class="form-control w-full mt-2 p-3 
                                          border border-gray-300 dark:border-gray-600 
                                          rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 
                                          bg-white dark:bg-gray-700 
                                          text-gray-900 dark:text-gray-100"
                                   required>
                            <div class="mt-2">
                                <label class="inline-flex items-center text-sm text-gray-700 dark:text-gray-200">Benar</label>
                                <input type="radio" name="correct_answer[0]" value="0" class="ml-2" required>
                            </div>
                        </div>

                        <!-- Jawaban B -->
                        <div class="mb-4">
                            <label for="answer_2" class="block text-lg font-medium text-gray-700 dark:text-gray-200">
                                Jawaban B
                            </label>
                            <input type="text" name="answer_2[]" 
                                   class="form-control w-full mt-2 p-3 
                                          border border-gray-300 dark:border-gray-600 
                                          rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 
                                          bg-white dark:bg-gray-700 
                                          text-gray-900 dark:text-gray-100"
                                   required>
                            <div class="mt-2">
                                <label class="inline-flex items-center text-sm text-gray-700 dark:text-gray-200">Benar</label>
                                <input type="radio" name="correct_answer[0]" value="1" class="ml-2" required>
                            </div>
                        </div>

                        <!-- Jawaban C -->
                        <div class="mb-4">
                            <label for="answer_3" class="block text-lg font-medium text-gray-700 dark:text-gray-200">
                                Jawaban C
                            </label>
                            <input type="text" name="answer_3[]" 
                                   class="form-control w-full mt-2 p-3 
                                          border border-gray-300 dark:border-gray-600 
                                          rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 
                                          bg-white dark:bg-gray-700 
                                          text-gray-900 dark:text-gray-100"
                                   required>
                            <div class="mt-2">
                                <label class="inline-flex items-center text-sm text-gray-700 dark:text-gray-200">Benar</label>
                                <input type="radio" name="correct_answer[0]" value="2" class="ml-2" required>
                            </div>
                        </div>

                        <!-- Jawaban D -->
                        <div class="mb-4">
                            <label for="answer_4" class="block text-lg font-medium text-gray-700 dark:text-gray-200">
                                Jawaban D
                            </label>
                            <input type="text" name="answer_4[]" 
                                   class="form-control w-full mt-2 p-3 
                                          border border-gray-300 dark:border-gray-600 
                                          rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 
                                          bg-white dark:bg-gray-700 
                                          text-gray-900 dark:text-gray-100"
                                   required>
                            <div class="mt-2">
                                <label class="inline-flex items-center text-sm text-gray-700 dark:text-gray-200">Benar</label>
                                <input type="radio" name="correct_answer[0]" value="3" class="ml-2" required>
                            </div>
                        </div>

                        <hr class="border-t my-4 border-gray-300 dark:border-gray-600">
                    </div>
                </div>

                <!-- Tombol untuk Menambah Soal -->
                <button type="button" id="add-question"
                        class="bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-yellow-600 transition duration-200">
                    Tambah Soal
                </button>

                <!-- Tombol Simpan -->
                <button type="submit" 
                        class="mt-4 bg-blue-500 text-white py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 transition duration-200">
                    Simpan Kuis
                </button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('add-question').addEventListener('click', function() {
            // Menyalin blok soal dan jawaban
            let questionBlock = document.querySelector('.question-block').cloneNode(true);

            // Reset input ketika ditambahkan
            questionBlock.querySelectorAll('input, textarea').forEach(el => {
                if (el.type === 'radio') {
                    el.checked = false;
                } else {
                    el.value = '';
                }
            });

            document.getElementById('questions').appendChild(questionBlock);
        });
    </script>
</x-app-layout>

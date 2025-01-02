<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold mb-6 text-center text-blue-600">{{ $quiz->title }}</h1>

        <form action="{{ route('quizzes.submit', $quiz->id) }}" method="POST" id="quiz-form">
            @csrf

            @foreach ($questions as $index => $question)
                <div class="card mb-6 p-6 bg-white shadow-lg rounded-lg transition-all transform duration-500 question-card" data-index="{{ $index }}" style="display: none;">
                    <div class="card-body">
                        <h5 class="card-title text-xl font-semibold text-gray-800 mb-4">{{ $question }}</h5>

                        <div class="form-group space-y-4">
                            @foreach ($answers[$index] as $answerIndex => $answer)
                                <div class="form-check flex items-center space-x-2">
                                    <input 
                                        type="radio" 
                                        name="answer_{{ $index }}" 
                                        value="{{ $answerIndex }}" 
                                        id="answer_{{ $index }}_{{ $answerIndex }}"
                                        class="form-check-input h-5 w-5 text-blue-600 border-gray-300 rounded-full focus:ring-2 focus:ring-blue-500"
                                        required
                                        onclick="nextQuestion({{ $index }})"
                                    >
                                    <label class="form-check-label text-gray-700 text-lg" for="answer_{{ $index }}_{{ $answerIndex }}">
                                        {{ $answer['answer_text'] }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

            <button type="submit" class="btn bg-green-600 text-white rounded-lg px-6 py-2 mt-6 mx-auto block shadow-md hover:bg-green-700 transition duration-300 transform scale-100 hover:scale-105" id="submit-btn" style="display: none;">
                Kirim Jawaban
            </button>
        </form>
    </div>

    <script>
        let currentQuestionIndex = 0;
        const questions = document.querySelectorAll('.question-card');
        const submitButton = document.getElementById('submit-btn');

        // Menampilkan soal pertama
        function showQuestion(index) {
            questions[index].style.display = 'block';
        }

        // Fungsi untuk menampilkan soal berikutnya setelah menjawab soal saat ini
        function nextQuestion(index) {
            // Menyembunyikan soal yang sudah dijawab
            questions[index].style.display = 'none';
            currentQuestionIndex++;

            // Menampilkan soal berikutnya
            if (currentQuestionIndex < questions.length) {
                showQuestion(currentQuestionIndex);
            } else {
                // Menampilkan tombol submit setelah semua soal dijawab
                submitButton.style.display = 'inline-block';
            }
        }

        // Menampilkan soal pertama pada saat halaman dimuat
        window.onload = () => {
            showQuestion(currentQuestionIndex);
        };
    </script>
</x-app-layout>

<x-app-layout>
    <div class="container mx-auto max-w-4xl px-4 py-8">

        <!-- Judul Halaman -->
        <h1 class="text-3xl font-semibold mb-6 text-center 
                   text-gray-800 dark:text-gray-100">
            {{ $quiz->title }} - Hasil Kuis
        </h1>

        <!-- Skor dan Persentase -->
        <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-lg text-center mb-6">
            <p class="text-xl font-bold text-gray-800 dark:text-gray-100">
                Skor Anda: 
                <span id="score" class="text-green-600 dark:text-green-400">{{ $score }}</span> 
                dari 
                <span>{{ $totalQuestions }}</span>
            </p>
            <p class="text-lg text-gray-700 dark:text-gray-300">
                Persentase: 
                <span id="percentage" class="text-green-600 dark:text-green-400">
                    {{ number_format($percentage, 2) }}%
                </span>
            </p>
        </div>

        <!-- Progress Bar Benar vs Salah -->
        <div class="mb-6">
            <!-- Jawaban Benar -->
            <h4 class="font-semibold text-lg mb-2 text-gray-800 dark:text-gray-100">
                Jawaban Benar: 
                <span id="correct-count" class="text-green-600 dark:text-green-400">
                    {{ $score }}
                </span>
            </h4>
            <div class="w-full bg-gray-300 dark:bg-gray-700 rounded-full h-6 mb-4">
                <div class="bg-green-600 h-6 rounded-full" id="correct-bar"></div>
            </div>

            <!-- Jawaban Salah -->
            <h4 class="font-semibold text-lg mb-2 text-gray-800 dark:text-gray-100">
                Jawaban Salah: 
                <span id="incorrect-count" class="text-red-600 dark:text-red-400">
                    {{ $totalQuestions - $score }}
                </span>
            </h4>
            <div class="w-full bg-gray-300 dark:bg-gray-700 rounded-full h-6">
                <div class="bg-red-600 h-6 rounded-full" id="incorrect-bar"></div>
            </div>
        </div>

        <!-- Skor Animasi -->
        <div class="text-center">
            <h3 class="font-semibold text-2xl mb-4 text-gray-800 dark:text-gray-100">
                Skor Anda:
            </h3>
            <p id="score-animation" class="text-4xl font-extrabold text-gray-800 dark:text-gray-100"></p>
        </div>

        <!-- Tombol Kembali -->
        <div class="text-center mt-8">
            <a href="{{ route('quizzes.index') }}" 
               class="inline-block px-6 py-2 bg-blue-600 text-white rounded-lg shadow-lg 
                      hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 transition duration-200">
                Kembali ke Daftar Kuis
            </a>
        </div>
    </div>

    <script>
        // Jalankan JavaScript setelah halaman dimuat
        window.addEventListener('DOMContentLoaded', function() {
            let scoreElement = document.getElementById('score-animation');
            let score = {{ $score }};
            let percentage = {{ $percentage }};

            // Animasi angka skor
            function animateScore() {
                let currentScore = 0;
                let interval = setInterval(function() {
                    if (currentScore < score) {
                        scoreElement.innerText = currentScore;
                        currentScore++;
                    } else {
                        clearInterval(interval);
                        scoreElement.innerText = score;
                    }
                }, 30);
            }

            animateScore();

            // Progress bar
            let correctBar = document.getElementById('correct-bar');
            let incorrectBar = document.getElementById('incorrect-bar');
            correctBar.style.transition = 'width 1s ease-in-out';
            incorrectBar.style.transition = 'width 1s ease-in-out';
            correctBar.style.width = `${percentage}%`;
            incorrectBar.style.width = `${100 - percentage}%`;
        });
    </script>
</x-app-layout>

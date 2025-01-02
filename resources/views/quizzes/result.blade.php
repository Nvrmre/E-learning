<x-app-layout>
    <div class="container mx-auto max-w-4xl px-4 py-8">
        <h1 class="text-3xl font-semibold mb-6 text-center">{{ $quiz->title }} - Hasil Kuis</h1>

        <!-- Skor dan Persentase -->
        <div class="bg-gray-100 p-6 rounded-lg shadow-lg text-center mb-6">
            <p class="text-xl font-bold">Skor Anda: <span id="score" class="text-green-600">{{ $score }}</span> dari <span>{{ $totalQuestions }}</span></p>
            <p class="text-lg">Persentase: <span id="percentage" class="text-green-600">{{ number_format($percentage, 2) }}%</span></p>
        </div>

        <!-- Progress Bar Benar vs Salah -->
        <div class="mb-6">
            <!-- Jawaban Benar -->
            <h4 class="font-semibold text-lg mb-2">Jawaban Benar: <span id="correct-count" class="text-green-600">{{ $score }}</span></h4>
            <div class="w-full bg-gray-300 rounded-full h-6 mb-4">
                <div class="bg-green-600 h-6 rounded-full" id="correct-bar"></div>
            </div>

            <!-- Jawaban Salah -->
            <h4 class="font-semibold text-lg mb-2">Jawaban Salah: <span id="incorrect-count" class="text-red-600">{{ $totalQuestions - $score }}</span></h4>
            <div class="w-full bg-gray-300 rounded-full h-6">
                <div class="bg-red-600 h-6 rounded-full" id="incorrect-bar"></div>
            </div>
        </div>

        <!-- Skor Animasi -->
        <div class="text-center">
            <h3 class="font-semibold text-2xl mb-4">Skor Anda:</h3>
            <p id="score-animation" class="text-4xl font-extrabold text-gray-800"></p>
        </div>

        <a href="{{ route('quizzes.index') }}" class="mt-6 inline-block px-6 py-2 bg-blue-600 text-white rounded-lg shadow-lg hover:bg-blue-700 transition duration-200">Kembali ke Daftar Kuis</a>
    </div>

    <script>
        // Memastikan JavaScript dijalankan setelah halaman sepenuhnya dimuat
        window.addEventListener('DOMContentLoaded', function() {
            // Ambil elemen-elemen yang diperlukan
            let scoreElement = document.getElementById('score-animation');
            let score = {{ $score }};
            let maxScore = {{ $totalQuestions }};
            let percentage = {{ $percentage }};

            // Fungsi untuk animasi skor
            function animateScore() {
                let currentScore = 0;
                let interval = setInterval(function() {
                    if (currentScore < score) {
                        scoreElement.innerText = currentScore;
                        currentScore++;
                    } else {
                        clearInterval(interval);
                        scoreElement.innerText = score; // Pastikan skor akhirnya benar
                    }
                }, 30); // kecepatan animasi
            }

            // Menampilkan skor animasi saat halaman dimuat
            animateScore();

            // Update progress bar untuk benar dan salah
            let correctBar = document.getElementById('correct-bar');
            let incorrectBar = document.getElementById('incorrect-bar');

            // Menambahkan transisi animasi untuk progress bar
            correctBar.style.transition = 'width 1s ease-in-out';
            incorrectBar.style.transition = 'width 1s ease-in-out';

            correctBar.style.width = `${percentage}%`;
            incorrectBar.style.width = `${100 - percentage}%`;
        });
    </script>
</x-app-layout>

<?php

// app/Http/Controllers/QuizController.php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function __construct()
    {
        // Menggunakan middleware role untuk memastikan hanya admin dan guru yang bisa menambah kuis
        $this->middleware('role:admin,guru')->only(['create', 'store']);
    }

    // Menampilkan daftar kuis untuk semua user (termasuk siswa)
    public function index()
    {
        $quizzes = Quiz::all();
        return view('quizzes.index', compact('quizzes'));
    }

    // Menampilkan halaman untuk membuat kuis (hanya admin dan guru)
    public function create()
    {
        return view('quizzes.create');
    }

    // Menyimpan kuis yang baru dibuat (hanya admin dan guru)
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'question_text' => 'required|array',
            'question_text.*' => 'required|string|max:255',
            'answer_1' => 'required|array',
            'answer_1.*' => 'required|string|max:255',
            'answer_2' => 'required|array',
            'answer_2.*' => 'required|string|max:255',
            'answer_3' => 'required|array',
            'answer_3.*' => 'required|string|max:255',
            'answer_4' => 'required|array',
            'answer_4.*' => 'required|string|max:255',
        ]);

        // Menyimpan kuis
        $quiz = new Quiz();
        $quiz->title = $request->title;

        // Menyusun data soal dan jawaban dalam format JSON
        $questions = [];
        $answers = [];

        foreach ($request->question_text as $index => $questionText) {
            // Menyusun soal
            $questions[] = $questionText;

            // Menyusun jawaban dan menandai jawaban yang benar
            $questionAnswers = [];
            for ($i = 1; $i <= 4; $i++) {
                $questionAnswers[] = [
                    'answer_text' => $request->{"answer_$i"}[$index],
                    'is_correct' => ($request->input("correct_answer.$index") == ($i - 1)) ? true : false,
                ];
            }
            $answers[] = $questionAnswers;
        }

        // Menyimpan data soal dan jawaban dalam format JSON
        $quiz->questions = json_encode($questions); // Pastikan disimpan sebagai JSON
        $quiz->answers = json_encode($answers); // Pastikan disimpan sebagai JSON

        // Menyimpan ke database
        $quiz->save();

        return redirect()->route('quizzes.index')->with('success', 'Kuis berhasil ditambahkan.');
    }

    // Menampilkan halaman kuis untuk mengerjakan
    public function show(Quiz $quiz)
    {
        // Decode JSON yang disimpan di kolom questions dan answers
        $questions = json_decode($quiz->questions, true);
        $answers = json_decode($quiz->answers, true);

        return view('quizzes.show', compact('quiz', 'questions', 'answers'));
    }

    // Menangani pengiriman jawaban dari siswa
    public function submit(Request $request, Quiz $quiz)
    {
        // Ambil soal dan jawaban yang disimpan
        $questions = json_decode($quiz->questions, true);
        $answers = json_decode($quiz->answers, true);

        $score = 0;
        $totalQuestions = count($questions);

        // Loop melalui soal dan bandingkan dengan jawaban siswa
        foreach ($questions as $index => $question) {
            $correctAnswer = $answers[$index];

            // Periksa apakah jawaban siswa benar
            $studentAnswer = $request->input("answer_$index");

            if ($correctAnswer[$studentAnswer]['is_correct'] ?? false) {
                $score++;
            }
        }

        // Hitung skor akhir dan kirimkan hasilnya ke tampilan
        $percentage = ($score / $totalQuestions) * 100;
        return view('quizzes.result', compact('quiz', 'score', 'totalQuestions', 'percentage'));
    }
    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);

        // Pastikan hanya admin atau guru yang dapat menghapus
        if (auth()->user()->role == 'admin' || auth()->user()->role == 'guru') {
            $quiz->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('quizzes.index')->with('success', 'Kuis berhasil dihapus.');
        }

        return redirect()->route('quizzes.index')->with('error', 'Anda tidak memiliki izin untuk menghapus kuis ini.');
    }


}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Course;
use App\Models\Test;
use App\Models\SelfStudyMaterial;
use App\Models\Question;
use App\Models\Answer;
use App\Models\UserAnswer;
use App\Models\TestResult;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use function GuzzleHttp\default_ca_bundle;
use Illuminate\Support\Facades\DB;
class EducationController extends Controller
{
    //
    public function index() {
        return view("education.index");
    }

    public function showCourses(Request $request) 
    {
        $user = $request->user();
        $paysIds = Payment::where(['user_id' => $user->id])->where('status', '!=', 'failed')->pluck('course_id')->toArray();;
        Log::debug($paysIds);
        /* foreach ($pays as $pay) {

        } */
        /* $courses = Course::where(['user_id' => $user->id, 'type' => 'course'])->get(); */
        $courses = Course::whereIn('id', $paysIds)->get();

        return view('education.courses', compact('courses'));
        
    }

    public function showCourse(Request $request, $course_id)
    {
        $user = $request->user();
        $course = Course::find($course_id);
        /* return $course; */
        return view('education.course', compact('course'));
        
    }

    public function showEvent(Request $request, $course_id, $id)
    {
        $user = $request->user();
       
        $event = Event::find($id);
        Log::debug($event);
        switch ($event->type) {
            case 'selfStudyMaterial':
                $selfStudyMaterial = SelfStudyMaterial::where(['event_id' => $id])->first();
                
                return redirect()->route('education.showSelfStudyMaterial', ['id' => $selfStudyMaterial->id, 'course_id' => $course_id]);
                /* return view('education.events.lection', compact('event')); */
            case 'test':
                        
                $test = Test::where(['event_id' => $id])->first();
                return redirect()->route('education.showTest', ['id' => $test->id, 'course_id' => $course_id]);
            default:
                return view('education.events.selfStudyMaterial', compact('event'));
            
        
        }
    }

    public function showTest(Request $request, $course_id, $id)
    {
        $user = $request->user();
        $test = Test::find($id);
        return view('education.events.tests.testPreview', compact('test', 'course_id'));
    }

    public function startTest(Request $request, $id)
    {
        $user = $request->user();
        /* $questions = 
        DB::table('questions')->where('test_id', $id)
        ->join('answers', 'answers.question_id', '=', 'questions.id')->get(); */
        $questions = Question::with('answers')->where(['test_id' => $id])->get();
        
        /* $test = Test::find($id); */
        return view('education.events.tests.question', compact('questions'));
    }

    public function submitTest(Request $request, $id) 
    {
        // Получаем текущего пользователя и тест
        $user = $request->user(); // Используем авторизованного пользователя
        $test = Test::findOrFail($id); // Проверяем, что тест существует
        
        // Логируем тело запроса для отладки
        $body = $request->all();
        
        // Проверяем, что ответы переданы
        if (!isset($body['answers']) || empty($body['answers'])) {
            return response()->json(['message' => 'No answers provided'], 400);
        }
        $score = 0;
        $maxScore = 0;
        // Проходим по каждому ответу
        foreach ($body['answers'] as $questionId => $answerId) {
            $questionScore = $this->getQuestionMaxScore($questionId);
            $maxScore += $questionScore;
            // Проверяем, является ли ответ массивом (чекбоксы)
            if (is_array($answerId)) {
                foreach ($answerId as $singleAnswerId) {
                    $userAnswer = $this->saveAnswer($user->id, $test->id, $singleAnswerId);
                    $score += $userAnswer->score;
                }
            } else {
                // Сохраняем одиночный ответ (радио-кнопки)
                $userAnswer = $this->saveAnswer($user->id, $test->id, $answerId);
                $score += $userAnswer->score;
            }
        }
        
        // Вычисляем процент правильных ответов
        /* $score = round($score / $maxScore * 100); */

        $testResult =  TestResult::create([
            'user_id' => $user->id,
            'test_id' => $test->id,
            'score' => $score,
            'max_score' => $maxScore,
        ]);
        return view('education.events.tests.result', compact('testResult'));
        return response()->json(['message' => 'Answers submitted successfully. Score: ' . $score . ' ' . $TestResult]);
    }

    /**
     * Метод для сохранения ответа
     */
    protected function saveAnswer($userId, $testId, $answerId)
    {
        // Допустим, у ответа может быть привязан балл, поэтому получаем ответ из базы
        $answer = Answer::find($answerId);
        if (!$answer) {
            Log::warning("Answer with ID {$answerId} not found.");
            return;
        }

        // Сохраняем ответ пользователя
        $userAnswer = UserAnswer::create([
            'user_id' => $userId,
            'test_id' => $testId,
            'answer_id' => $answerId,
            'score' => $answer->score ?? 0, // Пример получения баллов
            'textAnswer' => null // Используйте для текстовых вопросов, если они есть
        ]);
        return $userAnswer;
    }

    protected function getQuestionMaxScore($questionId)
    {
        // Допустим, у ответа может быть привязан балл, поэтому получаем ответ из базы
        /* $answer = Question::find($questionId); */
        $question = Question::with('answers')->where(['id' => $questionId])->first();
        if (!$question) {
            Log::warning("Question with ID {$question} not found.");
            return;
        }
        $score = 0;
        foreach ($question->answers as $answer) {
            $score += $answer->score;
        }

        // Сохраняем ответ пользователя
        
        return $score;
    }

    public function showSelfStudyMaterial(Request $request, $id)
    {
        $user = User::find($request->user());
        $selfStudyMaterial = SelfStudyMaterial::find($id);
        return view('education.events.selfStudyMaterial', compact('selfStudyMaterial'));
    }

    public function showQuestion(Request $request, $test_id, $question_id)
    {
        $user = User::find($request->user());
        $test = Test::find($test_id);
        $question = Question::find($question_id);
        $answers = Answer::where(['question_id' => $question_id])->get();
        return view('education.events.tests.question', compact(['question', 'answers']));
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Test;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Event;
use App\Models\Course;
use App\Models\EventStatus;
class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventStatus1 = EventStatus::create(['status' => 'notActive']);
        $eventStatus2 = EventStatus::create(['status' => 'inProgress']);
        $eventStatus3 = EventStatus::create(['status' => 'ended']);
        $course = Course::create([
            'name' => 'Основы теории и практики нейропсихологии', 
            'description' => 'Авторский курс д.п.н., профессора Татьяны Григорьевны Визель',
            'image' => '',
            'start_date' => '2024-11-29',
            'end_date' => '2025-03-21',
            'start_time' => '08:00:00',
            'end_time' => '21:00:00',
            'status' => 'inProgress',
            'price' => '30000',
        ]);
        $event = Event::create([
            'name' => 'СТРОЕНИЕ И ФУНКЦИИ ГОЛОВНОГО МОЗГА ЧЕЛОВЕКА ', 
            'description' => 'Из истории изучения головного мозга человека. Головной мозг человека и его отделы. Поля коры мозга. Проводящие пути мозга',
            'course_id' => $course->id,
            'image' => '/img/hero_main.jpg',
            'start_date' => '2024-11-29',
            'end_date' => '2024-11-29',
            'start_time' => '08:00:00',
            'end_time' => '21:00:00',
            'status' => 'inProgress',
            'type'=>'selfStudyMaterial'
        ]);
        $eventTest = Event::create([
            'name' => 'Тест по теме "СТРОЕНИЕ И ФУНКЦИИ ГОЛОВНОГО МОЗГА ЧЕЛОВЕКА"', 
            'description' => 'Тест по теме "СТРОЕНИЕ И ФУНКЦИИ ГОЛОВНОГО МОЗГА ЧЕЛОВЕКА"',
            'course_id' => $course->id,
            'image' => '/img/hero_main.jpg',
            'start_date' => '2024-11-29',
            'end_date' => '2024-11-29',
            'start_time' => '08:00:00',
            'end_time' => '21:00:00',
            'status' => 'inProgress',
            'type'=>'test'
        ]);
        $test = Test::create([
            'title' => 'Строение головного мозга', 
            'description' => 'Тест по теме "Строение головного мозга"',
            'event_id' => $eventTest->id,
        ]);
        $question1 = Question::create([
            'test_id' => $test->id, 
            'text' => '1.	Из каких основных частей состоит центральная нервная система человека?',
        ]);
        $question2 = Question::create([
            'test_id' => $test->id, 
            'text' => '2.	Основными единицами нервной системы являются нейроны',
        ]);
        $question3 = Question::create([
            'test_id' => $test->id, 
            'text' => '3.	Каково количество нейронов в головном мозге человека: ',
        ]);
        $question4 = Question::create([
            'test_id' => $test->id, 
            'text' => '4.	Какой процент от веса тела составляет вес головного мозга у человека? ',
        ]);
        $question5 = Question::create([
            'test_id' => $test->id, 
            'text' => '5.	Из скольких долей (модальностей) состоит кора головного мозга человека? ',
        ]);
        $question6 = Question::create([
            'test_id' => $test->id, 
            'text' => '6.	Как обозначаются полушария мозга человека?',
        ]);
        $question7 = Question::create([
            'test_id' => $test->id, 
            'text' => '7.	Пропорции каких полей коры мозга зашифровал У.Пенфилд в своем Гомункулусе ',
        ]);
        $question8 = Question::create([
            'test_id' => $test->id, 
            'text' => '8.	Какие структуры головного мозга обеспечивают выработку двигательных координаций?',
        ]);
        $question9 = Question::create([
            'test_id' => $test->id, 
            'text' => '9.	Какова функция желудочков мозга? ',
        ]);
        $question10 = Question::create([
            'test_id' => $test->id, 
            'text' => '10.	В какой области мозга расположены ядра черепно-мозговых нервов?',
        ]);

        $answer11 = Answer::create(['question_id' => $question1->id, 'text' => 'головной и спинной мозг', 'isRight' => 1]);
        $answer12 = Answer::create(['question_id' => $question1->id, 'text' => 'черепно-мозговые нервы', 'isRight' => 0, 'score' => 0]);
        $answer13 = Answer::create(['question_id' => $question1->id, 'text' => 'головной мозг и черепно-мозговые нервы', 'isRight' => 0, 'score' => 0]);
        $answer14 = Answer::create(['question_id' => $question1->id, 'text' => 'спинной мозг и черепно-мозговые нервы', 'isRight' => 0, 'score' => 0]);

        
        $answer21 = Answer::create(['question_id' => $question2->id, 'text' => 'нейроны', 'isRight' => 1]);
        $answer22 = Answer::create(['question_id' => $question2->id, 'text' => 'глиальные клетки', 'isRight' => 0, 'score' => 0]);
        $answer23 = Answer::create(['question_id' => $question2->id, 'text' => 'звездчатые клетки', 'isRight' => 0, 'score' => 0]);
        $answer24 = Answer::create(['question_id' => $question2->id, 'text' => 'борозды головного мозга ', 'isRight' => 0, 'score' => 0]);
        
        /* 
        3.	Каково количество нейронов в головном мозге человека: 
100 миллиардов 
100 миллионов
100 тысяч
100 нейронов



        */
        $answer31 = Answer::create(['question_id' => $question3->id, 'text' => '100 миллиардов ', 'isRight' => 1]);
        $answer32 = Answer::create(['question_id' => $question3->id, 'text' => '100 миллионов', 'isRight' => 0, 'score' => 0]);
        $answer33 = Answer::create(['question_id' => $question3->id, 'text' => '100 тысяч', 'isRight' => 0, 'score' => 0]);
        $answer34 = Answer::create(['question_id' => $question3->id, 'text' => '100 нейронов', 'isRight' => 0, 'score' => 0]);
        
        /* 4.	Какой процент от веса тела составляет вес головного мозга у человека? 
2%
10 %
20 %
25% 
*/
        $answer41 = Answer::create(['question_id' => $question4->id, 'text' => '2%', 'isRight' => 1]);
        $answer42 = Answer::create(['question_id' => $question4->id, 'text' => '10 %', 'isRight' => 0, 'score' => 0]);
        $answer43 = Answer::create(['question_id' => $question4->id, 'text' => '20 %', 'isRight' => 0, 'score' => 0]);
        $answer44 = Answer::create(['question_id' => $question4->id, 'text' => '25% ', 'isRight' => 0, 'score' => 0]);
        
        /* 
5.	Из скольких долей (модальностей) состоит кора головного мозга человека? 
из четырех
из двух
из трех 
из шести

 */
        $answer51 = Answer::create(['question_id' => $question5->id, 'text' => 'из четырех', 'isRight' => 1]);
        $answer52 = Answer::create(['question_id' => $question5->id, 'text' => 'из двух', 'isRight' => 0, 'score' => 0]);
        $answer53 = Answer::create(['question_id' => $question5->id, 'text' => 'из трех ', 'isRight' => 0, 'score' => 0]);
        $answer54 = Answer::create(['question_id' => $question5->id, 'text' => 'из шести', 'isRight' => 0, 'score' => 0]);
        
        /* 6.	Как обозначаются полушария мозга человека?
правое и левое
переднее и заднее
верхнее и нижнее
большое и маленькое 

 */

        $answer61 = Answer::create(['question_id' => $question6->id, 'text' => 'правое и левое', 'isRight' => 1]);
        $answer62 = Answer::create(['question_id' => $question6->id, 'text' => 'переднее и заднее', 'isRight' => 0, 'score' => 0]);
        $answer63 = Answer::create(['question_id' => $question6->id, 'text' => 'верхнее и нижнее', 'isRight' => 0, 'score' => 0]);
        $answer64 = Answer::create(['question_id' => $question6->id, 'text' => 'большое и маленькое ', 'isRight' => 0, 'score' => 0]);
        
        /* 
        7.	Пропорции каких полей коры мозга зашифровал У.Пенфилд в своем Гомункулусе 
первичных полей моторной и сенсорной коры
вторичных полей зрительной коры
вторичных  и третичных полей височной коры
вторичных полей теменной коры 


        */
        $answer71 = Answer::create(['question_id' => $question7->id, 'text' => 'первичных полей моторной и сенсорной коры', 'isRight' => 1]);
        $answer72 = Answer::create(['question_id' => $question7->id, 'text' => 'вторичных полей зрительной коры', 'isRight' => 0, 'score' => 0]);
        $answer73 = Answer::create(['question_id' => $question7->id, 'text' => 'вторичных  и третичных полей височной коры', 'isRight' => 0, 'score' => 0]);
        $answer74 = Answer::create(['question_id' => $question7->id, 'text' => 'вторичных полей теменной коры ', 'isRight' => 0, 'score' => 0]);
        
        /* 
        8.	Какие структуры головного мозга обеспечивают выработку двигательных координаций?
базальные ядра и мозжечок
черепно-мозговые нервы
кора головного мозга
спинной мозг

        */
        $answer81 = Answer::create(['question_id' => $question8->id, 'text' => 'базальные ядра и мозжечок', 'isRight' => 1]);
        $answer82 = Answer::create(['question_id' => $question8->id, 'text' => 'черепно-мозговые нервы', 'isRight' => 0, 'score' => 0]);
        $answer83 = Answer::create(['question_id' => $question8->id, 'text' => 'кора головного мозга', 'isRight' => 0, 'score' => 0]);
        $answer84 = Answer::create(['question_id' => $question8->id, 'text' => 'спинной мозг', 'isRight' => 0, 'score' => 0]);
        

        /* 

9.	Какова функция желудочков мозга? 
циркуляция цереброспинальной жидкости
когнитивная
анализаторная
эмоциональная
  */
        $answer91 = Answer::create(['question_id' => $question9->id, 'text' => 'циркуляция цереброспинальной жидкости', 'isRight' => 1]);
        $answer92 = Answer::create(['question_id' => $question9->id, 'text' => 'когнитивная', 'isRight' => 0, 'score' => 0]);
        $answer93 = Answer::create(['question_id' => $question9->id, 'text' => 'анализаторная', 'isRight' => 0, 'score' => 0]);
        $answer94 = Answer::create(['question_id' => $question9->id, 'text' => 'эмоциональная', 'isRight' => 0, 'score' => 0]);
        /* 
10.	В какой области мозга расположены ядра черепно-мозговых нервов?
в стволе мозга
в коре мозга
в подкорке 
в спинном мозге */
        $answer101 = Answer::create(['question_id' => $question10->id, 'text' => 'в стволе мозга', 'isRight' => 1]);
        $answer102 = Answer::create(['question_id' => $question10->id, 'text' => 'в коре мозга', 'isRight' => 0, 'score' => 0]);
        $answer103 = Answer::create(['question_id' => $question10->id, 'text' => 'в подкорке ', 'isRight' => 0, 'score' => 0]);
        $answer104 = Answer::create(['question_id' => $question10->id, 'text' => 'в спинном мозге', 'isRight' => 0, 'score' => 0]);

    }
}

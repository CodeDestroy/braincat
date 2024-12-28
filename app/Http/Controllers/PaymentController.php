<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use App\Models\Course;
use App\Models\CourseRegistration; 

class PaymentController extends Controller
{


    public function enterprise($course, $freq) {
        return view('payments.enterprisePay');

    }

    public function privilege( $course, $freq, $sum,) {
        if (!auth()->user()) {
            return  redirect()->route('login');
        }
        else {
            $courseRegistration = CourseRegistration::where('user_id', auth()->user()->id)
                                                    ->where('course_id', $course)
                                                    ->first();
            
            //if (!$courseRegistration->managerCheckedOut) {
            //    return view('payments.userIsCheckingProgress', compact(['freq', 'sum']));
            //}
            //else {
                if ($course != 1)
                    return view('payments.nikolaeva.privilegePay', compact(['freq', 'sum']));
        
                return view('payments.privilegePay', compact(['freq', 'sum']));
            //}
        }
        
    }
    public function base($course, $freq, $sum) {
        if ($course != 1)
            return view('payments.nikolaeva.basePay', compact(['freq', 'sum']));
        return view('payments.basePay', compact(['freq', 'sum']));

    }

    public function student($course, $freq, $sum) {
        $courseRegistration = CourseRegistration::where('user_id', auth()->user()->id)
            ->where('course_id', $course)
            ->first();
        if ($courseRegistration->isStudent)    
            return view('payments.nikolaeva.student', compact(['freq', 'sum']));
        else
            return view('payments.nikolaeva.basePay', compact(['freq', '3000']));
    }

    public function index($tier, $course, $freq, $price)
    {
        if (!auth()->user()) {
            return  redirect()->route('login');
        }
        $user = User::find(auth()->user()->id);
        
        $courseRegistration = CourseRegistration::where('user_id', $user->id)
                                                        ->where('course_id', $course)
                                                        ->first();
        
                                                        /* 
        'isAPPCP',
        'isHealthyChild',
        'isStudent',
        'isLegal'
        */
        if ($courseRegistration) {
            switch ($tier) {
                case 'tier-base':
                    if ( $courseRegistration->isAPPCP || 
                        ($courseRegistration->isHealthyChildGk && !$courseRegistration->isLegalHealthyChildGK) || 
                        $courseRegistration->isStudent ||
                        ($courseRegistration->isHealthyChildFranch && !$courseRegistration->isLegalHealthyChildFranch)                        ) {
                        //Привилегия
                        return redirect('/payment/privilege/' . $course . '/' . $freq . '/22000');
                    } else if ($courseRegistration->isLegalHealthyChildFranch || $courseRegistration->isLegalHealthyChildGK) {
                        //Льгота
                        return redirect('/payment/enterprise/' . $course . '/' . $freq );
                    }
                    else {
                        //База
                        return redirect('/payment/base/' . $course . '/' . $freq . '/30000');
                    }
                    break;
                case 'tier-privilege':
                    //если льготный
                    if ( $courseRegistration->isAPPCP || 
                        ($courseRegistration->isHealthyChildGk && !$courseRegistration->isLegalHealthyChildGK) || 
                        $courseRegistration->isStudent ||
                        ($courseRegistration->isHealthyChildFranch && !$courseRegistration->isLegalHealthyChildFranch)                        ) {
                        //Привилегия
                        return redirect('/payment/privilege/' . $course . '/' . $freq . '/22000/');
                    } else if ($courseRegistration->isLegalHealthyChildFranch || $courseRegistration->isLegalHealthyChildGK) {
                        //Льгота
                        return redirect('/payment/enterprise/' . $course . '/' . $freq);
                    }
                    else {
                        //База
                        return redirect('/payment/base/' . $course . '/' . $freq . '/30000');
                    }
                    break;
                case 'tier-enterprise':
                    //если льготный
                    if ( $courseRegistration->isAPPCP || 
                        ($courseRegistration->isHealthyChildGk && !$courseRegistration->isLegalHealthyChildGK) || 
                        $courseRegistration->isStudent ||
                        ($courseRegistration->isHealthyChildFranch && !$courseRegistration->isLegalHealthyChildFranch)                        ) {
                        //Привилегия
                        return redirect('/payment/privilege/' . $course . '/' . $freq . '/22000');
                    } else if ($courseRegistration->isLegalHealthyChildFranch || $courseRegistration->isLegalHealthyChildGK) {
                        //Льгота
                        return redirect('/payment/enterprise/' . $course . '/' . $freq);
                    }
                    else {
                        //База
                        return redirect('/payment/base/' . $course . '/' . $freq . '/30000');
                    }
                    break;
                case 'tier-base2':    
                    if ( $courseRegistration->isStudent)
                        return redirect('/payment/students/' . $course . '/' . $freq . '/1250');
                    elseif ($courseRegistration->isHealthyChildGk || $courseRegistration->isAPPCP || $courseRegistration->isHealthyChild)  
                        return redirect('/payment/privilege/' . $course . '/' . $freq . '/2500');
                    else
                        return redirect('/payment/base/' . $course . '/' . $freq . '/3000');
                case 'tier-privilege2':
                    if ( $courseRegistration->isStudent)
                        return redirect('/payment/students/' . $course . '/' . $freq . '/1250');
                    elseif ($courseRegistration->isHealthyChildGk || $courseRegistration->isAPPCP || $courseRegistration->isHealthyChild)  
                        return redirect('/payment/privilege/' . $course . '/' . $freq . '/2500');
                    else
                        return redirect('/payment/base/' . $course . '/' . $freq . '/3000');
                case 'tier-students':
                    if ( $courseRegistration->isStudent)
                        return redirect('/payment/students/' . $course . '/' . $freq . '/1250');
                    elseif ($courseRegistration->isHealthyChildGk || $courseRegistration->isAPPCP || $courseRegistration->isHealthyChild)  
                        return redirect('/payment/privilege/' . $course . '/' . $freq . '/2500');
                    else
                        return redirect('/payment/base/' . $course . '/' . $freq . '/3000');

            }
            
            
        }
        else {
            return redirect()->route('profile.general');
        }

       
        /* if ($user->) */
        return $price;
        return view('payment');
    }

    public function success(Request $request, $course_id, $sum, $freq)//: RedirectResponse
    {   

        $user = User::find($request->user()->id);
        $course = Course::find( $course_id);
        /* $payment = Payment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'amount' => $sum,
            'status' => 'success',
            'freq' => $freq
        ]); */
        if (!$course) return view('errors.404');
        if ($freq == 100) {
            $payment = Payment::updateOrCreate(
                ['user_id' => $user->id, 'freq' => $freq, 'course_id' => $course->id,],
                [
                    'amount' => $sum,
                    'status' => 'success another',
                ]
            );

            /* $payment = Payment::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'amount' => $sum,
                'status' => 'success',
                'freq' => $freq
            ]); */
        }
        else {
            $payment = Payment::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'amount' => $sum,
                'status' => 'success 50',
                'freq' => $freq
            ]);
        }
        
        
        //return redirect()->route('dashboard')->with('success', 'Оплата прошла успешно!');
        // Проверка подписи (для подтверждения подлинности ответа)
        /* $signature = $request->input('SignatureValue');
        $isValid = $this->validateSignature($request->all(), $signature); */

        /* if ($isValid) {
            // Здесь можно обновить статус платежа в БД
            // Например, найти заказ по ID и отметить как оплаченный

            return redirect()->route('dashboard')->with('success', 'Оплата прошла успешно!');
        } else {
            return redirect()->route('dashboard')->with('error', 'Ошибка подтверждения оплаты.');
        } */
        return view('payments.success');
    }

    public function fail(Request $request,$course, $sum, $freq)
    {
        $payment = Payment::create([
            'user_id' => $user->id,
            'course_id' => $course,
            'amount' => $sum,
            'status' => 'failed',
            'freq' => $freq
        ]);
        return view('payments.fail');
        //return redirect()->route('dashboard')->with('error', 'Оплата не прошла. Попробуйте ещё раз.');
    }
    

    // Валидация подписи ответа
    private function validateSignature($data, $signature)
    {
        $merchantPass2 = config('services.robokassa.pass2'); // Пароль #2 из настроек Robokassa

        $expectedSignature = md5("{$data['OutSum']}:{$data['InvId']}:$merchantPass2");

        return strtoupper($expectedSignature) === strtoupper($signature);
    }
}

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


    public function enterprise($freq) {
        return view('payments.enterprisePay');

    }

    public function privilege($freq, $sum) {
        if (!auth()->user()) {
            return  redirect()->route('login');
        }
        else {
            $courseRegistration = CourseRegistration::where('user_id', auth()->user()->id)->first();

            if (!$courseRegistration->managerCheckedOut) {
                return view('payments.userIsCheckingProgress', compact(['freq', 'sum']));
            }
            else {
                return view('payments.privilegePay', compact(['freq', 'sum']));
            }
        }
        
    }
    public function base($freq, $sum) {
        return view('payments.basePay', compact(['freq', 'sum']));

    }

    public function index($tier, $freq, $price)
    {
        if (!auth()->user()) {
            return  redirect()->route('login');
        }
        $user = User::find(auth()->user()->id);
        
        $courseRegistration = CourseRegistration::where('user_id', $user->id)->first();
        /* 
        'isAPPCP',
        'isHealthyChild',
        'isStudent',
        'isLegal'
        */
        if ($user->hasSecondStep) {
            switch ($tier) {
                case 'tier-base':
                    /*  
                    'isAPPCP',
                    'isHealthyChildGk',
                    'isHealthyChildFranch',
                    'isLegalHealthyChildGK',
                    'isStudent',
                    'isLegalHealthyChildFranch',
                    */
                    if ( $courseRegistration->isAPPCP || 
                        ($courseRegistration->isHealthyChildGk && !$courseRegistration->isLegalHealthyChildGK) || 
                        $courseRegistration->isStudent ||
                        ($courseRegistration->isHealthyChildFranch && !$courseRegistration->isLegalHealthyChildFranch)                        ) {
                        //Привилегия
                        return redirect('/payment/privilege/' . $freq . '/22000');
                    } else if ($courseRegistration->isLegalHealthyChildFranch || $courseRegistration->isLegalHealthyChildGK) {
                        //Льгота
                        return redirect('/payment/enterprise/' . $freq );
                    }
                    else {
                        //База
                        return redirect('/payment/base/' . $freq . '/30000');
                    }
                    break;
                case 'tier-privilege':
                    //если льготный
                    if ( $courseRegistration->isAPPCP || 
                        ($courseRegistration->isHealthyChildGk && !$courseRegistration->isLegalHealthyChildGK) || 
                        $courseRegistration->isStudent ||
                        ($courseRegistration->isHealthyChildFranch && !$courseRegistration->isLegalHealthyChildFranch)                        ) {
                        //Привилегия
                        return redirect('/payment/privilege/' . $freq . '/22000');
                    } else if ($courseRegistration->isLegalHealthyChildFranch || $courseRegistration->isLegalHealthyChildGK) {
                        //Льгота
                        return redirect('/payment/enterprise/' . $freq);
                    }
                    else {
                        //База
                        return redirect('/payment/base/' . $freq . '/30000');
                    }
                    break;
                case 'tier-enterprise':
                    //если льготный
                    if ( $courseRegistration->isAPPCP || 
                        ($courseRegistration->isHealthyChildGk && !$courseRegistration->isLegalHealthyChildGK) || 
                        $courseRegistration->isStudent ||
                        ($courseRegistration->isHealthyChildFranch && !$courseRegistration->isLegalHealthyChildFranch)                        ) {
                        //Привилегия
                        return redirect('/payment/privilege/' . $freq . '/22000');
                    } else if ($courseRegistration->isLegalHealthyChildFranch || $courseRegistration->isLegalHealthyChildGK) {
                        //Льгота
                        return redirect('/payment/enterprise/' . $freq);
                    }
                    else {
                        //База
                        return redirect('/payment/base/' . $freq . '/30000');
                    }
                    break;
            }
            
            
        }
        else {
            return redirect()->route('profile.general');
        }

       
        /* if ($user->) */
        return $price;
        return view('payment');
    }

    public function success(Request $request, $sum, $freq)//: RedirectResponse
    {   

        $user = User::find($request->user()->id);
        $course = Course::where('id', '>=', 1)->first();
        /* $payment = Payment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'amount' => $sum,
            'status' => 'success',
            'freq' => $freq
        ]); */
        if ($freq == 100) {
            $payment = Payment::updateOrCreate(
                ['user_id' => $user->id, 'freq' => $freq]
                ,[
                'course_id' => $course->id,
                'amount' => $sum,
                'status' => 'success another',
            ]);

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

    public function fail(Request $request, $sum, $freq)
    {
        $payment = Payment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
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

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


    public function enterprise($course, $freq, $sum) {
       /*  return view('payments.enterprisePay'); */
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
                if ($course == 3)
                    return view('payments.nikolaeva.enterprisePay', compact(['freq', 'sum']));
                else if ($course == 4)
                    return view('payments.kochetkova.enterprisePay', compact(['freq', 'sum']));
                else if ($course == 5) {
                    return view('payments.kudryashova_17022025.enterprisePay', compact(['freq', 'sum']));
                }
                else if ($course == 6)
                    return view('payments.kudryashova_25022025.enterprisePay', compact(['freq', 'sum']));
                else if ($course == 7)
                    return view('payments.tretyakova_02032025.enterprisePay', compact(['freq', 'sum']));
                else if ($course == 8)
                    return view('payments.tretyakova_15032025.enterprisePay', compact(['freq', 'sum']));
                else if ($course == 10)
                    return view('payments.turkenich_nakonechnaya_17042025.enterprisePay', compact(['freq', 'sum']));
                else if ($course == 11)
                    return view('payments.sotnikova_24052025.enterprisePay', compact(['freq', 'sum']));
                else if ($course == 12)
                    return view('payments.lisavenko_26052025.enterprisePay', compact(['freq', 'sum']));
                else if ($course == 13)
                    return view('payments.norova_24042025.enterprisePay', compact(['freq', 'sum']));
                else
                    return view('payments.enterprisePay', compact(['freq', 'sum']));
            //}
        }

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
                if ($course == 3)
                    return view('payments.nikolaeva.privilegePay', compact(['freq', 'sum']));
                if ($course == 4)
                    return view('payments.kochetkova.privilegePay', compact(['freq', 'sum']));
                if ($course == 5)
                    return view('payments.kudryashova_17022025.privilegePay', compact(['freq', 'sum']));
                if ($course == 6)
                    return view('payments.kudryashova_25022025.privilegePay', compact(['freq', 'sum']));
                if ($course == 7)
                    return view('payments.tretyakova_02032025.privilegePay', compact(['freq', 'sum']));
                if ($course == 8)
                    return view('payments.tretyakova_15032025.privilegePay', compact(['freq', 'sum']));
                if ($course == 10)
                    return view('payments.turkenich_nakonechnaya_17042025.privilegePay', compact(['freq', 'sum']));
                if ($course == 11)
                    return view('payments.sotnikova_24052025.privilegePay', compact(['freq', 'sum']));
                if ($course == 12)
                    return view('payments.lisavenko_26052025.privilegePay', compact(['freq', 'sum']));
                if ($course == 13)
                    return view('payments.norova_24042025.privilegePay', compact(['freq', 'sum']));
                    
                return view('payments.privilegePay', compact(['freq', 'sum']));
            //}
        }
        
    }
    public function base($course, $freq, $sum) {
        if ($course == 3)
            return view('payments.nikolaeva.basePay', compact(['freq', 'sum']));
        else if ($course == 4)
            return view('payments.kochetkova.basePay', compact(['freq', 'sum']));
        else if ($course == 5)
            return view('payments.kudryashova_17022025.basePay', compact(['freq', 'sum']));
        else if ($course == 6)
            return view('payments.kudryashova_25022025.basePay', compact(['freq', 'sum']));
        else if ($course == 7)
            return view('payments.tretyakova_02032025.basePay', compact(['freq', 'sum']));
        else if ($course == 8)
            return view('payments.tretyakova_15032025.basePay', compact(['freq', 'sum']));
        else if ($course == 10)
            return view('payments.turkenich_nakonechnaya_17042025.basePay', compact(['freq', 'sum']));
        else if ($course == 11)
            return view('payments.sotnikova_24052025.basePay', compact(['freq', 'sum']));
        else if ($course == 12)
            return view('payments.lisavenko_26052025.basePay', compact(['freq', 'sum']));
        else if ($course == 13)
            return view('payments.norova_24042025.basePay', compact(['freq', 'sum']));
            
        return view('payments.basePay', compact(['freq', 'sum']));

    }

    public function student($course, $freq, $sum) {
        $courseRegistration = CourseRegistration::where('user_id', auth()->user()->id)
            ->where('course_id', $course)
            ->first();
        if ($courseRegistration->isStudent)   
            if ($course == 3) 
                return view('payments.nikolaeva.student', compact(['freq', 'sum']));
            else if ($course == 4)
                return view('payments.kochetkova.student', compact(['freq', 'sum']));
            else if ($course == 5)
                return view('payments.kudryashova_17022025.student', compact(['freq', 'sum']));
            else if ($course == 6)
                return view('payments.kudryashova_25022025.student', compact(['freq', 'sum']));
            else if ($course == 7)
                return view('payments.tretyakova_02032025.student', compact(['freq', 'sum']));
            else if ($course == 8)
                return view('payments.tretyakova_15032025.student', compact(['freq', 'sum']));
            else if ($course == 10)
                return view('payments.turkenich_nakonechnaya_17042025.student', compact(['freq', 'sum']));
            else if ($course == 11)
                return view('payments.sotnikova_24052025.student', compact(['freq', 'sum']));
            else if ($course == 12)
                return view('payments.lisavenko_26052025.student', compact(['freq', 'sum']));
            else if ($course == 13)
                return view('payments.norova_24042025.student', compact(['freq', 'sum']));
                
    }

    public function index($tier, $course, $freq, $price)
    {
        if (!auth()->user()) {
            return  redirect()->route('login');
        }
        $user = User::find(auth()->user()->id);
        
        /* $courseRegistration = CourseRegistration::where('user_id', $user->id)
                                                        ->where('course_id', $course)
                                                        ->first(); */
        
        $isAPPCP = 0;
        $isHealthyChild = 0;
        $isHealthyChildGk = 0;
        $isStudent = 0;
        $isHealthyChildFranch = 0;
        $isHealthyChildPartner = 0;
        $shouldBeCheckedOut = 0;
        $allCourseRegistrations = CourseRegistration::where('user_id', $user->id)
                                /* ->where('course_id', '<>', $course) */
                                ->orderBy('id', 'asc')->get();
        if ($allCourseRegistrations->count() == 0) {
            return redirect()->route('registerCourse', ['course_id' => $course]);
        }
        foreach ($allCourseRegistrations as $courseRegistration) {
            $isAPPCP = $courseRegistration->isAPPCP ? $courseRegistration->isAPPCP : 0;
            $isHealthyChild = $courseRegistration->isHealthyChild ? $courseRegistration->isHealthyChild : 0;
            $isHealthyChildGk = $courseRegistration->isHealthyChildGk ? $courseRegistration->isHealthyChildGk : 0;
            $isStudent = $courseRegistration->isStudent ? $courseRegistration->isStudent : 0;
            $isHealthyChildFranch = $courseRegistration->isHealthyChildFranch ? $courseRegistration->isHealthyChildFranch : 0;
            $isHealthyChildPartner = $courseRegistration->isHealthyChildPartner ? $courseRegistration->isHealthyChildPartner : 0;
            if ($courseRegistration->shouldBeCheckedOut 
                && !$courseRegistration->managerCheckedOut 
                && !$shouldBeCheckedOut && 
                ($isAPPCP || $isHealthyChild || $isHealthyChildGk || $isStudent || $isHealthyChildFranch || $isHealthyChildPartner)) 
            {
                $shouldBeCheckedOut = 1;
            }
            else if ($courseRegistration->shouldBeCheckedOut && $courseRegistration->managerCheckedOut)
                $shouldBeCheckedOut = 0;
            
        }  
        $courseRegistration = CourseRegistration::updateOrCreate(
            ['user_id' => $user->id, 'course_id' => $course],
            [
                'isAPPCP' => $isAPPCP,
                'isHealthyChild' => $isHealthyChild,
                'isHealthyChildGk' => $isHealthyChildGk,
                'isHealthyChildFranch' => $isHealthyChildFranch,
                'isStudent' => $isStudent,
                'shouldBeCheckedOut' => $shouldBeCheckedOut,
                'isHealthyChildPartner' => $isHealthyChildPartner,
            ]
        );    
        $actualPrice = 3000;
        
        if ($isAPPCP || $isHealthyChildGk || $isHealthyChild || $isHealthyChildFranch || $isHealthyChildPartner)
            $actualPrice = 0;
        if ($isStudent)
            switch ($courseRegistration->course_id) {
                /* case 3:
                    $actualPrice = 4000;
                    break; */
                case 4:
                    $actualPrice = 4000;
                    break;
                case 5:
                    $actualPrice = 1000;
                    break;   
                case 6:
                    $actualPrice = 1000;
                    break; 
                case 7:
                    $actualPrice = 1000;
                    break; 
                case 8:
                    $actualPrice = 2000;
                    break; 
                case 10:
                    $actualPrice = 3600;
                    break;
                case 11:
                    $actualPrice = 1000;
                    break;
                case 12:
                    $actualPrice = 1000;
                    break;
                case 13:
                    $actualPrice = 800;
                    break;

            }
            
        if ($courseRegistration) {
            if ($shouldBeCheckedOut && !$courseRegistration->managerCheckedOut && str_contains($tier, 'student' )) {
                if ($courseRegistration->course_id == 3)
                    return view('payments.nikolaeva.userIsCheckingProgress', compact('courseRegistration', 'course', 'actualPrice', 'isStudent'));
                if ($courseRegistration->course_id == 4) {
                    return view('payments.kochetkova.userIsCheckingProgress', compact('courseRegistration', 'course', 'actualPrice', 'isStudent'));
                }
                if ($courseRegistration->course_id == 5) {
                    return view('payments.kudryashova_17022025.userIsCheckingProgress', compact('courseRegistration', 'course', 'actualPrice', 'isStudent'));
                }
                if ($courseRegistration->course_id == 6) {
                    return view('payments.kudryashova_25022025.userIsCheckingProgress', compact('courseRegistration', 'course', 'actualPrice', 'isStudent'));
                }
                if ($courseRegistration->course_id == 7) {
                    return view('payments.tretyakova_02032025.userIsCheckingProgress', compact('courseRegistration', 'course', 'actualPrice', 'isStudent'));
                }
                if ($courseRegistration->course_id == 8) {
                    return view('payments.tretyakova_15032025.userIsCheckingProgress', compact('courseRegistration', 'course', 'actualPrice', 'isStudent'));
                }
                if ($courseRegistration->course_id == 10) {
                    return view('payments.turkenich_nakonechnaya_17042025.userIsCheckingProgress', compact('courseRegistration', 'course', 'actualPrice', 'isStudent'));
                }     
                if ($courseRegistration->course_id == 11) {
                    return view('payments.sotnikova_24052025.userIsCheckingProgress', compact('courseRegistration', 'course', 'actualPrice', 'isStudent'));
                }     
                if ($courseRegistration->course_id == 12) {
                    return view('payments.lisavenko_26052025.userIsCheckingProgress', compact('courseRegistration', 'course', 'actualPrice', 'isStudent'));
                }   
                if ($courseRegistration->course_id == 13) {
                    return view('payments.norova_24042025.userIsCheckingProgress', compact('courseRegistration', 'course', 'actualPrice', 'isStudent'));
                }
            }
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
                    /* if ( $courseRegistration->isStudent)
                        return redirect('/payment/students/' . $course . '/' . $freq . '/4000');
                    else if ($courseRegistration->isHealthyChildGk || $courseRegistration->isAPPCP || $courseRegistration->isHealthyChild || $courseRegistration->isHealthyChildPartner || $courseRegistration->isHealthyChildFranch )  
                        return redirect('/payment/enterprise/' . $course . '/' . $freq . '/1');
                    else */
                        return redirect('/payment/base/' . $course . '/' . $freq . '/2000');
                case 'tier-privilege2':
                    if ( $courseRegistration->isStudent)
                        return redirect('/payment/students/' . $course . '/' . $freq . '/4000');
                    else if ($courseRegistration->isHealthyChildGk || $courseRegistration->isAPPCP || $courseRegistration->isHealthyChild || $courseRegistration->isHealthyChildPartner || $courseRegistration->isHealthyChildFranch)  
                        return redirect('/payment/enterprise/' . $course . '/' . $freq . '/5000');
                    else
                        return redirect('/payment/base/' . $course . '/' . $freq . '/3000');
                case 'tier-students':
                    if ( $courseRegistration->isStudent)
                        return redirect('/payment/students/' . $course . '/' . $freq . '/4000');
                    else if ($courseRegistration->isHealthyChildGk || $courseRegistration->isAPPCP || $courseRegistration->isHealthyChild || $courseRegistration->isHealthyChildPartner || $courseRegistration->isHealthyChildFranch)  
                        return redirect('/payment/enterprise/' . $course . '/' . $freq . '/1');
                    else
                        return redirect('/payment/base/' . $course . '/' . $freq . '/5000');
                case 'tier-enterprise2':
                    if ( $courseRegistration->isStudent)
                        return redirect('/payment/students/' . $course . '/' . $freq . '/4000');
                    else if ($courseRegistration->isHealthyChildGk || $courseRegistration->isAPPCP || $courseRegistration->isHealthyChild || $courseRegistration->isHealthyChildPartner || $courseRegistration->isHealthyChildFranch)  
                        return redirect('/payment/enterprise/' . $course . '/' . $freq . '/1');
                    else
                        return redirect('/payment/base/' . $course . '/' . $freq . '/5000');
                case 'tier-base4':    
                    if ( $courseRegistration->isStudent)
                        return redirect('/payment/students/' . $course . '/' . $freq . '/4000');
                    else if ($courseRegistration->isHealthyChildGk || $courseRegistration->isAPPCP || $courseRegistration->isHealthyChild || $courseRegistration->isHealthyChildPartner || $courseRegistration->isHealthyChildFranch )  
                        return redirect('/contacts');
                    else
                        return redirect('/payment/base/' . $course . '/' . $freq . '/5000');
                case 'tier-students4':
                    if ( $courseRegistration->isStudent)
                        return redirect('/payment/students/' . $course . '/' . $freq . '/4000');
                    else if ($courseRegistration->isHealthyChildGk || $courseRegistration->isAPPCP || $courseRegistration->isHealthyChild || $courseRegistration->isHealthyChildPartner || $courseRegistration->isHealthyChildFranch)  
                    return redirect('/contacts');
                    else
                        return redirect('/payment/base/' . $course . '/' . $freq . '/5000');
                case 'tier-enterprise4':
                    if ( $courseRegistration->isStudent)
                        return redirect('/payment/students/' . $course . '/' . $freq . '/4000');
                    else if ($courseRegistration->isHealthyChildGk || $courseRegistration->isAPPCP || $courseRegistration->isHealthyChild || $courseRegistration->isHealthyChildPartner || $courseRegistration->isHealthyChildFranch)  
                        return redirect('/contacts');
                    else
                        return redirect('/payment/base/' . $course . '/' . $freq . '/5000');
                case 'tier-base5':    
                    /* if ( $courseRegistration->isStudent)
                        return redirect('/payment/students/' . $course . '/' . $freq . '/1350');
                    else if ($courseRegistration->isHealthyChildGk || $courseRegistration->isAPPCP || $courseRegistration->isHealthyChild || $courseRegistration->isHealthyChildPartner || $courseRegistration->isHealthyChildFranch )  
                        return redirect('/contacts');
                    else */
                        return redirect('/payment/base/' . $course . '/' . $freq . '/1000');
                case 'tier-students5':
                    if ( $courseRegistration->isStudent)
                        return redirect('/payment/students/' . $course . '/' . $freq . '/1000');
                    /* else if ($courseRegistration->isHealthyChildGk || $courseRegistration->isAPPCP || $courseRegistration->isHealthyChild || $courseRegistration->isHealthyChildPartner || $courseRegistration->isHealthyChildFranch)  
                        return redirect('/contacts'); */
                    else
                        return redirect('/payment/base/' . $course . '/' . $freq . '/1000');
                case 'tier-enterprise5':
                    /* if ( $courseRegistration->isStudent)
                        return redirect('/payment/students/' . $course . '/' . $freq . '/1350');
                    else if ($courseRegistration->isHealthyChildGk || $courseRegistration->isAPPCP || $courseRegistration->isHealthyChild || $courseRegistration->isHealthyChildPartner || $courseRegistration->isHealthyChildFranch) */  
                        return redirect('/contacts');
                    /* else
                        return redirect('/payment/base/' . $course . '/' . $freq . '/1500'); */
                case 'tier-base6':    
                    return redirect('/payment/base/' . $course . '/' . $freq . '/2000');
                case 'tier-students6':
                    if ( $courseRegistration->isStudent)
                        return redirect('/payment/students/' . $course . '/' . $freq . '/4500');
                    else
                        return redirect('/payment/base/' . $course . '/' . $freq . '/5000');
                case 'tier-enterprise6':
                    return redirect('/contacts');
                case 'tier-base7':    
                    return redirect('/payment/base/' . $course . '/' . $freq . '/4000');
                case 'tier-students7':
                    if ( $courseRegistration->isStudent)
                        return redirect('/payment/students/' . $course . '/' . $freq . '/3600');
                    else
                        return redirect('/payment/base/' . $course . '/' . $freq . '/4000');
                case 'tier-enterprise7':
                    return redirect('/contacts');    
                case 'tier-base8':    
                    return redirect('/payment/base/' . $course . '/' . $freq . '/1500');
                case 'tier-students8':
                    if ( $courseRegistration->isStudent)
                        return redirect('/payment/students/' . $course . '/' . $freq . '/1000');
                    else
                        return redirect('/payment/base/' . $course . '/' . $freq . '/1500');
                case 'tier-enterprise8':
                    return redirect('/contacts');   
                case 'tier-base9':    
                    return redirect('/payment/base/' . $course . '/' . $freq . '/1500');
                case 'tier-students9':
                    if ( $courseRegistration->isStudent)
                        return redirect('/payment/students/' . $course . '/' . $freq . '/1000');
                    else
                        return redirect('/payment/base/' . $course . '/' . $freq . '/1500');
                case 'tier-enterprise9':
                    return redirect('/contacts');   
                case 'tier-base10':    
                    return redirect('/payment/base/' . $course . '/' . $freq . '/1000');
                case 'tier-students10':
                    if ( $courseRegistration->isStudent)
                        return redirect('/payment/students/' . $course . '/' . $freq . '/800');
                    else
                        return redirect('/payment/base/' . $course . '/' . $freq . '/1000');
                case 'tier-enterprise10':
                    return redirect('/contacts');   
            }
            
            
        }
        else {
            return redirect()->route('profile.general');
        }

       
        /* if ($user->) */
        /* return $price; */
        return view('home');
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
        $user = User::find($request->user()->id);
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

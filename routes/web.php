<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth; //Auth namespace
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
/* Route::get('/vizel', function () {
    return view('home');

}); */

Auth::routes(['verify' => true]);
Route::fallback(function () {
    return view('errors.404');
});
Route::get('/pdf/{filename}', function ($filename) {
    $path = storage_path('app/public/pdfs/' . $filename); // Путь к вашему PDF файлу
    return response()->file($path);
});
//Роуты основных страниц
Route::controller(App\Http\Controllers\HomeController::class)->group(function () {
    /* Route::get('/vizel', 'index')->name('vizel'); */
    Route::get('/', 'index')->name('home');
    Route::get('/kudryashova_17022025', 'kudryashova_17022025')->name('kudryashova_17022025');
    Route::get('/kudryashova_25022025', 'kudryashova_25022025')->name('kudryashova_25022025');
    Route::get('/tretyakova_02032025', 'tretyakova_02032025')->name('tretyakova_02032025');
    Route::get('/tretyakova_15032025', 'tretyakova_15032025')->name('tretyakova_15032025');
    Route::get('/turkenich_nakonechnaya_17042025', 'turkenich_nakonechnaya_17042025')->name('turkenich_nakonechnaya_17042025');
    Route::get('/kurbatov', 'kurbatov')->name('kurbatov');
    Route::get('/nikolaeva', 'nikolaeva')->name('nikolaeva');
    Route::get('/contacts', 'contacts')->name('contacts');
    Route::get('/about', 'about')->name('about');
    Route::get('/docs', function (Request $request) { return redirect()->route('documents.offer'); })->name('documents');
    Route::get('/docs/offer', 'offer')->name('documents.offer');
    Route::get('/docs/contract', 'contract')->name('documents.contract');
    Route::get('/docs/privacy', 'privacy')->name('documents.privacy');
    Route::get('/docs/policy', 'policy')->name('documents.policy');
    Route::get('/docs/agreement', 'agreement')->name('documents.agreement');
}); 


//Роут на получение всех эвенов 
Route::get('/api/events', function (Request $request) {
    $date = $request->query('date');
    $user = $request->user();
    
    $permissions = $user->permissions()->get();
    $permissions = $permissions->pluck('slug')->toArray();
    if ($user->hasAccess('content.viewEvents')) {
        return Event::where('start_date', '<=', $date)
            ->where('end_date', '>=', $date)
            ->orderBy('order', 'ASC')
            ->orderBy('start_time')
            ->get();
    }
    else {
    return Event::where('start_date', '<=', $date)
                ->where('end_date', '>=', $date)
                ->where('status', '!=', 'closed')
                ->orderBy('order', 'ASC')
                ->orderBy('start_time')
                ->get();
    }
});

//Роут на получение эвенов по курсу
Route::get('/api/course/{course_id}/events', function (Request $request, $course_id) {
    $date = $request->query('date');
    $user = $request->user();
    $permissions = $user->permissions()->get();
    $permissions = $permissions->pluck('slug')->toArray();
        if ($user->hasAccess('content.viewEvents')) {
            return Event::where('start_date', '<=', $date)->where('end_date', '>=', $date)
                    ->where('course_id', $course_id)
                    ->orderBy('order', 'ASC')
                    ->orderBy('start_time')
                    ->get();        
        }
        else {
            return Event::where('start_date', '<=', $date)->where('end_date', '>=', $date)
                        ->where('course_id', $course_id)
                        ->where('status', '!=', 'closed')
                        ->orderBy('order', 'ASC')
                        ->orderBy('start_time')
                        ->get();
        }
});

//Роут на получение всех занятых эвентами дней по курсу
Route::get('/api/days', function (Request $request) {
    $date = $request->query('date');
    $dateObject = Carbon::createFromFormat('Y-m-d', $date);

    // Извлекаем год и месяц из $dateObject.
    $year = $dateObject->year;
    $month = $dateObject->month;

    // Получаем уникальные даты через запрос.
    $uniqueDates = Event::select('start_date')
        ->whereYear('start_date', $year)
        ->whereMonth('start_date', $month)
        ->distinct()
        ->pluck('start_date');
    return $uniqueDates;
});

//Роут на получение занятых эвентами дней по курсу
Route::get('/api/course/{course_id}/days', function (Request $request, $course_id) {
    $date = $request->query('date');
    $dateObject = Carbon::createFromFormat('Y-m-d', $date);

    // Извлекаем год и месяц из $dateObject.
    $year = $dateObject->year;
    $month = $dateObject->month;

    // Получаем уникальные даты через запрос.
    $uniqueDates = Event::select('start_date')
        ->whereYear('start_date', $year)
        ->whereMonth('start_date', $month)
        ->where('course_id', $course_id)
        ->distinct()
        ->pluck('start_date');
    return $uniqueDates;
});

//Обучение
Route::controller(App\Http\Controllers\EducationController::class)->group(function () {
    Route::get('/education', 'showCourses')->name('education.index')->middleware(['auth', 'verified']);
    
    
    Route::get('/education/courses/{group}', 'showCoursesByGroup')->name('education.groups');
    
    Route::get('/education/course/{course_id}', 'showCourse')->name('education.course')->middleware(['auth', 'verified', 'paid']);

    Route::get('/education/course/{course_id}/event/{id}', 'showEvent')->name('education.showEvent')->middleware(['auth', 'verified', 'paid']);
    Route::get('/education/course/{course_id}/test/{id}','showTest')->name('education.showTest')->middleware(['auth', 'verified', 'paid']);
    Route::get('/education/course/{course_id}/test/{id}/startTest','startTest')->name('education.startTest')->middleware(['auth', 'verified', 'paid']);
    Route::post('/education/course/{course_id}/test/{id}/submitTest','submitTest')->name('education.submitTest')->middleware(['auth', 'verified', 'paid']);
    Route::get('/education/course/{course_id}/selfStudyMaterial/{id}','showSelfStudyMaterial')->name('education.showSelfStudyMaterial')->middleware(['auth', 'verified', 'paid']);
    Route::get('/education/course/{course_id}/vebinar/{id}','showVebinar')->name('education.showVebinar')->middleware(['auth', 'verified', 'paid']);
    
    Route::get('/education/course/{course_id}/askQuestion','showAskQuestion')->name('education.showAskQuestionSelectTheme')->middleware(['auth', 'verified', 'paid']);
    Route::get('/education/course/{course_id}/askQuestion/theme/{theme_id}','showAskQuestion')->name('education.showAskQuestion')->middleware(['auth', 'verified', 'paid']);
    Route::post('/education/course/{course_id}/askQuestion/theme/{theme_id}','askQuestion')->name('education.askQuestion')->middleware(['auth', 'verified', 'paid']);
    Route::get('/education/registerCourse/{course_id}', 'registerCourse')->name('registerCourse')->middleware(['auth', 'verified']);

});
//Платежи
Route::controller(App\Http\Controllers\PaymentController::class)->group(function () {
   
    Route::get('/payment/success/{course}/{sum}/{freq}', 'success')->name('payment.success')->middleware(['auth', 'verified']);
    Route::get('/payment/fail/{course}/{sum}/{freq}', 'fail')->name('payment.fail')->middleware(['auth', 'verified']);
    Route::get('/payment/base/{course}/{freq}/{sum}', 'base')->name('payment.base')->middleware(['auth', 'verified']);
    Route::get('/payment/privilege/{course}/{freq}/{sum}', 'privilege')->name('payment.privilege')->middleware(['auth', 'verified']);
    Route::get('/payment/enterprise/{course}/{freq}/{sum}', 'enterprise')->name('payment.enterprise')->middleware(['auth', 'verified']);
    Route::get('/payment/students/{course}/{freq}/{price}', 'student')->name('payment.student')->middleware(['auth', 'verified']);
    Route::get('/payment/{tier}/{course}/{freq}/{price}', 'index')->name('payment.index')->middleware(['auth', 'verified']);
});


/* Route::get('/', function () {
    return view('home');
}); */


//Подтверждение почты
Route::get('/email/verify', function (Request $request) {
    return redirect()->route('settings.general');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verifyNew', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return view('auth.verify');
})->middleware('auth')->name('verification.noticeNew');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::get('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return __('Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.sendGet');
//Сброс пароля
Route::get('/forgot-password', function () {
    return view('auth.passwords.email');
})->middleware('guest')->name('password.request');
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __('Ссылка на изменение пароля отправлена на вашу почту')])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', function (string $token, Request $request) {
    $email = $request->query('email');
    return view('auth.passwords.reset', ['token' => $token, 'email' => $email]);
})->middleware('guest')->name('password.reset');

//Роуты для документов
Route::controller(App\Http\Controllers\UserDocumentController::class)->group(function () {
    Route::get('/user/{user}/document/{type}', 'index')->name('showDocument')->middleware(['auth', 'verified']);
});

//Роуты для профиля
Route::controller(App\Http\Controllers\ProfileController::class)->group(function () {
    Route::get('/settings', 'index')->name('settings.general')->middleware(['auth', 'verified']);
    Route::get('/settings/security', 'security')->name('settings.security')->middleware(['auth', 'verified']);
    Route::get('/settings/documents', 'documents')->name('settings.documents')->middleware(['auth', 'verified']);
    
    
    Route::get('/settings/education', 'education')->name('settings.education');
    Route::post('/settings/general/setWhatsApp', 'setWhatsApp')->name('settings.general.setWhatsApp');
    Route::post('/settings/general/setTgNickname', 'setTgNickname')->name('settings.general.setTgNickname');
    Route::post('/settings/general/setEmail', 'setEmail')->name('settings.general.setEmail');
    Route::post('/settings/general/setName', 'setName')->name('settings.general.setName');
    Route::post('/settings/general/setSecondName', 'setSecondName')->name('settings.general.setSecondName');
    Route::post('/settings/general/setPatronymicName', 'setPatronymicName')->name('settings.general.setPatronymicName');
    Route::post('/settings/general/setPhone', 'setPhone')->name('settings.general.setPhone');
    Route::post('/settings/general/setSnils', 'setSnils')->name('settings.general.setSNILS');
    Route::post('/settings/general/setPassportSeria', 'setPassportSeria')->name('settings.general.setPassportSeria');
    Route::post('/settings/general/setPasspoortNumber', 'setPasspoortNumber')->name('settings.general.setPasspoortNumber');

    
    Route::post('/settings/general/uploadPassport2PageScan', 'uploadPassport2PageScan')->name('settings.general.uploadPassport2PageScan');
    Route::post('/settings/general/uploadPassport3PageScan', 'uploadPassport3PageScan')->name('settings.general.uploadPassport3PageScan');
    Route::post('/settings/general/uploadPassport5PageScan', 'uploadPassport5PageScan')->name('settings.general.uploadPassport5PageScan');
    
    Route::post('/settings/general/uploadDiplomMainPageScan', 'uploadDiplomMainPageScan')->name('settings.general.uploadDiplomMainPageScan');
    Route::post('/settings/general/uploadDiplomFirstPageScan', 'uploadDiplomFirstPageScan')->name('settings.general.uploadDiplomFirstPageScan');
    Route::post('/settings/general/uploadDiplomSecondPageScan', 'uploadDiplomSecondPageScan')->name('settings.general.uploadDiplomSecondPageScan');

    Route::post('/settings/general/uploadDiplomPrefPerepodScan', 'uploadDiplomPrefPerepodScan')->name('settings.general.uploadDiplomPrefPerepodScan');
    
    Route::post('/settings/general/uploadSnilsScan', 'uploadSnilsScan')->name('settings.general.uploadSnilsScan');

    Route::post('/settings/general/uploadStudScan', 'uploadStudScan')->name('settings.general.uploadStudScan');
    

    Route::get('/profile', 'profile')->name('profile.general')->middleware(['auth', 'verified']);
    Route::post('/profile/registerSecond', 'registerSecond')->name('profile.registerSecond')->middleware(['auth', 'verified']);
});


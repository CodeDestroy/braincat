<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth; //Auth namespace
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
/* Route::get('/home', function () {
    return view('home');

}); */

Auth::routes(/* ['verify' => true] */);
/* Route::fallback(function () {
    return view('errors.404');
}); */
Route::controller(App\Http\Controllers\HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/contacts', 'contacts')->name('contacts');
    Route::get('/about', 'about')->name('about');
    Route::get('/docs', function (Request $request) { return redirect()->route('documents.offer'); })->name('documents');
    Route::get('/docs/offer', 'offer')->name('documents.offer');
    Route::get('/docs/contract', 'contract')->name('documents.contract');
    Route::get('/docs/privacy', 'privacy')->name('documents.privacy');
    Route::get('/docs/policy', 'policy')->name('documents.policy');
    Route::get('/docs/agreement', 'agreement')->name('documents.agreement');
}); 
/* Route::controller(App\Http\Controllers\HomeController::class)->group(function () {
    Route::get('/pay/{tier}', 'index')->name('home');
    Route::get('/contacts', 'contacts')->name('contacts');
    Route::get('/about', 'about')->name('about');
});  */

Route::get('/api/events', function (Request $request) {
    $date = $request->query('date');
    return Event::where('start_date', '<=', $date)->where('end_date', '>=', $date)
                ->orderBy('start_time')
                ->orderBy('type', 'ASC')
                ->get();
});
Route::get('/api/course/{course_id}/events', function (Request $request, $course_id) {
    $date = $request->query('date');
    return Event::where('start_date', '<=', $date)->where('end_date', '>=', $date)->where('course_id', $course_id)
                ->orderBy('start_time')
                ->orderBy('type', 'ASC')
                ->get();
});
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
    /* return Event::where('start_date', '<=', $date)->where('end_date', '>=', $date)
                ->orderBy('start_time')
                ->orderBy('type', 'ASC')
                ->get(); */
});
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
Route::controller(App\Http\Controllers\EducationController::class)->group(function () {
    Route::get('/education', 'showCourses')->name('education.index')->middleware(['auth'/*, 'verified*/]);
    
    Route::get('/education/course/{course_id}/', 'showCourse')->name('education.course')->middleware(['auth'/*, 'verified*/, 'paid']);

    Route::get('/education/course/{course_id}/event/{id}', 'showEvent')->name('education.showEvent')->middleware(['auth'/*, 'verified*/, 'paid']);
    Route::get('/education/course/{course_id}/test/{id}','showTest')->name('education.showTest')->middleware(['auth'/*, 'verified*/, 'paid']);
    Route::get('/education/course/{course_id}/test/{id}/startTest','startTest')->name('education.startTest')->middleware(['auth'/*, 'verified*/, 'paid']);
    Route::post('/education/course/{course_id}/test/{id}/submitTest','submitTest')->name('education.submitTest')->middleware(['auth'/*, 'verified*/, 'paid']);
    Route::get('/education/course/{course_id}/selfStudyMaterial/{id}','showSelfStudyMaterial')->name('education.showSelfStudyMaterial')->middleware(['auth'/*, 'verified*/, 'paid']);/* 
    Route::get('/education/test/{test_id}/question/{question_id}','showQuestion')->name('education.showQuestion'); */

});
Route::controller(App\Http\Controllers\PaymentController::class)->group(function () {
   
    Route::get('/payment/success/{sum}/{freq}', 'success')->name('payment.success');
    Route::get('/payment/fail/{sum}/{freq}', 'fail')->name('payment.fail');
    /* Route::post('/payment/success', 'successView')->name('payment.successView');
    Route::post('/payment/fail', 'failView')->name('payment.failView'); */
    Route::get('/payment/base/{freq}/{sum}', 'base')->name('payment.base');
    Route::get('/payment/privilege/{freq}/{sum}', 'privilege')->name('payment.privilege');
    Route::get('/payment/enterprise/{freq}', 'enterprise')->name('payment.enterprise');
    Route::get('/payment/{tier}/{freq}/{price}', 'index')->name('payment.index');
})->middleware(['auth'/*, 'verified*/]);


Route::get('/', function () {
    return view('home');
});

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::controller(App\Http\Controllers\UserDocumentController::class)->group(function () {
    /* Route::get('/user/{user}/document/{type}', [UserDocumentController::class, 'showDocument']);
 */
    Route::get('/user/{user}/document/{type}', 'index')->name('showDocument')->middleware(['auth'/*, 'verified*/]);
});
Route::controller(App\Http\Controllers\ProfileController::class)->group(function () {
    Route::get('/settings', 'index')->name('settings.general')->middleware(['auth'/*, 'verified*/]);
    Route::get('/settings/security', 'security')->name('settings.security')->middleware(['auth'/*, 'verified*/]);
    Route::get('/settings/documents', 'documents')->name('settings.documents')->middleware(['auth'/*, 'verified*/]);
    
    
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

    
    Route::post('/settings/general/uploadSnilsScan', 'uploadSnilsScan')->name('settings.general.uploadSnilsScan');

    Route::post('/settings/general/uploadStudScan', 'uploadStudScan')->name('settings.general.uploadStudScan');
    

    Route::get('/profile', 'profile')->name('profile.general')->middleware(['auth'/*, 'verified*/]);
    Route::post('/profile/registerSecond', 'registerSecond')->name('profile.registerSecond')->middleware(['auth'/*, 'verified*/]);
});


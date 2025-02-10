<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CourseRegistration;
use App\Models\Course;
use App\Models\CourseRegistrationDocuments;
use App\Models\UserDocument;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('profile.general');
    }

    public function security()
    {
        return view('profile.security');
    }

    public function education() 
    {
        return view('profile.education');
    }

    public function documents(Request $request) 
    {
        $userCourseRegistration = CourseRegistration::where(['user_id' => $request->user()->id])->first();
        $userIsStudent = 0;
        if ($userCourseRegistration && $userCourseRegistration->isStudent) {
            $userIsStudent = 1;
        }
        $userDiplomMainPage = UserDocument::where(['user_id' => $request->user()->id, 'type' => 'diplom_main_page'])->first();
        $userDiplomSupplementFirstPage = UserDocument::where(['user_id' => $request->user()->id, 'type' => 'diplom_supplement_1_page'])->first();
        $userDiplomSupplementSecondPage = UserDocument::where(['user_id' => $request->user()->id, 'type' => 'diplom_supplement_2_page'])->first();
        $userStud = UserDocument::where(['user_id' => $request->user()->id, 'type' => 'stud'])->first();
        $userPassport2Page = UserDocument::where(['user_id' => $request->user()->id, 'type' => 'passport_2_page'])->first();
        $userPassport3Page = UserDocument::where(['user_id' => $request->user()->id, 'type' => 'passport_3_page'])->first();
        $userPassport5Page = UserDocument::where(['user_id' => $request->user()->id, 'type' => 'passport_5_page'])->first();
        $userSnils = UserDocument::where(['user_id' => $request->user()->id, 'type' => 'snils'])->first();
        return view('profile.documents', 
            compact('userStud', 'userPassport2Page', 'userPassport3Page', 
            'userPassport5Page', 'userSnils', 'userIsStudent', 'userDiplomMainPage', 'userDiplomSupplementFirstPage', 'userDiplomSupplementSecondPage'));
    }

    
    public function profile (Request $request) {
        $courses = Course::all();
        $lastCourseRegistration = CourseRegistration::where('user_id', $request->user()->id)->orderBy('id', 'desc')->first();
        $course_id = $lastCourseRegistration ? $lastCourseRegistration->course_id : 1;
        return view('profile.registerSecond', compact('courses', 'course_id', 'lastCourseRegistration'));

    }

    public function setWhatsApp(Request $request)//: RedirectResponse
    {   
        /* return $request->input('hasWhatsApp'); */
        $user = User::find($request->user()->id);
        $user->hasWhatsApp = !($request->input('hasWhatsApp'));
        $user->save();
        return redirect()->route('settings.general');
    }

    public function setTgNickname (Request $request)//: RedirectResponse
    {   
        $user = User::find($request->user()->id);
        $user->tgNickname = $request->input('tgNickname');
        $user->save();
        return redirect()->route('settings.general');
    }

    public function setEmail (Request $request)//: RedirectResponse
    {   
        $user = User::find($request->user()->id);
        $user->email = $request->input('email');
        $user->save();
        return redirect()->route('settings.general');
    }

    public function setName (Request $request)//: RedirectResponse
    {   
        $user = User::find($request->user()->id);
        $user->name = $request->input('name');
        $user->save();
        return redirect()->route('settings.general');
    }

    public function setSecondName (Request $request)//: RedirectResponse
    {   
        $user = User::find($request->user()->id);
        $user->secondName = $request->input('secondName');
        $user->save();
        return redirect()->route('settings.general');
    }

    public function setPatronymicName (Request $request)//: RedirectResponse
    {   
        $user = User::find($request->user()->id);
        $user->patronymicName = $request->input('patronymicName');
        $user->save();
        return redirect()->route('settings.general');
    }

    public function setPhone (Request $request)//: RedirectResponse
    {   
        $user = User::find($request->user()->id);
        $user->phone = $request->input('phone');
        $user->save();
        return redirect()->route('settings.general');
    }

    public function setSnils (Request $request)//: RedirectResponse
    {   
        $validator = Validator::make($request->all(), [
            'snils' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // Удаление пробелов и тире из snils, phone и postIndex
        $snils = preg_replace('/[\s\-]/', '', $request->input('snils'));
        $user = User::find($request->user()->id);
        $user->update([
            'SNILS' => $snils,
        ]);
        $user->save();
        return redirect()->route('settings.documents');
    }

    public function setPassportSeria (Request $request)//: RedirectResponse
    {   
        $validator = Validator::make($request->all(), [
            'passportSeria' => 'nullable|string|size:4',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // Удаление пробелов и тире из snils, phone и postIndex
        $user = User::find($request->user()->id);
        $user->update([
            'passportSeria' => $request->input('passportSeria'),
        ]);
        $user->save();
        return redirect()->route('settings.documents');
    }

    public function setPasspoortNumber (Request $request)//: RedirectResponse
    {   
        $validator = Validator::make($request->all(), [
            'passpoortNumber' => 'nullable|string|size:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // Удаление пробелов и тире из snils, phone и postIndex
        $user = User::find($request->user()->id);
        $user->update([
            'passpoortNumber' => $request->input('passpoortNumber'),
        ]);
        $user->save();
        return redirect()->route('settings.documents');
    }
    

    public function registerSecond(Request $request) 
    {

        $user = User::find($request->user()->id);

        $validator = Validator::make($request->all(), [
            'snils' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'postIndex' => 'nullable|string|max:6',
            /*'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) use ($user) {
                    if ($value !== $user->email) {
                        $fail('Email не совпадает с email текущего пользователя.');
                    }
                },
            ], 
            'phone' => 'nullable|string|regex:/^\+7[0-9]{10}$/', */
            'birthDay' => 'nullable|date',
            'workPlace' => 'nullable|string|max:255',
            'workPost' => 'nullable|string|max:255',
            'spetiality' => 'nullable|string|max:255',
            'tgNickname' => 'nullable|string|max:50',
            'passportSeria' => 'nullable|string|size:4',
            'passpoortNumber' => 'nullable|string|size:6',
            
            'studPhoto' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // Удаление пробелов и тире из snils, phone и postIndex
        $snils = preg_replace('/[\s\-]/', '', $request->input('snils'));
        $phone = preg_replace('/[\s\-]/', '', $request->input('phone'));
        $postIndex = preg_replace('/[\s\-]/', '', $request->input('postIndex'));
        // Сохранение фотографий и формирование массива с путями к ним
        $photoPaths = [];
        
        // Обновление данных пользователя
        /* return $request->input('course_id'); */
        $shouldBeCheckedOut = false;
        if ($request->input('isHealthyChildPartner') || $request->input('isHealthyChildFranch') || $request->input('isHealthyChild') || $request->input('isHealthyChildGk') || $request->input('isStudent') || $request->input('isAPPCP'))
            $shouldBeCheckedOut = true;
        /* $courseRegistration = CourseRegistration::create([
            'user_id' => $user->id,
            'isHealthyChild' => $request->input('isHealthyChild'),
            'isStudent' => $request->input('isStudent'),
            'isAPPCP' => $request->input('isAPPCP'),
            'isLegal' => $request->input('isLegal'),
            'shouldBeCheckedOut' => $shouldBeCheckedOut
        ]); */
        
        $courseRegistration = CourseRegistration::updateOrCreate(
            ['user_id' => $user->id, 'course_id' => $request->input('course_id')],
            [
                'isLegalHealthyChildGK' => $request->input('isLegalHealthyChildGK') ? true : false,
                'isStudent' => $request->input('isStudent') ? true : false,
                'isAPPCP' => $request->input('isAPPCP') ? true : false,
                'isHealthyChildGk' => $request->input('isHealthyChildGk') ? true : false,
                'isHealthyChildFranch' => $request->input('isHealthyChildFranch') ? true : false,
                'isLegalHealthyChildFranch' => $request->input('isLegalHealthyChildFranch') ? true : false,

                'isHealthyChildPartner' => $request->input('isHealthyChildPartner') ? true : false,
                'isLegalHealthyChildPartner' => $request->input('isLegalHealthyChildPartner') ? true : false,
                /* 'course_id'=> $request->input('course_id'), */

                'shouldBeCheckedOut' => $shouldBeCheckedOut,
            ]
        );
        /* return $courseRegistration; */

        if ($request->hasFile('studPhoto')) {
            //foreach ($request->file('passportPhoto') as $photo) {
                // Сохранение фото в папку "passport_photos"
            $photo = $request->file('studPhoto');
            $path = $photo->store('stud_photos', 'public');
            /* $photoPaths[] = $path; */
            UserDocument::updateOrCreate(
                ['user_id' => $user->id, 'type' => 'stud'],
                ['file' => $path,]
            );
            //}
        }
        // Сохранение фотографий и формирование массива с путями к ним
        /* if ($request->hasFile('passportPhoto')) {
            foreach ($request->file('passportPhoto') as $photo) {
                // Сохранение фото в папку "passport_photos"
                $path = $photo->store('passport_photos', options: 'public');
                CourseRegistrationDocuments::create([
                    'courseRegistrationId' => $courseRegistration->id, // ID регистрации курса
                    'type' => 'passport',
                    'file' => $path,
                ]);
            }
        } */
        $user->update([
            'SNILS' => $snils,
            'address' => $request->input('address'),
            'postIndex' => $postIndex,
            'email' => $request->input('email'),
            'phone' => $phone,
            'birthday' => $request->input('birthDay'),
            'workPlace' => $request->input('workPlace'),
            'workPost' => $request->input('workPost'),
            'spetiality' => $request->input('spetiality'),
            'tgNickname' => $request->input('tgNickname'),
            'passportSeria' => $request->input('passportSeria'),
            'passpoortNumber' => $request->input('passpoortNumber'),
            'hasSecondStep' => 1,
        ]);
        if ($request->input('url'))
            return redirect($request->input('url'));
        return redirect('/');
    }

    public function uploadDiplomMainPageScan(Request $request)
    {
        $user = User::find($request->user()->id);

        $validator = Validator::make($request->all(), [
            'diplomMainPage' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Сохранение фотографий и формирование массива с путями к ним
        if ($request->hasFile('diplomMainPage')) {
            $photo = $request->file('diplomMainPage');
            // Сохранение фото в папку "passport_photos"
            $path = $photo->store('diplom_photos', options: 'public');
            UserDocument::updateOrCreate(
                ['user_id' => $user->id, 'type' => 'diplom_main_page'],
                ['file' => $path]
            );
            /* UserDocument::create([
                'user_id' => $user->id, // ID регистрации курса
                'type' => 'passport_2_page',
                'file' => $path,
            ]); */
        }
    
        return redirect()->route('settings.documents');
    }

    public function uploadDiplomFirstPageScan(Request $request)
    {
        $user = User::find($request->user()->id);

        $validator = Validator::make($request->all(), [
            'diplomSupplementFirstPage' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Сохранение фотографий и формирование массива с путями к ним
        if ($request->hasFile('diplomSupplementFirstPage')) {
            $photo = $request->file('diplomSupplementFirstPage');
            // Сохранение фото в папку "passport_photos"
            $path = $photo->store('diplom_photos', options: 'public');
            UserDocument::updateOrCreate(
                ['user_id' => $user->id, 'type' => 'diplom_supplement_1_page'],
                ['file' => $path]
            );
            /* UserDocument::create([
                'user_id' => $user->id, // ID регистрации курса
                'type' => 'passport_2_page',
                'file' => $path,
            ]); */
        }
    
        return redirect()->route('settings.documents');
    }

    public function uploadDiplomSecondPageScan(Request $request)
    {
        $user = User::find($request->user()->id);

        $validator = Validator::make($request->all(), [
            'diplomSupplementSecondPage' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Сохранение фотографий и формирование массива с путями к ним
        if ($request->hasFile('diplomSupplementSecondPage')) {
            $photo = $request->file('diplomSupplementSecondPage');
            // Сохранение фото в папку "passport_photos"
            $path = $photo->store('diplom_photos', options: 'public');
            UserDocument::updateOrCreate(
                ['user_id' => $user->id, 'type' => 'diplom_supplement_2_page'],
                ['file' => $path]
            );
            /* UserDocument::create([
                'user_id' => $user->id, // ID регистрации курса
                'type' => 'passport_2_page',
                'file' => $path,
            ]); */
        }
    
        return redirect()->route('settings.documents');
    }

    public function uploadPassport2PageScan(Request $request)
    {
        $user = User::find($request->user()->id);

        $validator = Validator::make($request->all(), [
            'passportPage2' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Сохранение фотографий и формирование массива с путями к ним
        if ($request->hasFile('passportPage2')) {
            $photo = $request->file('passportPage2');
            // Сохранение фото в папку "passport_photos"
            $path = $photo->store('passport_photos', options: 'public');
            UserDocument::updateOrCreate(
                ['user_id' => $user->id, 'type' => 'passport_2_page'],
                ['file' => $path]
            );
            /* UserDocument::create([
                'user_id' => $user->id, // ID регистрации курса
                'type' => 'passport_2_page',
                'file' => $path,
            ]); */
        }
    
        return redirect()->route('settings.documents');
    }

    public function uploadPassport3PageScan(Request $request)
    {
        $user = User::find($request->user()->id);

        $validator = Validator::make($request->all(), [
            'passportPage3' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Сохранение фотографий и формирование массива с путями к ним
        if ($request->hasFile('passportPage3')) {
            $photo = $request->file('passportPage3');
            // Сохранение фото в папку "passport_photos"
            $path = $photo->store('passport_photos', options: 'public');
            UserDocument::updateOrCreate(
                ['user_id' => $user->id, 'type' => 'passport_3_page'],
                ['file' => $path]
            );
            /* UserDocument::create([
                'user_id' => $user->id, // ID регистрации курса
                'type' => 'passport_3_page',
                'file' => $path,
            ]); */
        }
    
        return redirect()->route('settings.documents');
    }

    public function uploadPassport5PageScan(Request $request)
    {
        $user = User::find($request->user()->id);

        $validator = Validator::make($request->all(), [
            'passportPage5' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Сохранение фотографий и формирование массива с путями к ним
        if ($request->hasFile('passportPage5')) {
            $photo = $request->file('passportPage5');
            // Сохранение фото в папку "passport_photos"
            $path = $photo->store('passport_photos', options: 'public');
            UserDocument::updateOrCreate(
                ['user_id' => $user->id, 'type' => 'passport_5_page'],
                ['file' => $path]
            );
            /* UserDocument::create([
                'user_id' => $user->id, // ID регистрации курса
                'type' => 'passport_5_page',
                'file' => $path,
            ]); */
        }
    
        return redirect()->route('settings.documents');
    }

    public function uploadSnilsScan(Request $request)
    {
        $user = User::find($request->user()->id);

        $validator = Validator::make($request->all(), [
            'snilsPhoto' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Сохранение фотографий и формирование массива с путями к ним
        /* if ($request->hasFile('snils')) {
            foreach ($request->file('snils') as $photo) {
                // Сохранение фото в папку "passport_photos"
                $path = $photo->store('snils_photos', options: 'public');
                UserDocument::create([
                    'user_id' => $user->id, // ID регистрации курса
                    'type' => 'snils',
                    'file' => $path,
                ]);
            }
        } */
        if ($request->hasFile('snilsPhoto')) {
            $photo = $request->file('snilsPhoto');
            // Сохранение фото в папку "passport_photos"
            $path = $photo->store('snils_photos', options: 'public');
            UserDocument::updateOrCreate(
                ['user_id' => $user->id, 'type' => 'snils'],
                ['file' => $path]
            );
            /* UserDocument::create([
                'user_id' => $user->id, // ID регистрации курса
                'type' => 'snils',
                'file' => $path,
            ]); */
        }
    
        return redirect()->route('settings.documents');
    }

    public function uploadStudScan(Request $request)
    {
        $user = User::find($request->user()->id);

        $validator = Validator::make($request->all(), [
            'studPhoto' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Сохранение фотографий и формирование массива с путями к ним
        /* if ($request->hasFile('snils')) {
            foreach ($request->file('snils') as $photo) {
                // Сохранение фото в папку "passport_photos"
                $path = $photo->store('snils_photos', options: 'public');
                UserDocument::create([
                    'user_id' => $user->id, // ID регистрации курса
                    'type' => 'snils',
                    'file' => $path,
                ]);
            }
        } */
        if ($request->hasFile('studPhoto')) {
            //foreach ($request->file('passportPhoto') as $photo) {
                // Сохранение фото в папку "passport_photos"
            $photo = $request->file('studPhoto');
            $path = $photo->store('stud_photos', 'public');
            /* $photoPaths[] = $path; */
            /* CourseRegistrationDocuments::updateOrCreate([
                'courseRegistrationId' => $courseRegistration->id, // ID регистрации курса
                'type' => 'stud',
                'file' => $path,
            ]); */
            UserDocument::updateOrCreate(
                ['user_id' => $user->id, 'type' => 'stud'],
                ['file' => $path]
            );
            //}
        }
    
        return redirect()->route('settings.documents');
    }
    

    
}

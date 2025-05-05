<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /* $date = date("Y-m-d");
        $events = Event::whereDate('start_date', $date)
                ->orderBy('start_time')
                ->get(); */
        /* $events = Event::orderBy('start_date')->orderBy('start_time')->get(); */
        return view('home');
    }

    public function nikolaeva() 
    {
        return view('nikolaeva');
    }


    public function kochetkova() 
    {
        return view('kochetkova');
    }
    public function kurbatov() 
    {
        return view('kurbatov');
    }

    public function contacts() 
    {
        return view('contacts');
    }

    public function about() 
    {
        return view('about');
    }

    public function offer()
    {
        return view('documents.offer');
    }

    public function privacy()
    {
        return view('documents.privacy');
    }

    public function policy()
    {
        return view('documents.policy');
    }

    public function contract()
    {
        return view('documents.contract');
    }
    
    public function agreement()
    {
        return view('documents.agreement');
    }
    
    public function kudryashova_17022025()
    {
        return view('kudryashova_17022025');
    }

    public function kudryashova_25022025()
    {
        return view('kudryashova_25022025');
    }

    public function kudryashova_15052025()
    {
        return view('kudryashova_15052025');
    }

    public function savchenko_21052025()
    {
        return view('savchenko_21052025');
    }

    public function tretyakova_02032025()
    {
        return view('tretyakova_02032025');
    }

    public function tretyakova_15032025()
    {
        return view('tretyakova_15032025');
    }

    public function tretyakova_17052025()
    {
        return view('tretyakova_17052025');
    }

    public function sotnikova_24052025()
    {
        return view('sotnikova_24052025');
    }

    public function turkenich_nakonechnaya_17042025()
    {
        return view('turkenich_nakonechnaya_17042025');
    }

    public function lisavenko_26052025()
    {
        return view('lisavenko_26052025');
    }

    public function norova_24042025()
    {
        return view('norova_24042025');
    }
}

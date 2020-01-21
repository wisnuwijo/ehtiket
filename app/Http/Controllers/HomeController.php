<?php

namespace Ehtiket\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $getEvent = DB::table('table_events')
                    ->orderBy('id','desc')
                    ->limit(3)
                    ->get();

        $data = [
            'events' => $getEvent
        ];
        return view('modules.home.index', $data);
    }

    public function home()
    {
        return view('home');
    }
}

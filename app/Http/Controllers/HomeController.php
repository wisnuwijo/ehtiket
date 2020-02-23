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

    public function eventlist(Request $request)
    {
        $getAllEvent = DB::table('table_events')
                        ->orderBy('id','desc')
                        ->get();

        $data = [
            'events' => $getAllEvent
        ];

        return view('landingPage.eventlist', $data);
    }

    public function event_detail(Request $request, $id)
    {
        $id = base64_decode($id);

        $getEvent = DB::table('table_events')
                    ->leftJoin('table_institution','table_events.institution_id','table_institution.id')
                    ->where('table_events.id', $id)
                    ->select([
                        'table_events.*',
                        'table_institution.institution_name',
                        'table_institution.institution_address'
                    ])
                    ->first();

        $getTicketClass = DB::table('table_ticket_type')
                          ->where('event_id', $id)
                          ->get();

        $data = [
            'event' => $getEvent,
            'ticketType' => $getTicketClass
        ];

        if (count($getEvent) > 0) {
            return view('landingPage.eventDetail', $data);
        } else {
            dd('event doesn\'t exist');
        }
    }

    public function register(Request $request)
    {
        $request->password = base64_encode(now());
        $request->role_id = 3;
        $request->created_at = now();

        // dd($request->all());

        $institutionId = DB::table('table_institution')->count() + 1;
        $insertInstitution = DB::table('table_institution')
                             ->insert([
                                 'id' => $institutionId,
                                 'institution_name' => $request->origin_institution,
                                 'institution_address' => $request->institution_address,
                                 'created_at' => now()
                             ]);

        $userId = DB::table('users')->count() + 1;
        $insertUser = DB::table('users')->insert([
            'id' => $userId,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => $request->role_id,
            'gender' => $request->gender,
            'identifier_type' => $request->identifier_type,
            'institution_id' => $institutionId,
            'origin_institution' => $request->origin_institution,
            'phone' => $request->phone,
            'created_at' => $request->created_at
        ]);

        $trxId = DB::table('table_transaction')->count() + 1;
        $insertTrx = DB::table('table_transaction')
                     ->insert([
                         'id' => $trxId,
                         'user_id' => $userId,
                         'ticket_type_id' => $request->ticket_type_id,
                         'event_id' => $request->event_id,
                         'paid' => 0,
                         'paid_confirmation' => 'no',
                         'created_at' => now()
                     ]);
    }
}

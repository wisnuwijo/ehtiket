<?php

namespace Ehtiket\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class RegistrantController extends Controller
{
    public function index()
    {
        $getEvent = DB::table('table_events')
                    ->where('table_events.institution_id', Auth::user()->institution_id)
                    ->join('table_transaction', 'table_events.id','=', 'table_transaction.event_id')
                    ->join('users', 'table_transaction.user_id', '=', 'users.id')
                    ->get();

        $data = [
            'data' => $getEvent
        ];

        return view('modules.registrant.index', $data);
    }
}

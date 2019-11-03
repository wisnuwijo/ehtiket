<?php

namespace Ehtiket\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $getData = DB::table('table_events')
                    ->where('institution_id', Auth::user()->institution_id)
                    ->orderBy('id','desc')
                    ->paginate(15);

        $data = [
            'events' => $getData
        ];

        return view('modules.event.index', $data);
    }

    public function add()
    {
        return view('modules.event.add');
    }

    public function store(Request $request)
    {
        $insertData = DB::table('table_events')
                        ->insert([
                            'institution_id' => Auth::user()->institution_id,
                            'event_name' => $request->event_name,
                            'event_date' => $request->event_date,
                            'event_start' => $request->event_date,
                            'event_finish' => $request->event_finish,
                            'event_place' => $request->event_place,
                            'event_info' => $request->event_info,
                            'created_at' => now(),
                        ]);
        if ($insertData) {
            return redirect('events')->with(['success' => 'Berhasil disimpan']);;
        }
    }
}

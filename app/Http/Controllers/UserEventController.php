<?php

namespace Ehtiket\Http\Controllers;

use Illuminate\Http\Request;
use Ehtiket\Transaction;
use Ehtiket\Event;
use Auth;

class UserEventController extends Controller
{
    public function index()
    {
        $getData = Transaction::where('user_id', Auth::user()->id)
                    ->groupBy('event_id')
                    ->orderBy('id','desc')
                    ->paginate(15);

        $data = [
            'events' => $getData
        ];

        return view('modules.user-event.index', $data);
    }

    public function event_detail(Request $request, $id)
    {
        $getEvent = Event::where('event_slug', $id)->first();
        $getTrx = Transaction::where('user_id', $request->user)->get();

        $data = [
            'event' => $getEvent,
            'trx' => $getTrx
        ];

        return view('modules.user-event.detail', $data);
    }
}

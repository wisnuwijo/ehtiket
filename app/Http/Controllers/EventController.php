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
            return redirect('events')->with(['success' => 'Berhasil disimpan']);
        }
    }

    public function create_ticket(Request $request)
    {
        return view('modules.event.create_ticket');
    }

    public function store_ticket(Request $request)
    {
        $insertTicketType = DB::table('table_ticket_type')
                            ->insert([
                                'name' => $request->name,
                                'event_id' => $request->event_id,
                                'price' => $request->price,
                                'info' => $request->info,
                                'created_at' => now()
                            ]);
        if ($insertTicketType) {
            return redirect('events')->with(['success' => 'Tiket berhasil disimpan']);
        }
    }

    public function edit(Request $request, $eventId)
    {
        $getEvent = DB::table('table_events')
                    ->where('id',$eventId)
                    ->first();

        $data = [
            'event' => $getEvent
        ];

        return view('modules.event.edit', $data);
    }

    public function update(Request $request)
    {
        $updateEvent = DB::table('table_events')
                        ->where('id', $request->id)
                        ->update([
                            'event_name' => $request->event_name,
                            'event_date' => $request->event_date,
                            'event_start' => $request->event_date,
                            'event_finish' => $request->event_finish,
                            'event_place' => $request->event_place,
                            'event_info' => $request->event_info,
                            'updated_at' => now()
                        ]);

        if ($updateEvent) {
            return redirect('events')->with(['success' => 'Acara berhasil diperbarui']);
        } else {
            return redirect('events');
        }
    }

    public function delete($eventId)
    {
        $deleteEvent = DB::table('table_events')
                        ->where('id', $eventId)
                        ->delete();

        $deleteTicketType = DB::table('table_ticket_type')
                            ->where('event_id', $eventId)
                            ->delete();

        if ($deleteEvent) {
            return redirect('events')->with(['success' => 'Acara berhasil dihapus']);
        } else {
            return redirect('events');
        }
    }

    public function event_detail($eventId)
    {
        $getEvent = DB::table('table_events')
                    ->where('id', $eventId)
                    ->first();

        $getTicket = DB::table('table_ticket_type')
                    ->where('event_id',$eventId)
                    ->get();

        $data = [
            'event' => $getEvent,
            'ticket' => $getTicket
        ];

        return view('modules.event.detail', $data);
    }
}

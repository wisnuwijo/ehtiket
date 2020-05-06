<?php

namespace Ehtiket\Http\Controllers;

use Illuminate\Http\Request;
use Ehtiket\Event;
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
        $getEventCategory = DB::table('table_event_category')->get();

        return view('modules.event.add', [
            'category' => $getEventCategory
        ]);
    }

    public function store(Request $request)
    {
        $attachment = $request->file('attachment');
        $logo = $request->file('event_logo');
        $background = $request->file('event_background');

        $eventId = DB::table('table_events')->count() + 1;

        $attachmentPath = null;
        $logoPath = null;
        $backgroundPath = null;

        $startTime = $request->event_date.' '.$request->event_start_time;
        $endTime = $request->event_finish.' '.$request->event_finish_time;

        if ($attachment != null) {
            $attachmentFilename = 'ATTACHMENT-'.strtoupper(str_replace(' ','-',$request->event_name)).'-'.now();
            $attachmentExtension = $attachment->getClientOriginalExtension();
            $attachmentFinalname = $attachmentFilename.'.'.$attachmentExtension;
            $attachmentDestination = 'public/storage/attachment/'.Auth::user()->institution_id.'/'.$eventId.'/'.date('Y-m-d');
            $moveAttachment = $attachment->move($attachmentDestination, $attachmentFinalname);
            $attachmentPath = $attachmentDestination.'/'.$attachmentFinalname.'.'.$attachmentExtension;
        }

        if ($logo != null) {
            $logoFilename = 'LOGO-'.strtoupper(str_replace(' ','-',$request->event_name)).'-'.now();
            $logoExtension = $logo->getClientOriginalExtension();
            $logoFinalname = $logoFilename.'.'.$logoExtension;
            $logoDestination = 'public/storage/images/logo/' . Auth::user()->institution_id . '/' . $eventId . '/' . date('Y-m-d');
            $moveLogo = $logo->move($logoDestination, $logoFinalname);
            $logoPath = $logoDestination.'/'.$logoFilename.'.'.$logoExtension;
        }

        if ($background != null) {
            $backgroundFilename = 'BACKGROUND-'.strtoupper(str_replace(' ','-',$request->event_name)).'-'.now();
            $backgroundExtension = $background->getClientOriginalExtension();
            $backgroundFinalname = $backgroundFilename.'.'.$backgroundExtension;
            $backgroundDestination = 'public/storage/images/background/' . Auth::user()->institution_id . '/' . $eventId . '/' . date('Y-m-d');
            $moveBackground = $background->move($backgroundDestination, $backgroundFinalname);
            $backgroundPath = $backgroundDestination.'/'.$backgroundFilename.'.'.$backgroundExtension;
        }

        $insertData = DB::table('table_events')
                        ->insert([
                            'id' => $eventId,
                            'event_slug' => $request->event_slug,
                            'institution_id' => Auth::user()->institution_id,
                            'event_name' => $request->event_name,
                            'event_date' => $request->event_date,
                            'event_start' => $startTime,
                            'event_finish' => $endTime,
                            'event_place' => $request->event_place,
                            'event_bank_name' => $request->event_bank_name,
                            'event_bank_owner' => $request->event_bank_owner,
                            'event_bank_number' => $request->event_bank_number,
                            'event_latitude' => $request->event_latitude,
                            'event_longitude' => $request->event_longitude,
                            'event_category' => $request->event_category,
                            'event_subscription' => $request->event_subscription,
                            'event_info' => $request->event_info,
                            'event_logo' => $logoPath,
                            'event_background' => $backgroundPath,
                            'attachments' => $attachmentDestination,
                            'created_at' => now(),
                        ]);
        if ($insertData) {
            $encode = base64_encode($eventId);
            return redirect('events/setting/'.$encode)->with(['success' => 'Berhasil disimpan, selanjutnya silahkan atur bagaimana kamu akan menjalankan acara kamu']);
        } else {
            return redirect('events')->with(['error' => 'Gagal disimpan']);
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
                    ->where('table_events.id', $eventId)
                    ->join('table_event_setting','table_events.id','table_event_setting.event_id')
                    ->join('table_event_category','table_events.event_category','table_event_category.id')
                    ->join('table_institution','table_events.institution_id','table_institution.id')
                    ->select([
                        'table_events.*',
                        'table_event_setting.max_ticket_per_transaction',
                        'table_event_setting.participant_type',
                        'table_event_setting.min_team_member',
                        'table_event_setting.max_team_member',
                        'table_event_setting.point_team_lead',
                        'table_event_setting.registration_cost',
                        'table_event_setting.registration_form',
                        'table_event_category.event_category',
                        'table_institution.institution_name',
                        'table_institution.institution_address',
                    ])
                    ->first();

        $regForm = isset($getEvent) ? json_decode($getEvent->registration_form) : null;

        $getTicket = DB::table('table_ticket_type')
                    ->where('event_id',$eventId)
                    ->get();

        $data = [
            'event' => $getEvent,
            'regForm' => $regForm,
            'ticket' => $getTicket
        ];

        return view('modules.event.detail', $data);
    }


    public function setting(Request $request, $eventId)
    {
        $eventId = base64_decode($eventId);

        $event = Event::where('id', $eventId)->first();

        $data = [
            'eventId' => $eventId,
            'event' => $event
        ];

        return view('modules.event.setting',$data);
    }

    public function save_setting(Request $request)
    {
        $formData = [];

        $formId = 0;
        if ($request->form_name != null) {
            $maxIndex = max(array_keys($request->form_name));
            for ($i=0; $i <= $maxIndex; $i++) {
                if (isset($request->form_name[$i])) {
                    $values = [];
                    if (isset($request->option[$i])) {
                        $values = $request->option[$i];
                    }

                    $formData[] = [
                        'id' => md5($formId),
                        'name' => $request->form_name[$i],
                        'type' => $request->form_type[$i],
                        'values' => $values,
                        'required' => $request->mandatory[$i],
                    ];

                    $formId++;
                }
            }
        }

        $finalFormData = json_encode($formData);

        $insertToSetting = DB::table('table_event_setting')
                            ->insert([
                                'event_id' => $request->event_id,
                                'max_ticket_per_transaction' => $request->max_ticket_per_transaction ?? 0,
                                'participant_type' => $request->participant_type,
                                'min_team_member' => $request->min_team_member,
                                'max_team_member' => $request->max_team_member,
                                'point_team_lead' => $request->point_team_lead,
                                'registration_cost' => $request->registration_cost,
                                'registration_form' => $finalFormData,
                                'created_at' => now(),
                            ]);

        if ($insertToSetting) {
            return redirect('events')->with(['success' => 'Acara berhasil ditambahkan']);
        } else {
            return redirect('events');
        }
    }

    public function register($eventSlug)
    {
        if (Auth::check()) {
            $getEvent = DB::table('table_events')
                        ->where('event_slug', $eventSlug)
                        ->leftJoin('table_event_setting','table_events.id','table_event_setting.event_id')
                        ->leftJoin('table_event_category','table_events.event_category','table_event_category.id')
                        ->select([
                            'table_events.*',
                            'table_event_setting.max_ticket_per_transaction',
                            'table_event_setting.participant_type',
                            'table_event_setting.min_team_member',
                            'table_event_setting.max_team_member',
                            'table_event_setting.point_team_lead',
                            'table_event_setting.registration_cost',
                            'table_event_setting.registration_form',
                            'table_event_category.id as eventCategoryId',
                            'table_event_category.event_category'
                        ])
                        ->first();

            $data = [
                'event' => $getEvent
            ];

            if (isset($getEvent)) {
                return view('landingPage.eventRegister', $data);
            } else {
                return abort(404);
            }
        } else {
            return view('landingPage.userRegisterOrLogin');
        }
    }

    public function join(Request $request, $eventSlug)
    {
        if (Auth::check()) {
            $getEvent = DB::table('table_events')
                        ->where('event_slug', $eventSlug)
                        ->leftJoin('table_event_setting','table_events.id','table_event_setting.event_id')
                        ->leftJoin('table_event_category','table_events.event_category','table_event_category.id')
                        ->select([
                            'table_events.*',
                            'table_event_setting.max_ticket_per_transaction',
                            'table_event_setting.participant_type',
                            'table_event_setting.min_team_member',
                            'table_event_setting.max_team_member',
                            'table_event_setting.point_team_lead',
                            'table_event_setting.registration_cost',
                            'table_event_setting.registration_form',
                            'table_event_category.id as eventCategoryId',
                            'table_event_category.event_category'
                        ])
                        ->first();

            $data = [
                'event' => $getEvent
            ];

            if (isset($getEvent)) {
                return view('landingPage.eventRegister', $data);
            } else {
                return abort(404);
            }
        } else {
            return view('landingPage.userRegisterOrLogin');
        }
    }
}

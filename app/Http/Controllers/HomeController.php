<?php

namespace Ehtiket\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Mail;
use Auth;
use Illuminate\Support\Facades\Storage;

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

    public function event_detail(Request $request, $slug)
    {
        $id = $slug;

        $getEvent = DB::table('table_events')
                    ->leftJoin('table_institution','table_events.institution_id','table_institution.id')
                    ->leftJoin('table_event_setting','table_events.id','table_event_setting.event_id')
                    ->where('table_events.id', base64_decode($id))
                    ->orWhere('table_events.event_slug', $id)
                    ->select([
                        'table_events.*',
                        'table_institution.institution_name',
                        'table_institution.institution_address',
                        'table_event_setting.max_ticket_per_transaction',
                        'table_event_setting.participant_type',
                        'table_event_setting.min_team_member',
                        'table_event_setting.max_team_member',
                        'table_event_setting.point_team_lead',
                        'table_event_setting.registration_cost',
                    ])
                    ->first();

        $getTicketClass = [];
        if (isset($getEvent)) {
            $getTicketClass = DB::table('table_ticket_type')
                              ->where('event_id', $getEvent->id)
                              ->get();
        }

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

    public function sendEmailTest(Request $request)
    {
        $to_name = 'Wisnu Wijokangko';
        $to_email = 'wisnuwijo33@gmail.com';
        $data = array(
            'name' => 'Meetevent',
            'body' => 'Somebody'
        );

        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                    ->subject('Test Email');
            $message->from('info.meetevent@gmail.com','Test Email');
        });
    }

    public function sendEmail($toName, $toEmail, $data, $subject)
    {
        Mail::send('emails.mail', $data, function($message) use ($toName, $toEmail, $subject) {
            $message->to($toEmail, $toName)
                    ->subject($subject);
            $message->from('info.meetevent@gmail.com',$subject);
        });
    }

    public function register(Request $request)
    {
        $getEventDetail = DB::table('table_events')
                          ->where('id', $request->event_id)
                          ->first();

        $getEventSetting = DB::table('table_event_setting')
                            ->where('event_id', $request->event_id)
                            ->first();

        $decodeForm = json_decode($getEventSetting->registration_form);
        $formData = [];
        if (count($decodeForm) > 0) {
            foreach ($decodeForm as $df) {
                $formId = $df->id;
                if (isset($request->$formId)) {
                    $data = $request->$formId;

                    if ($df->type == 'file') {
                        $path = Storage::putFile(
                            'public/form/images',
                            $request->$formId
                        );

                        $data = $path;
                    }

                    $formData[] = [
                        'id' => $df->id,
                        'name' => $df->name,
                        'type' => $df->type,
                        'required' => $df->required,
                        'values' => $df->values,
                        'data' => $data
                    ];
                }
            }
        }

        $finalFormData = json_encode($formData);
        $this->sendEmail(
            'Mitra Event',
            Auth::user()->email,
            array(
                'name' => 'Data Name',
                'body' => 'Data body'
            ),
            'Pendaftaran '.$getEventDetail->event_name
        );

        $insertTrx = DB::table('table_transaction')
                    ->insert([
                        'event_id' => $request->event_id,
                        'user_id' => Auth::user()->id,
                        'name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'gender' => Auth::user()->gender,
                        'identifier_type' => Auth::user()->identifier_type,
                        'identifier_file' => Auth::user()->identifier_file,
                        'institution_id' => Auth::user()->institution_id,
                        'origin_institution' => Auth::user()->origin_institution,
                        'phone' => Auth::user()->phone,
                        'ticket_type_id' => $request->ticket_type,
                        'paid' => $getEventDetail->event_subscription == 'paid' ? 0 : NULL,
                        'paid_confirmation' => $getEventDetail->event_subscription == 'paid' ? 'no' : NULL,
                        'custom_form_value' => json_encode($formData),
                        'created_at' => now()
                    ]);
    }
}

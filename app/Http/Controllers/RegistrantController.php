<?php

namespace Ehtiket\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class RegistrantController extends Controller
{
    public function index()
    {
        $getEvents = DB::table('table_events')
                    ->where('table_events.institution_id', Auth::user()->institution_id)
                    ->orderBy('id','desc')
                    ->get();

        $events = [];
        if (count($getEvents)) {
            foreach ($getEvents as $ge) {
                $getRegistrantQty = DB::table('table_transaction')
                                    ->where('event_id', $ge->id)
                                    ->get();
                $data = [
                    'id' => $ge->id,
                    'institution_id' => $ge->institution_id,
                    'event_name' => $ge->event_name,
                    'event_date' => $ge->event_date,
                    'event_start' => $ge->event_start,
                    'event_finish' => $ge->event_finish,
                    'event_place' => $ge->event_place,
                    'event_info' => $ge->event_info,
                    'created_at' => $ge->created_at,
                    'updated_at' => $ge->updated_at,
                    'registrant_qty' => count($getRegistrantQty),
                ];

                $events[] = $data;
            }
        }

        $toJson = json_encode($events);
        $toObject = json_decode($toJson);

        $getEventsAndUser = DB::table('table_events')
                            ->where('table_events.institution_id', Auth::user()->institution_id)
                            ->join('table_transaction', 'table_events.id','=', 'table_transaction.event_id')
                            ->join('users', 'table_transaction.user_id', '=', 'users.id')
                            ->get();

        $data = [
            'events' => $toObject,
            'data' => $getEventsAndUser
        ];

        return view('modules.registrant.index', $data);
    }

    public function registrant_list(Request $request, $eventId)
    {
        $getEventDetail = DB::table('table_events')
                          ->where('id', $eventId)
                          ->first();

        // if event category is lomba
        $tableColumns = [];
        if ($getEventDetail->event_category == 2) {
            // we need a little adjustment here to the table
            $getTransaction = DB::table('table_transaction')
                              ->where('table_transaction.event_id', $eventId)
                              ->get();

            $getFormData = DB::table('table_transaction')
                            ->where('table_transaction.event_id', $eventId)
                            ->first();

            $decodeForm = json_decode($getFormData->custom_form_value);

            for ($i=0; $i < count($decodeForm); $i++) {
                $tableColumns[] = $decodeForm[$i]->name;
            }
        } else {
            $getTransaction = DB::table('table_transaction')
                              ->leftJoin('table_events', 'table_transaction.event_id', 'table_events.id')
                              ->leftJoin('users', 'table_transaction.user_id', 'users.id')
                              ->leftJoin('table_ticket_type', 'table_transaction.ticket_type_id', 'table_ticket_type.id')
                              ->select([
                                'table_transaction.*',
                                'table_events.*',
                                'users.*',
                                'table_transaction.id as trx_id',
                                'table_ticket_type.name as ticket_name',
                                'table_ticket_type.price as ticket_price',
                              ])
                              ->where('table_transaction.event_id', $eventId)
                              ->get();
        }

        $data = [
            'events' => $getTransaction,
            'columns' => $tableColumns,
            'event_category' => $getEventDetail->event_category
        ];

        return view('modules.registrant.registrant_list', $data);
    }

    public function confirm_payment(Request $request)
    {
        $uploadedFile = $request->file('payment_evidence');
        $getUserId = DB::table('table_transaction')
                    ->where('table_transaction.id', $request->transaction_id)
                    ->first();

        $userId = 'USER_NOT_FOUND';
        if (isset($getUserId)) {
            $userId = $getUserId->user_id;
        }

        $path = $uploadedFile->store('public/images/payment_evidence/'.date('Y-m-d').'/'.$userId);

        $code = generateRandomString();
        $verifyCodeExistence = DB::table('table_ticket')
                                ->where('code', $code)
                                ->first();

        while (isset($verifyCodeExistence)) {
            $code = generateRandomString();
            $verifyCodeExistence = DB::table('table_ticket')
                                    ->where('code', $code)
                                    ->first();
        }

        $getTrxData = DB::table('table_transaction')
                      ->where('id', $request->transaction_id)
                      ->first();

        $checkTicketExistence = DB::table('table_ticket')
                                ->where([
                                    ['transaction_id', $request->transaction_id],
                                    ['user_id', $getTrxData->user_id]
                                ])
                                ->first();

        if (isset($checkTicketExistence)) {
            $saveTransaction = DB::table('table_transaction')
                                ->where('id', $request->transaction_id)
                                ->update([
                                    'paid' => $request->payment_number,
                                    'paid_confirmation' => 'yes',
                                    'paid_evidence' => $path,
                                    'updated_at' => now()
                                ]);
        } else {
            $generateTicket = DB::table('table_ticket')
                              ->insert([
                                  'code' => $code,
                                  'ticket_type_id' => $getTrxData->ticket_type_id,
                                  'user_id' => $getTrxData->user_id,
                                  'transaction_id' => $request->transaction_id,
                                  'created_at' => now(),
                              ]);

            $saveTransaction = DB::table('table_transaction')
                                ->where('id', $request->transaction_id)
                                ->update([
                                    'paid' => $request->payment_number,
                                    'paid_confirmation' => 'yes',
                                    'paid_evidence' => $path,
                                    'created_at' => now()
                                ]);
        }


        return redirect()
                ->back()
                ->with(['success' => 'Informasi pembayaran berhasil diperbarui']);
    }

    public function detail_transaction(Request $request)
    {
        $getEventDetail = DB::table('table_transaction')
                          ->where('table_transaction.id',$request->trx_id)
                          ->leftJoin('table_events','table_transaction.event_id','table_events.id')
                          ->leftJoin('table_event_setting','table_transaction.event_id','table_event_setting.event_id')
                          ->select([
                              'table_events.*',
                              'table_event_setting.max_ticket_per_transaction',
                              'table_event_setting.participant_type',
                              'table_event_setting.min_team_member',
                              'table_event_setting.max_team_member',
                              'table_event_setting.point_team_lead',
                              'table_event_setting.registration_cost'
                          ])
                          ->first();

        if ($getEventDetail->event_category == 2) {
            // if event category is lomba
            $getDetailTrx = DB::table('table_transaction')
                            ->where('id', $request->trx_id)
                            ->first();

            $getData = [];
            if (isset($getDetailTrx)) {
                $getData = json_decode($getDetailTrx->custom_form_value);
            }
        } else {
            $getData = DB::table('table_transaction')
                        ->leftJoin('users','table_transaction.user_id','users.id')
                        ->leftJoin('table_institution','users.institution_id', 'table_institution.id')
                        ->leftJoin('table_ticket_type','table_transaction.ticket_type_id','table_ticket_type.id')
                        ->leftJoin('table_events','table_transaction.event_id','table_events.id')
                        ->where('table_transaction.id', $request->trx_id)
                        ->select([
                            'table_transaction.*',
                            'users.*',
                            'table_institution.*',
                            'table_ticket_type.*',
                            'table_events.*',
                            'table_transaction.id as trx_id',
                            'users.name as user_name',
                            'table_ticket_type.name as ticket_type_name',
                        ])
                        ->first();
        }

        $data = [
            'event' => $getEventDetail,
            'data' => $getData
        ];

        return view('modules.registrant.detail_transaction',$data);
    }
}

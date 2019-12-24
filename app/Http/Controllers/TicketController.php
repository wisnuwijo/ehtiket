<?php

namespace Ehtiket\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use QrCode;

class TicketController extends Controller
{
    public function index(Request $request, $trxId)
    {
        $trxId = decrypt($trxId);

        $qrCode = '';
        $getData = DB::table('table_transaction')
                    ->leftJoin('table_ticket','table_transaction.id','table_ticket.transaction_id')
                    ->leftJoin('users', 'table_transaction.user_id','users.id')
                    ->leftJoin('table_institution','users.institution_id','table_institution.id')
                    ->leftJoin('table_events','table_transaction.event_id','table_events.id')
                    ->leftJoin('table_ticket_type','table_transaction.ticket_type_id','table_ticket_type.id')
                    ->where('table_transaction.id', $trxId)
                    ->select([
                        'table_transaction.*',
                        'table_ticket.*',
                        'users.name',
                        'users.email',
                        'table_institution.institution_name',
                        'table_ticket.id as ticket_table_id',
                        'table_transaction.id as transaction_table_id',
                        'table_ticket_type.name as ticket_type_name',
                        'table_events.event_name',
                        'table_events.event_start',
                    ])
                    ->first();

        $qrCode = $getData->code;

        $path = public_path('ticket/'.$qrCode.'.png');
        if (!is_file($qrCode)) {
            $saveQrCode = QrCode::size(1000)
                        ->format('png')
                        ->generate($qrCode, $path);
        }

        $getData->qr_path = $path;

        $customPaper = array(0, 0, 485.25, 1500);
        $pdf = PDF::loadview('modules.event.ticket', ['data' => $getData])->setPaper($customPaper, 'landscape');
        return $pdf->stream();
    }
}

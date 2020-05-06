<?php

namespace Ehtiket;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'table_transaction';

    public function event()
    {
        return $this->belongsTo('Ehtiket\Event','event_id');
    }

    public function user()
    {
        return $this->belongsTo('Ehtiket\User');
    }

    public function tickettype()
    {
        return $this->belongsTo('Ehtiket\TicketType','ticket_type_id');
    }
}

<?php

namespace Ehtiket;

use Illuminate\Database\Eloquent\Model;

class EventSetting extends Model
{
    protected $table = 'table_event_setting';

    public function event()
    {
        return $this->belongsTo('Ehtiket\Event','event_id');
    }
}

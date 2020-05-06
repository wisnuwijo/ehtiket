<?php

namespace Ehtiket;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'table_events';

    public function eventcategory()
    {
        return $this->belongsTo('Ehtiket\EventCategory','event_category');
    }

    public function institution()
    {
        return $this->belongsTo('Ehtiket\Institution','institution_id');
    }
}

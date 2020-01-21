<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id',
        'author',
        'plane_hours',
        'fact_hours',
        'week_hours',
        'effective_hours',
        'report_end_date',
        'report_start_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,  'user_id','id');
    }
}



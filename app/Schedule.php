<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['client_id', 'time', 'keynotes', 'visit_type', 'task_status', 'response_keyword', 'next_followup_date', 'sales_status', 'reason', 'created_by', 'created_at', 'updated_at'];

    public function user()
    {
      return  $this->belongsTo('App\User','created_by');
    }

    public function client()
    {
      return  $this->belongsTo('App\Client');
    }



}

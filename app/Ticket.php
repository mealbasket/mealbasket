<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Ticket extends Model
{
    public function Messages()
    {
        return $this->hasMany('App\TicketMessage', 'ticket_id', 'id');
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function getReadStatusAttribute()
    {
        if(Auth::User()->hasRole('admin')){
            return $this->admin_read;
        }
        else
        {
            return $this->user_read;
        }
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function Messages()
    {
        return $this->hasMany('App\TicketMessage', 'ticket_id', 'id');
    }
}

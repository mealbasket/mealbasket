<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserActivity extends Pivot
{
    public function incrVisits()
    {
        $this->visits += 1;
        $this->save();
    }
}

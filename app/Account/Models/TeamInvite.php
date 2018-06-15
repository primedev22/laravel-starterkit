<?php

namespace App\Account\Models;

use App\Account\Models\Account;
use Illuminate\Database\Eloquent\Model;

class TeamInvite extends Model
{
    protected $guarded = [];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}

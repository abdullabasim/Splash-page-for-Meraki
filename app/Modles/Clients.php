<?php

namespace App\Modles;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $table = "clients";

    protected $fillable = [
        'phone_number',
        'verify_code',
        'verify_at',
        'failure_count'

    ];
}

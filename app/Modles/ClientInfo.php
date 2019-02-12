<?php

namespace App\Modles;

use Illuminate\Database\Eloquent\Model;

class ClientInfo extends Model
{
    protected $table = "client_info";

    protected $fillable = [
        'node_id',
        'node_mac',
        'gateway_id',
        'client_ip',
        'client_mac',
        'client_id',
    ];
}

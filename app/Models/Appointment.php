<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'appointments';
	protected $primaryKey = 'id';

    protected $casts = [
        'end_date_time' => 'datetime:Y-m-d\TH:i:s\Z',
        'start_date_time' =>  'datetime:Y-m-d\TH:i:s\Z'
    ];
}

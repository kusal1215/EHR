<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{

    const SEEN = ['SEEN' => 1, 'PENDING' => 0];

    protected $fillable = [
        'doctor_id', 'patient_id', 'department', 'date', 'time', 'patient_email',
        'patient_phone_no', 'message', 'seen', 'aptId',
    ];

    public function doctor()
    {
        return $this->belongsTo('App\User', 'doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo('App\User', 'patient_id');
    }
}

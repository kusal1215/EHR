<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestAppointment extends Model
{
    protected $fillable = [
        'doctor_id', 'patient_id', 'date', 'time',
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

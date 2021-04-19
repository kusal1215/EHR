<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'doctor_id', 'patient_id', 'appointment_id', 'message'
    ];

    public function doctor()
    {
        return $this->belongsTo('App\User', 'doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo('App\User', 'patient_id');
    }

    public function appointment()
    {
        return $this->belongsTo('App\Appointment', 'appointment_id');
    }
}

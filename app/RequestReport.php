<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestReport extends Model
{
    const STATUS = ['UNSEEN' => 1, 'SEEN' => 2];

    protected $fillable = [
        'doctor_id', 'patient_id', 'details', 'status'
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

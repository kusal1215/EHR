<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'doctor_id', 'patient_id', 'department', 'date', 'time', 'patient_email',
        'patient_phone_no' ,'message' , 'seen' ,
    ];
}

<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const USER_LEVEL = ['ADMIN' => 1, 'DOCTOR' => 2, 'PATIENT' => 3];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_level', 'firstname', 'lastname', 'birthdate', 'gender',
        'address', 'spec', 'city', 'postal_code', 'phone', 'bio', 'status', 'user_image',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function doctor_appointments()
    {
        return $this->hasMany('App\Appointment', 'doctor_id');
    }

    public function patient_appointments()
    {
        return $this->hasMany('App\Appointment', 'patient_id');
    }

    public function doctor_note()
    {
        return $this->hasMany('App\Note', 'doctor_id');
    }

    public function patient_note()
    {
        return $this->hasMany('App\Note', 'patient_id');
    }

    public function doctor_report()
    {
        return $this->hasMany('App\Report', 'doctor_id');
    }

    public function patient_report()
    {
        return $this->hasMany('App\Report', 'patient_id');
    }

    public function doctor_req_appointments()
    {
        return $this->hasMany('App\RequestAppointment', 'doctor_id');
    }

    public function patient_req_appointments()
    {
        return $this->hasMany('App\RequestAppointment', 'patient_id');
    }
}

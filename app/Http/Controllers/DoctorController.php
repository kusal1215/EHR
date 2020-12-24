<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoctorController extends ParentDoctorController
{
    public function index(){
        return view('doctor.doctor');
    }
}

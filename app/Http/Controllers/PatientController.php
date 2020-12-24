<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends ParentPatientController
{
    public function index(){
        return view('patient.home');
    }
}

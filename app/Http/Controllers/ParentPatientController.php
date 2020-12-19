<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParentPatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('App\Http\Middleware\PatientManager');
    }
}

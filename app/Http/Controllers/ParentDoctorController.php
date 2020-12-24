<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParentDoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('App\Http\Middleware\DoctorManager');
    }
}

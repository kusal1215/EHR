<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends ParentAdminController
{
    public function index(){
        return view('admin.adminhome');
    }

    public function doctor(){
        return view('admin.doctors');
    }

    public function addDoctorPage(){
        return view('admin.addDoctor');
    }
}

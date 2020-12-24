<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParentAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('App\Http\Middleware\AdminManager');
    }
}

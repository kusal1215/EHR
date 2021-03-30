<?php

namespace App\Http\Controllers;

use App\User;
use Chatify\Http\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use services\ModalHelper\MessageHelper;

class PatientController extends ParentPatientController
{

    public function index()
    {
        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        return view('patient.home')->with($response);
    }
}

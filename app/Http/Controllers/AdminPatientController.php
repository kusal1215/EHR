<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use services\ModalHelper\MessageHelper;
use services\ModalHelper\UserHelper;

class AdminPatientController extends ParentAdminController
{

    public function patients()
    {
        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        $response['patients'] = UserHelper::getPatients();

        return view('admin.patients.patients')->with($response);
    }
}

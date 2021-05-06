<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use services\ModalHelper\MessageHelper;
use services\ModalHelper\VideoHelper;

class DoctorVideoController extends ParentDoctorController
{
    public function video()
    {
        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        $response['accessToken'] = VideoHelper::generate_token();

        return view('doctor.video.call')->with($response);
    }
}

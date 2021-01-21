<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\User;
use Chatify\Http\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPatientController extends ParentAdminController
{
    public function getMessages()
    {
        $messages = Message::join('users',  function ($join) {
            $join->on('messages.from_id', '=', 'users.id');
        })
            ->Where('messages.to_id', Auth::user()->id)
            ->Where('messages.seen', false)
            ->orderBy('messages.created_at', 'desc')
            ->get();

        $count = count($messages);

        return [
            'count' => $count,
            'messages' => $messages,
        ];
    }

    public function patients()
    {
        $getMessages = $this->getMessages();
        $count = $getMessages['count'];
        $messages = $getMessages['messages'];

        $patients = User::where('user_level', 3)->get();

//        dd($user);

        return view('admin.patients.patients',[
            'count' => $count,
            'messages' => $messages,
            'patients' => $patients
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Chatify\Http\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAppointmentController extends ParentAdminController
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

    public function appointment()
    {
        $getMessages = $this->getMessages();
        $count = $getMessages['count'];
        $messages = $getMessages['messages'];

        return view('admin.appointment',[
            'count' => $count,
            'messages' => $messages,
        ]);
    }

    public function addAppointment()
    {
        $getMessages = $this->getMessages();
        $count = $getMessages['count'];
        $messages = $getMessages['messages'];

        return view('admin.addAppointment',[
            'count' => $count,
            'messages' => $messages,
        ]);
    }
}

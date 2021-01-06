<?php

namespace App\Http\Controllers;

use Chatify\Http\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends ParentDoctorController
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

        // dd($messages);
        // dd(count($messages));

        return [
            'count' => $count,
            'messages' => $messages,
        ];
    }

    public function index(){

        $getMessages = $this->getMessages();
        $count = $getMessages['count'];
        $messages = $getMessages['messages'];

        return view('doctor.doctorhome',[
            'count' => $count,
            'messages' => $messages,
        ]);
    }
}

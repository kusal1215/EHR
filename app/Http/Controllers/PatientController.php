<?php

namespace App\Http\Controllers;

use App\User;
use Chatify\Http\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends ParentPatientController
{
    public function index(){

        $messages = Message::join('users',  function ($join) {
            $join->on('messages.from_id', '=', 'users.id');
//            ->orOn('messages.to_id', '=', 'users.id');
        })
//            ->where('messages.from_id', Auth::user()->id)
            ->Where('messages.to_id', Auth::user()->id)
            ->Where('messages.seen', false)
            ->orderBy('messages.created_at', 'desc')
            ->get();

        $count = count($messages);

//        dd($messages);
//        dd(count($messages));

        return view('patient.home',[
            'count' => $count,
            'messages' => $messages,
        ]);
    }
}

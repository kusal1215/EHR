<?php

namespace services\Message;

use Chatify\Http\Models\Message;

class MessageService
{
    protected $message;

    public function __construct()
    {
        $this->message = new Message();
    }

    public function getMessages($user_id)
    {
        $messages = Message::join('users',  function ($join) {
            $join->on('messages.from_id', '=', 'users.id');
        })
            ->Where('messages.to_id', $user_id)
            ->Where('messages.seen', false)
            ->orderBy('messages.created_at', 'desc')
            ->get();

        $count = count($messages);

        return [
            'count' => $count,
            'messages' => $messages,
        ];
    }
}

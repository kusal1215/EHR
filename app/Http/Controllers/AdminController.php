<?php

namespace App\Http\Controllers;

use App\User;
use Chatify\Http\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends ParentAdminController
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

    public function index(){

        $getMessages = $this->getMessages();
        $count = $getMessages['count'];
        $messages = $getMessages['messages'];

        $doctors = User::where('user_level', 2)
            ->orderBy('name', 'desc')
            ->get();

        $patient = User::where('user_level', 3)
            ->orderBy('name', 'desc')
            ->get();

        $doctors_count = count($doctors);
        $patient_count = count($patient);

        return view('admin.adminhome',[
            'doctors' => $doctors,
            'count' => $count,
            'messages' => $messages,
            'doctors_count' => $doctors_count,
            'patient_count' => $patient_count
        ]);
    }

    public function doctor(){

        $getMessages = $this->getMessages();
        $count = $getMessages['count'];
        $messages = $getMessages['messages'];

        $doctors = User::where('user_level', 2)
                        ->orderBy('name', 'desc')
                        ->get();

        return view('admin.doctors' ,[
            'doctors' => $doctors,
            'count' => $count,
            'messages' => $messages,
        ]);
    }

    public function addDoctorPage(){

        $getMessages = $this->getMessages();
        $count = $getMessages['count'];
        $messages = $getMessages['messages'];

        return view('admin.addDoctor' ,[
            'count' => $count,
            'messages' => $messages,
        ]);
    }

    public function addDoctorDB(Request $request){
        $user = new User();

        $user -> name = request('name');
        $user -> email = request('email');
        $user -> user_level = request('user_level');
        $user -> password = Hash::make(request('password'));
        $user -> firstname = request('firstname');
        $user -> lastname = request('lastname');
        $user -> birthdate = request('birthdate');
        $user -> gender = request('gender');
        $user -> address = request('address');
        $user -> spec = request('spec');
        $user -> city = request('city');
        $user -> postal_code = request('postal_code');
        $user -> phone = request('phone');
        $user -> bio = request('bio');
        $user -> status = request('status');

        if ($request -> hasFile('user_image')) {
            $file = $request -> file('user_image');
            $extension = $file -> getClientOriginalExtension(); //getting image extension
            $filename = time().'.'.$extension;
            $file -> move('uploads/doctorsProfile', $filename);
            $user -> user_image = $filename;
        }
        else{
            $user -> user_image = '';
        }

//        dd($user);

        $user->save();

        return redirect('/ehr/admin/addDoctor') -> with('msg','Data inserted successfully');
    }
}

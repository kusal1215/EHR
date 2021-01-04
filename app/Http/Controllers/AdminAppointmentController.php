<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\User;
use Chatify\Http\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

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

        $appointments = Appointment::all();

        return view('admin.appointment',[
            'count' => $count,
            'messages' => $messages,
            'appointments' => $appointments
        ]);
    }

    public function loadAddAppointment()
    {
        $number = 0;

        $getMessages = $this->getMessages();
        $count = $getMessages['count'];
        $messages = $getMessages['messages'];

        $patients = User::where('user_level', 3) ->get();
        $doctors = User::where('user_level', 2) ->get();

        $appointment = DB::table('appointments')->orderBy('updated_at', 'desc')->first();
        $appointments = Appointment::all();

        if ($appointments ->isEmpty())
        {
            $number =  $number + 1;
        }
        else{
            $number =  $number + $appointment->id + 1;
        }

        return view('admin.addAppointment',[
            'count' => $count,
            'messages' => $messages,
            'patients' => $patients,
            'doctors' => $doctors,
            'number' => $number,
        ]);
    }

    public function addAppointmentDB(Request $request)
    {
        $appointments = Appointment::all();

        $getMessages = $this->getMessages();
        $count = $getMessages['count'];
        $messages = $getMessages['messages'];

        $appointment = new Appointment();

        $appointment -> aptId = request('aptId');
        $appointment -> patient_id = request('patientId');
        $appointment -> department = request('dept');
        $appointment -> doctor_id = request('doctorId');
        $appointment -> date = request('aptDate');
        $appointment -> time = request('aptTime');
        $appointment -> patient_email = request('aptEmail');
        $appointment -> patient_phone_no = request('aptPhoneNo');
        $appointment -> message = request('aptMsg');

//        dd($appointment);

        $appointment -> save();

        return view('admin.appointment',[
            'count' => $count,
            'messages' => $messages,
            'appointments' => $appointments
        ]) -> with('msg','Data inserted successfully');

    }
}

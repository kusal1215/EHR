<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use services\ModalHelper\AppointmentHelper;
use services\ModalHelper\MessageHelper;
use services\ModalHelper\UserHelper;

class DoctorAppointmentController extends ParentDoctorController
{
    public function appointment()
    {
        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        $response['appointments'] = AppointmentHelper::getAll();

        return view('doctor.appointments.all')->with($response);
    }

    public function appointmentView($id)
    {
        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        $response['appointment'] = AppointmentHelper::get($id);

        return view('doctor.appointments.view')->with($response);
    }

    public function appointmentSeen($id)
    {
        AppointmentHelper::changeSeen($id, Appointment::SEEN['SEEN']);

        return redirect()->back()->with('msg', 'Appointment marked as seen.');
    }

    public function appointmentPending($id)
    {
        AppointmentHelper::changeSeen($id, Appointment::SEEN['PENDING']);

        return redirect()->back()->with('msg', 'Appointment marked as pending.');
    }
}

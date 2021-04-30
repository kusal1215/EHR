<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use services\ModalHelper\AppointmentHelper;
use services\ModalHelper\MessageHelper;
use services\ModalHelper\RequestAppointmentHelper;
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

    public function appointmentAdd($id = null)
    {
        $response['number'] = 0;
        $response['request_appointment'] = null;

        if ($id) {
            $response['request_appointment'] = RequestAppointmentHelper::get($id);
        }

        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        $response['patients'] = UserHelper::getPatients();

        $response['appointment'] = AppointmentHelper::getLast();
        $response['appointments'] = AppointmentHelper::getAll();

        if ($response['appointments']->isEmpty()) {
            $response['number'] =  $response['number'] + 1;
        } else {
            $response['number'] =  $response['number'] + $response['appointment']->id + 1;
        }

        return view('doctor.appointments.add')->with($response);
    }

    public function appointmentStore(Request $request)
    {
        AppointmentHelper::create($request->all());

        return redirect(route('DoctorAppointmentManager.appointments'))->with('msg', 'Appointment added.');
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

    public function appointmentRequests()
    {
        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        RequestAppointmentHelper::markSeen(Auth::user()->id);

        return view('doctor.appointments.requests')->with($response);
    }
}

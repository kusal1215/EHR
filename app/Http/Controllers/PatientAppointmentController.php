<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use services\ModalHelper\AppointmentHelper;
use services\ModalHelper\MessageHelper;
use services\ModalHelper\RequestAppointmentHelper;
use services\ModalHelper\UserHelper;

class PatientAppointmentController extends ParentPatientController
{
    public function appointment()
    {
        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        $response['appointments'] = AppointmentHelper::getAll();

        return view('patient.appointments.all')->with($response);
    }

    public function appointmentView($id)
    {
        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        $response['appointment'] = AppointmentHelper::get($id);

        return view('patient.appointments.view')->with($response);
    }

    public function appointmentRequest()
    {
        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        $response['doctors'] = UserHelper::getDoctors();

        return view('patient.appointments.request')->with($response);
    }

    public function appointmentRequestSave(Request $request)
    {
        RequestAppointmentHelper::create($request->all());

        return redirect(route('PatientAppointmentManager.appointments'))->with('msg', 'Request Sent Successfully.');
    }
}

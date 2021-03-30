<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\User;
use Chatify\Http\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use services\ModalHelper\AppointmentHelper;
use services\ModalHelper\MessageHelper;
use services\ModalHelper\UserHelper;

use function PHPUnit\Framework\isEmpty;

class AdminAppointmentController extends ParentAdminController
{
    public function appointment()
    {
        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        $response['appointments'] = AppointmentHelper::getAll();

        return view('admin.appointment')->with($response);
    }

    public function loadAddAppointment()
    {
        $number = 0;

        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        $response['patients'] = UserHelper::getPatients();
        $response['doctors'] = UserHelper::getDoctors();

        $response['appointment'] = AppointmentHelper::getLast();
        $response['appointments'] = AppointmentHelper::getAll();

        if ($response['appointments']->isEmpty()) {
            $number =  $number + 1;
        } else {
            $number =  $number + $response['appointment']->id + 1;
        }

        return view('admin.addAppointment')->with($response);
    }

    public function addAppointmentDB(Request $request)
    {
        $response['appointments'] = AppointmentHelper::getAll();

        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['response'] = $getMessages['messages'];

        $appointment = AppointmentHelper::create($request->all());

        return redirect('/ehr/admin/appointments')->with($response);
    }

    public function destroy($id)
    {
        AppointmentHelper::delete($id);
    }

    public function editAppointment($id)
    {

        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        $response['appointment'] = AppointmentHelper::get($id);

        return view('admin.editAppointment')->with($response);
    }

    public function updateAppointment($id, Request $request)
    {

        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['response'] = $getMessages['messages'];

        $response['appointments'] = AppointmentHelper::getAll();

        AppointmentHelper::updateAppointment($id, $request->all());

        return redirect('/ehr/admin/appointments')->with($response);
    }
}

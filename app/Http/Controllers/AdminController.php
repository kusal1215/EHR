<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\User;
use Chatify\Http\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use services\ModalHelper\AppointmentHelper;
use services\ModalHelper\MessageHelper;
use services\ModalHelper\UserHelper;

class AdminController extends ParentAdminController
{
    public function index()
    {

        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        $response['doctors'] = UserHelper::getDoctors();
        $response['patient'] = UserHelper::getPatients();

        $response['attend_patients_count'] = AppointmentHelper::getAttend();
        $response['pendings_patients_count'] = AppointmentHelper::getPending();

        $response['attend'] = AppointmentHelper::getAttendPaginate();
        $response['pendings'] = AppointmentHelper::getPendingPaginate();

        $response['appointments'] = AppointmentHelper::getPaginate(5);

        $response['doctors_count'] = count($response['doctors']);
        $response['patient_count'] = count($response['patient']);
        $response['attend_count'] = count($response['attend_patients_count']);
        $response['pending_count'] = count($response['pendings_patients_count']);

        return view('admin.adminhome')->with($response);
    }

    public function doctor()
    {

        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        $response['doctors'] = UserHelper::getDoctors();

        return view('admin.doctors')->with($response);
    }

    public function deleteDoctor($id)
    {
        UserHelper::delete($id);
    }

    public function addDoctorPage()
    {

        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        return view('admin.addDoctor')->with($response);
    }

    public function addDoctorDB(Request $request)
    {
        $user = UserHelper::addDoctor($request);

        return redirect('/ehr/admin/addDoctor')->with('msg', 'Data inserted successfully');
    }
}

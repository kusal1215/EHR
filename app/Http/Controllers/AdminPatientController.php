<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use services\ModalHelper\MessageHelper;
use services\ModalHelper\UserHelper;

class AdminPatientController extends ParentAdminController
{

    public function patients()
    {
        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        $response['patients'] = UserHelper::getPatients();

//        dd($response);

        return view('admin.patients.patients')->with($response);
    }

    public function addPatientView()
    {

        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        return view('admin.patients.addPatient')->with($response);
    }

    public function addPatient(Request $request)
    {
        $user = UserHelper::addPatient($request);

        return redirect('/ehr/admin/addPatientView')->with('msg', 'Data inserted successfully');
    }

    public function deletePatient($id)
    {
        UserHelper::delete($id);
    }

    public function editPatientView($id)
    {
        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        $response['patient'] = UserHelper::get($id);

        return view('admin.patients.editPatient')->with($response);
    }

    public function updatePatient($id, Request $request)
    {
        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        $response['patients'] = UserHelper::getPatients();

        UserHelper::updatePatient($id, $request->all());

        return view('admin.patients.patients')->with($response);
    }

}

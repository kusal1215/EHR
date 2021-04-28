<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use services\ModalHelper\MessageHelper;
use services\ModalHelper\ReportHelper;
use services\ModalHelper\RequestReportHelper;
use services\ModalHelper\UserHelper;
use Barryvdh\DomPDF\Facade as PDF;

class PatientReportController extends ParentPatientController
{
    public function all()
    {
        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        return view('patient.reports.all')->with($response);
    }

    public function view($id)
    {
        $response['report'] = ReportHelper::get($id);

        $pdf = PDF::loadView('patient.reports.view', $response);

        return $pdf->stream('report.pdf');
    }

    public function reportRequest()
    {
        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        $response['doctors'] = UserHelper::getDoctors();

        return view('patient.reports.request')->with($response);
    }

    public function reportRequestSave(Request $request)
    {
        RequestReportHelper::create($request->all());

        return redirect(route('PatientReportManager.reports'))->with('msg', 'Request Sent Successfully.');
    }
}

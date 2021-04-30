<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use services\ModalHelper\MessageHelper;
use services\ModalHelper\ReportHelper;
use services\ModalHelper\UserHelper;
use Barryvdh\DomPDF\Facade as PDF;
use services\ModalHelper\RequestReportHelper;

class DoctorReportController extends Controller
{
    public function all()
    {
        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        return view('doctor.reports.all')->with($response);
    }

    public function add($id = null)
    {
        $response['request_report'] = null;

        if ($id) {
            $response['request_report'] = RequestReportHelper::get($id);
        }
        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        $response['patients'] = UserHelper::getPatients();

        return view('doctor.reports.add')->with($response);
    }

    public function save(Request $request)
    {
        ReportHelper::saveReport($request->all(), Auth::user()->id);

        return redirect(route('DoctorReportManager.reports.all'))->with('msg', 'Report Generated Successfully.');
    }

    public function edit($id)
    {
        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        $response['report'] = ReportHelper::get($id);

        $response['patients'] = UserHelper::getPatients();

        return view('doctor.reports.edit')->with($response);
    }

    public function view($id)
    {
        $response['report'] = ReportHelper::get($id);

        $pdf = PDF::loadView('doctor.reports.view', $response);

        return $pdf->stream('report.pdf');
    }

    public function update(Request $request, $id)
    {
        ReportHelper::updateReport($request->all(), $id);

        return redirect(route('DoctorReportManager.reports.all'))->with('msg', 'Report Updated Successfully.');
    }

    public function delete($id)
    {
        ReportHelper::delete($id);

        return redirect(route('DoctorReportManager.reports.all'))->with('msg', 'Report Deleted Successfully.');
    }

    public function requests()
    {
        $getMessages = MessageHelper::getMessages(Auth::user()->id);
        $response['count'] = $getMessages['count'];
        $response['messages'] = $getMessages['messages'];

        RequestReportHelper::markSeen(Auth::user()->id);

        return view('doctor.reports.requests')->with($response);
    }
}

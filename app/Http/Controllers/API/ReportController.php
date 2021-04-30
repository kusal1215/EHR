<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use services\ModalHelper\ReportHelper;

class ReportController extends Controller
{
    public $successStatus = 200;

    public function getReport($name, $age)
    {
        $report = ReportHelper::getReportApi($name, $age);

        if ($report) {
            return response()->json(['success' => true, 'report' => $report], $this->successStatus);
        } else {
            return response()->json(['success' => false, 'report' => $report], $this->successStatus);
        }
    }
}

<?php

namespace services\Report;

use App\Report;
use services\ModalHelper\UserHelper;

class ReportService
{
    protected $report;

    public function __construct()
    {
        $this->report = new Report();
    }

    public function get($id)
    {
        return $this->report->find($id);
    }

    public function getAll()
    {
        return $this->report->all();
    }

    public function getReportApi($name, $age)
    {
        return $this->report->where('name', $name)->where('age', $age)->orderBy('created_at', 'desc')->first();
    }

    public function create($data)
    {
        return $this->report->create($data);
    }

    /**
     * update
     *
     * @param  mixed $report
     * @param  mixed $data
     * @return void
     */
    public function update(Report $report, array $data)
    {
        return $report->update($this->edit($report, $data));
    }

    /**
     * edit
     *
     * @param  mixed $report
     * @param  mixed $data
     */
    protected function edit(Report $report, $data)
    {
        return array_merge($report->toArray(), $data);
    }

    public function delete($id)
    {
        $report = $this->get($id);
        return $report->delete();
    }

    public function saveReport($data, $doctor_id)
    {
        $patient = UserHelper::get($data['patient_id']);
        $data['doctor_id'] = $doctor_id;
        $data['name'] = $patient->name;

        return $this->create($data);
    }

    public function updateReport($data, $id)
    {
        $report = $this->get($id);
        $this->update($report, $data);
    }
}

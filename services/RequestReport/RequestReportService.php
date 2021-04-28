<?php

namespace services\RequestReport;

use App\RequestReport;

class RequestReportService
{
    protected $request_report;

    public function __construct()
    {
        $this->request_report = new RequestReport();
    }

    public function get($id)
    {
        return $this->request_report->find($id);
    }

    public function getAll()
    {
        return $this->request_report->all();
    }

    public function create($data)
    {
        return $this->request_report->create($data);
    }

    /**
     * update
     *
     * @param  mixed $request_report
     * @param  mixed $data
     * @return void
     */
    public function update(RequestReport $request_report, array $data)
    {
        return $request_report->update($this->edit($request_report, $data));
    }

    /**
     * edit
     *
     * @param  mixed $request_report
     * @param  mixed $data
     */
    protected function edit(RequestReport $request_report, $data)
    {
        return array_merge($request_report->toArray(), $data);
    }

    public function delete($id)
    {
        $request_report = $this->get($id);
        return $request_report->delete();
    }
}

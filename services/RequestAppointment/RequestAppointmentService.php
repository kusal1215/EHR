<?php

namespace services\RequestAppointment;

use App\RequestAppointment;

class RequestAppointmentService
{
    protected $request_appointment;

    public function __construct()
    {
        $this->request_appointment = new RequestAppointment();
    }

    public function get($id)
    {
        return $this->request_appointment->find($id);
    }

    public function getAll()
    {
        return $this->request_appointment->all();
    }

    public function create($data)
    {
        return $this->request_appointment->create($data);
    }

    /**
     * update
     *
     * @param  mixed $request_appointment
     * @param  mixed $data
     * @return void
     */
    public function update(RequestAppointment $request_appointment, array $data)
    {
        return $request_appointment->update($this->edit($request_appointment, $data));
    }

    /**
     * edit
     *
     * @param  mixed $request_appointment
     * @param  mixed $data
     */
    protected function edit(RequestAppointment $request_appointment, $data)
    {
        return array_merge($request_appointment->toArray(), $data);
    }

    public function delete($id)
    {
        $request_appointment = $this->get($id);
        return $request_appointment->delete();
    }
}

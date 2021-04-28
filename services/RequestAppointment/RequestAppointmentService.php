<?php

namespace services\RequestAppointment;

use App\RequestAppointment;
use services\ModalHelper\UserHelper;

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

    public function markSeen($id)
    {
        $doctor = UserHelper::get($id);

        foreach ($doctor->doctor_req_appointments as $req_appointment) {
            $req_appointment->status = RequestAppointment::STATUS['SEEN'];
            $req_appointment->save();
        }
    }

    public function getUnseenCount($id)
    {
        $count = 0;

        $doctor = UserHelper::get($id);
        foreach ($doctor->doctor_req_appointments as $req_appointment) {
            if ($req_appointment->status == RequestAppointment::STATUS['UNSEEN']) {
                $count++;
            }
        }

        return $count;
    }
}

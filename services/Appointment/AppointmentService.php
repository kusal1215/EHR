<?php

namespace services\Appointment;

use App\Appointment;

class AppointmentService
{
    protected $appointment;

    public function __construct()
    {
        $this->appointment = new Appointment();
    }

    public function get($id)
    {
        return $this->appointment->find($id);
    }

    public function getAll()
    {
        return $this->appointment->all();
    }

    public function getLast()
    {
        return $this->appointment->orderBy('updated_at', 'desc')->first();
    }

    public function getAttend()
    {
        return $this->appointment->where('seen', 1)->get();
    }

    public function getPending()
    {
        return $this->appointment->where('seen', 0)->get();
    }

    public function getPaginate()
    {
        return $this->appointment->paginate(5);
    }

    public function getAttendPaginate()
    {
        return $this->appointment->where('seen', 1)->paginate(5);
    }

    public function getPendingPaginate()
    {
        return $this->appointment->where('seen', 0)->paginate(5);
    }

    public function create($data)
    {
        return $this->appointment->create($data);
    }

    /**
     * update
     *
     * @param  mixed $appointment
     * @param  mixed $data
     * @return void
     */
    public function update(Appointment $appointment, array $data)
    {
        return $appointment->update($this->edit($appointment, $data));
    }

    /**
     * edit
     *
     * @param  mixed $appointment
     * @param  mixed $data
     */
    protected function edit(Appointment $appointment, $data)
    {
        return array_merge($appointment->toArray(), $data);
    }

    public function delete($id)
    {
        $appointment = $this->get($id);
        return $appointment->delete();
    }

    public function updateAppointment($id, $data)
    {
        $appointment = $this->get($id);

        if ($appointment) {
            $this->update($appointment, $data);
        }
    }
}

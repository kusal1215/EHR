<?php

namespace services\ModalHelper;


use Illuminate\Support\Facades\Facade;

/**
 * Class RequestAppointmentHelper
 * @package services\ModalHelper
 */
class RequestAppointmentHelper extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\RequestAppointment\RequestAppointmentService';
    }
}

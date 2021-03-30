<?php

namespace services\ModalHelper;


use Illuminate\Support\Facades\Facade;

/**
 * Class AppointmentHelper
 * @package services\ModalHelper
 */
class AppointmentHelper extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\Appointment\AppointmentService';
    }
}

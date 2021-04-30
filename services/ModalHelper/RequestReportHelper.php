<?php

namespace services\ModalHelper;


use Illuminate\Support\Facades\Facade;

/**
 * Class RequestReportHelper
 * @package services\ModalHelper
 */
class RequestReportHelper extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\RequestReport\RequestReportService';
    }
}

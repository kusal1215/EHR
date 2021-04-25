<?php

namespace services\ModalHelper;


use Illuminate\Support\Facades\Facade;

/**
 * Class ReportHelper
 * @package services\ModalHelper
 */
class ReportHelper extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\Report\ReportService';
    }
}

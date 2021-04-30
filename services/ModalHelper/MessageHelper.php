<?php

namespace services\ModalHelper;


use Illuminate\Support\Facades\Facade;

/**
 * Class MessageHelper
 * @package services\ModalHelper
 */
class MessageHelper extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\Message\MessageService';
    }
}

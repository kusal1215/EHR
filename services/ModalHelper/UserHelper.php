<?php

namespace services\ModalHelper;


use Illuminate\Support\Facades\Facade;

/**
 * Class UserHelper
 * @package services\ModalHelper
 */
class UserHelper extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\User\UserService';
    }
}

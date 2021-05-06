<?php

namespace services\ModalHelper;


use Illuminate\Support\Facades\Facade;

/**
 * Class VideoHelper
 * @package services\ModalHelper
 */
class VideoHelper extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\Video\VideoService';
    }
}

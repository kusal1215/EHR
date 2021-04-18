<?php

namespace services\ModalHelper;


use Illuminate\Support\Facades\Facade;

/**
 * Class NoteHelper
 * @package services\ModalHelper
 */
class NoteHelper extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\Note\NoteService';
    }
}

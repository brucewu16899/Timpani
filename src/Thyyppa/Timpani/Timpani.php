<?php

/**
 * Timpani Facade
 * @author Travis Hyyppa <travishyyppa@gmail.com>
 *
 */

namespace Thyyppa\Timpani;

use Illuminate\Support\Facades\Facade;


/**
 * Timpani Facade
 */
class Timpani extends Facade
{

    /**
     * Return Facade accessor
     *
     * @return  string  Facade Accessor
     */
    protected static function getFacadeAccessor()
    {

        return 'timpani';

    }

}


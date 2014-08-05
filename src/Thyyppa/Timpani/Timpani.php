<?php

/**
 *
 * @author Travis Hyyppa <travishyyppa@gmail.com>
 *
 */

namespace Thyyppa\Timpani;

use Illuminate\Support\Facades\Facade;

class Timpani extends Facade
{

    protected static function getFacadeAccessor()
    {

        return 'timpani';

    }

}


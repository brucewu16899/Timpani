<?php

/**
 *
 * @author Travis Hyyppa <travishyyppa@gmail.com>
 *
 */

namespace Thyyppa\Timpani\Repository;

use Eloquent;

class Content extends Eloquent
{

    /**
     * Eloquent mass-assignable fields
     *
     * @var  array
     */
    protected $fillable = [ 'title', 'content', 'user_id' ];

}


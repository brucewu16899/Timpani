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

    protected $fillable = [ 'title', 'content', 'user_id' ];

}

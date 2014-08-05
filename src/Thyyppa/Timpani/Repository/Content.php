<?php

/**
 * Content Model
 * @author Travis Hyyppa <travishyyppa@gmail.com>
 *
 */

namespace Thyyppa\Timpani\Repository;

use Eloquent;


/**
 * Eloquent model for CMS content
 */
class Content extends Eloquent
{

    /**
     * Eloquent mass-assignable fields
     *
     * @var  array
     */
    protected $fillable = [ 'title', 'content', 'user_id' ];

}


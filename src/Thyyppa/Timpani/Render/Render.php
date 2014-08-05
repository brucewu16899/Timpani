<?php

/**
 *
 * @author Travis Hyyppa <travishyyppa@gmail.com>
 *
 */

namespace Thyyppa\Timpani\Render;

use Thyyppa\Timpani\Repository\ContentRepository;

class Render
{

    protected $content;


    /**
     * Constructor
     */
    function __construct( ContentRepository $content )
    {

        $this->content = $content;

    }



    public function byName( $name )
    {

        return $this->content->getByName( $name );

    }


}


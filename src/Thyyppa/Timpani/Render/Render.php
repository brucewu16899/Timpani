<?php

/**
 *
 * @author Travis Hyyppa <travishyyppa@gmail.com>
 *
 */

namespace Thyyppa\Timpani\Render;

use Thyyppa\Timpani\Repository\ContentRepository;

use View;

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



    public function stylesheets()
    {

        return View::make('timpani::stylesheets');

    }



    public function scripts()
    {

        return View::make('timpani::scripts');

    }


}


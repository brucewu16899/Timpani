<?php

/**
 * HTML Renderer
 * @author Travis Hyyppa <travishyyppa@gmail.com>
 *
 */

namespace Thyyppa\Timpani\Render;

use Thyyppa\Timpani\Repository\ContentRepository;

use View;


/**
 * Renders HTML content
 */
class Render
{

    /**
     * ContentRepository instance
     *
     * @var  ContentRepository
     */
    protected $content;


    /**
     * Constructor
     *
     * @param  ContentRepository  $content  Inject ContentRepository
     */
    function __construct( ContentRepository $content )
    {

        $this->content = $content;

    }



    /**
     * Get field contents by name
     *
     * @param   string  $name  Field name
     *
     * @return  string         Field contents
     */
    public function byName( $name )
    {

        return $this->content->getByName( $name );

    }



    /**
     * Render stylesheet markup
     *
     * @return  string  HTML
     */
    public function stylesheets()
    {

        return View::make('timpani::stylesheets');

    }



    /**
     * Render script markup
     *
     * @return  string  HTML
     */
    public function scripts()
    {

        return View::make('timpani::scripts');

    }


}


<?php

/**
 *
 * @author Travis Hyyppa <travishyyppa@gmail.com>
 *
 */

namespace Thyyppa\Timpani;

use Thyyppa\Timpani\Render\Render;
use Thyyppa\Timpani\Form\Form;

use Route;
use Redirect;

class FacadeHandler
{

    protected $render;

    protected $form;

    /**
     * Constructor
     */
    function __construct( Render $render, Form $form )
    {

        $this->render = $render;

        $this->form = $form;

    }



    public function render( $name )
    {

        return $this->render->byName( $name );

    }



    public function edit( $name, $label, $type = 'text', $attributes = [] )
    {

        return $this->form->edit( $name, $type, $attributes, $label );

    }



    public function code( $name, $label, $mode = null, $theme = null )
    {

        return $this->form->code( $name, $label, $mode, $theme );

    }



    public function submit( $text = 'Submit', $attributes = [])
    {

        return $this->form->submit( $text, $attributes );

    }



    public function post()
    {

        $this->form->post();

        return Redirect::back();

    }



    public function form_attributes( $attribtes )
    {

        return $this->form->setFormAttributes( $attribtes );

    }



    public function stylesheets()
    {

        return $this->render->stylesheets();

    }



    public function scripts()
    {

        return $this->render->scripts();

    }


}


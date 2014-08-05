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


        Route::get('/blar', function(){

            return 'Arrrg';

        });


    }



    public function render( $name )
    {

        return $this->render->byName( $name );

    }



    public function edit( $name, $label, $type = 'text', $attributes = [] )
    {

        return $this->form->form( $name, $type, $attributes, $label );

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


}


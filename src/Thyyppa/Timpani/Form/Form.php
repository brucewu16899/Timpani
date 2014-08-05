<?php

/**
 *
 * @author Travis Hyyppa <travishyyppa@gmail.com>
 *
 */

namespace Thyyppa\Timpani\Form;

use Thyyppa\Timpani\Repository\ContentRepository;

use Illuminate\Html\FormBuilder;
use Input;
use Session;
use Lang;

class Form
{

    protected $form;

    protected $form_open;

    protected $form_attributes = [];

    /**
     * Constructor
     */
    function __construct( FormBuilder $form, ContentRepository $content )
    {

        $this->form = $form;

        $this->content = $content;

    }



    public function form( $name, $type, $attributes, $label )
    {

        $output = '';

        if ( ! $this->form_open )

            $output .= $this->form_open = $this->form_open( $this->form_attributes );


        $value = $this->content->getByName( $name );

        if ( ! isset( $attributes['no_label'] ) )

            $output .= $this->form->label( $name, $label );

        $attributes['class'] = isset( $attributes['class'] ) ? $attributes['class'] : Lang::get('timpani::html.default_class.form_control');

        $output .= $this->formGroup( $this->form->$type( $name, $value, $attributes ) );

        return $output;

    }



    public function submit( $title, $attributes )
    {

        $attributes['class'] = isset($attributes['class']) ? $attributes['class'] : Lang::get('timpani::html.default_class.button');

        $output = '';

        $output .= $this->formGroup( $this->form->submit( $title, $attributes ) );

        $output .= $this->form->close();

        $this->form_open = false;

        return $output;

    }



    public function form_open( $attributes = [] )
    {

        if ( ! isset( $attributes['route'] ) )

            $attributes['route'] = 'timpani';


        $output = '';

        $output .= $this->form->open( $attributes );

        $output .= $this->messages();

        return $output;

    }


    public function setFormAttributes( $attributes )
    {

        $this->form_attributes = $attributes;

    }



    public function post()
    {

        $input = Input::except([ '_token' ]);

        if ( $this->content->insert( $input ) ) {

            Session::set( 'timpani_message', Lang::get('timpani::messages.updated') );
            Session::set( 'timpani_message_level', Lang::get('timpani::messages.level.success') );

            return true;

        } else {

            Session::set( 'timpani_message', Lang::get('timpani::messages.update_failed') );
            Session::set( 'timpani_message_level', Lang::get('timpani::messages.level.error') );

            return false;

        }

    }



    public function messages()
    {

        if ( Session::has('timpani_message') )

            return Lang::get( 'timpani::html.alert', [

                    'message' => Session::pull('timpani_message'),
                    'level' => Session::pull('timpani_message_level', 'info'),

                ]);

    }



    public function formGroup( $inner )
    {

        return Lang::get( 'timpani::html.formgroup', compact('inner') );

    }


}


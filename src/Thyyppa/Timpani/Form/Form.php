<?php

/**
 * Form Handler
 * @author Travis Hyyppa <travishyyppa@gmail.com>
 *
 */

namespace Thyyppa\Timpani\Form;

use Thyyppa\Timpani\Repository\ContentRepository;

use Illuminate\Html\FormBuilder;
use Input;
use Session;
use Lang;
use Config;


/**
 * Handles form generation and processing
 */
class Form
{

    /**
     * FormBuilder instance
     *
     * @var  FormBuilder
     */
    protected $form;

    /**
     * ContentRepository instance
     *
     * @var  ContentRepository
     */
    protected $content;

    /**
     * Form opened flag
     *
     * @var  bool
     */
    protected $form_open;

    /**
     * Form attributes array
     *
     * @var  array
     */
    protected $form_attributes = [];



    /**
     * Constructor
     *
     * @param  FormBuilder        $form     Inject FormBuilder
     * @param  ContentRepository  $content  Inject ContentRepository
     */
    function __construct( FormBuilder $form, ContentRepository $content )
    {

        $this->form = $form;

        $this->content = $content;

    }



    /**
     * Generic edit field
     *
     * @param   string  $name        Name of field
     * @param   string  $type        Type of field (text, password, email, etc)
     * @param   array   $attributes  HTML attribute array
     * @param   string  $label       Label contents
     *
     * @return  string               HTML
     */
    public function edit( $name, $type, $attributes, $label )
    {

        $output = '';

        // If the form hasn't been opened, open it
        if ( ! $this->form_open )

            $output .= $this->form_open = $this->form_open( $this->form_attributes );


        // Get the value from the repository
        $value = $this->content->getByName( $name );

        // Add the form label
        $output .= $label ? $this->form->label( $name, $label ) : '';

        // Use default class if not overridden
        $attributes['class'] = isset( $attributes['class'] ) ? $attributes['class'] : Lang::get('timpani::html.default_class.form_control');

        // Wrap output in a form group
        $output .= $this->formGroup( $this->form->$type( $name, $value, $attributes ) );

        return $output;

    }



    /**
     * Code editor field
     *
     * @param   string  $name   Name of field
     * @param   string  $label  Label contents
     * @param   string  $mode   Ace Editor mode
     * @param   string  $theme  Ace Editor theme
     *
     * @return  string          HTML
     */
    public function code( $name, $label, $mode, $theme )
    {

        $output = '';

        // Open form if it hasn't been opened
        if ( ! $this->form_open )

            $output .= $this->form_open = $this->form_open( $this->form_attributes );


        // Get default arguments from config if not set
        $mode  = $mode ?: Config::get( 'timpani::editor.default_mode' );
        $theme = $theme ?: Config::get( 'timpani::editor.default_theme' );
        $height = Config::get( 'timpani::editor.height' );

        // Get value from repo
        $value = $this->content->getByName( $name );

        // Add a label if needed
        $output .= $label ? $this->form->label( $name, $label ) : '';

        // Add the hidden text field
        $output .= $this->form->textarea( $name, $value, [ 'class' => Lang::get('timpani::html.default_class.form_control') ] );

        // Add the code editor container
        $output .= sprintf('<div data-timpani-editor="%s"
                                 data-timpani-editor-mode="%s"
                                 data-timpani-editor-theme="%s"
                                 style="width:100%%;min-height:%s;display:none;">%s</div>',
                                 $name, $mode, $theme, $height, $value);


        return $this->formGroup( $output );

    }



    /**
     * Submit button
     *
     * @param   string  $title       Button text/title
     * @param   array   $attributes  Button HTML attributes
     *
     * @return  string               HTML
     */
    public function submit( $title, $attributes )
    {

        $output = '';

        // Use default class if not overridden
        $attributes['class'] = isset($attributes['class']) ? $attributes['class'] : Lang::get('timpani::html.default_class.button');

        // Wrap button in a form group
        $output .= $this->formGroup( $this->form->submit( $title, $attributes ) );

        // Close the form
        $output .= $this->form->close();

        // Reset flag
        $this->form_open = false;

        return $output;

    }



    /**
     * Form open tag
     *
     * @param   array   $attributes  HTML attributes
     *
     * @return  string               HTML
     */
    public function form_open( $attributes = [] )
    {

        $output = '';

        // Use the default route if not overridden
        if ( ! isset( $attributes['route'] ) )

            $attributes['route'] = 'timpani';

        // Open the form
        $output .= $this->form->open( $attributes );

        // Display any session messages
        $output .= $this->messages();

        return $output;

    }



    /**
     * Form Attributes setter
     *
     * @param  array  $attributes  HTML attributes
     */
    public function setFormAttributes( $attributes )
    {

        $this->form_attributes = $attributes;

    }



    /**
     * Form post handler
     *
     * @return  bool  True on success
     */
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



    /**
     * Displays session messages for form
     *
     * @return  string  HTML
     */
    public function messages()
    {

        if ( Session::has('timpani_message') )

            return Lang::get( 'timpani::html.alert', [

                    'message' => Session::pull('timpani_message'),
                    'level' => Session::pull('timpani_message_level', 'info'),

                ]);

    }



    /**
     * Wraps content in a form group element
     *
     * @param   string  $inner  HTML
     *
     * @return  string          Wrapped HTML
     */
    public function formGroup( $inner )
    {

        return Lang::get( 'timpani::html.formgroup', compact('inner') );

    }


}


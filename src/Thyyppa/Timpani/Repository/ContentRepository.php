<?php

/**
 *
 * @author Travis Hyyppa <travishyyppa@gmail.com>
 *
 */

namespace Thyyppa\Timpani\Repository;

use Auth;


class ContentRepository
{

    protected $model;


    /**
     * Constructor
     */
    function __construct( Content $model )
    {

        $this->model = $model;

    }



    public function getByName( $name )
    {

        if ( $result = $this->model->where( 'name', $name )->orderBy( 'id', 'desc' )->first() )

            return $result->content;

    }



    public function insert( $values )
    {

        $user_id = Auth::user() ? Auth::user()->id : 0;

        $rows = [];

        foreach( $values as $name => $content )

            $rows[] = compact( 'name', 'content', 'user_id' );


        return $this->model->insert( $rows );

    }

}


<?php

/**
 * Content Repository
 * @author Travis Hyyppa <travishyyppa@gmail.com>
 *
 */

namespace Thyyppa\Timpani\Repository;

use Auth;


/**
 * Repository for CMS Content Model
 */
class ContentRepository
{

    /**
     * Content model instance
     *
     * @var  Content
     */
    protected $model;



    /**
     * Constructor
     *
     * @param  Content  $model  Inject Content model
     */
    function __construct( Content $model )
    {

        $this->model = $model;

    }



    /**
     * Get field content by name
     *
     * @param   string  $name  Field name
     *
     * @return  string         Field content
     */
    public function getByName( $name )
    {

        if ( $result = $this->model->where( 'name', $name )->orderBy( 'id', 'desc' )->first() )

            return $result->content;

    }



    /**
     * Insert fields into database
     *
     * @param   array   $values  Field data
     *
     * @return  bool             True on success
     */
    public function insert( $values )
    {

        $user_id = Auth::user() ? Auth::user()->id : 0;

        $rows = [];

        foreach( $values as $name => $content )

            $rows[] = compact( 'name', 'content', 'user_id' );


        return $this->model->insert( $rows );

    }


}


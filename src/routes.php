<?php


Route::post( Config::get('timpani::routes.post'), [
    'as' => 'timpani',
    'uses' => function(){
        return Timpani::post();
    }
]);

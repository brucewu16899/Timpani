<?php


Route::post( '/timpani', [
    'as' => 'timpani',
    'uses' => function(){
        return Timpani::post();
    }
]);

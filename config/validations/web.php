<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 24.03.2017
 * Time: 15:52.
 */

return [

    'client' => [
        'create' => [
            'name' => 'required',
            'email' => 'required|email|unique:clients,email,NULL,id,deleted_at,NULL',
            'credits' => 'required',
        ],
        'update' => [
            'name' => 'required',
            'email' => 'required|email|unique:clients,email',
            'credits' => 'required',
        ],
    ],
   
];

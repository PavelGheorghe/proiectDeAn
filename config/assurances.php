<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return [


    
    /**
     * Name of the application
     */
    'name' => env('APP_NAME', 'PORTALE ASSICURAZIONI'),

    /**
     * Date format used in output for datatables
     *
     * Must be a valid SQL date format string
     */
    'date_format' => '%d %M %Y %H:%i',
    'datepicker' => 'dd-mm-yy',
    'formatAPI' => 'U',
    'formatUI' => 'd-m-Y',
    'formatDB' => 'Y-m-d',
    'uploadPath' => 'uploads/',
    'faIconsPath' => 'fa-icons/png/256/',
    //TODO Change Links
    'sociallinks' => array(
        'facebook' => 'http://www.facebook.com/assurances',
        'twitter' => 'http://twitter.com/?lang=en',
        'google' => 'http://plus.google.com'
    ),
    'contcat_info' => array(
        'email' => 'assurances@gmail.com',
        'phone' => '+11 11111 11 11',
        'site' => 'www.assurances.it',
        'contact_us_email' => 'assurances@gmail.com',
    ),

    'terms_link' => 'http://www.assurances.com/terms',
    'privacy_link' => 'http://www.assurances.com/terms',

    'customMessage' => 'Welcome in application',
   

 

];

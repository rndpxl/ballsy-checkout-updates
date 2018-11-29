<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */
   
    'supportsCredentials' => false,
    'allowedOrigins' => ['https://ballwash.com', 'https://ball-wash.myshopify.com'],
    'allowedOriginsPatterns' => [],
    'allowedHeaders' => ['*'],
    'allowedMethods' => ['GET','PUT','POST'],
    'exposedHeaders' => [],
    'maxAge' => 0,

];

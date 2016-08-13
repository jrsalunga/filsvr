<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Name of route
    |--------------------------------------------------------------------------
    |
    | Enter the routes name to enable dynamic imagecache manipulation.
    | This handle will define the first part of the URI:
    | 
    | {route}/{template}/{filename}
    | 
    | Examples: "images", "img/cache"
    |
    */

    'route' => 'image', 

    /*
    |--------------------------------------------------------------------------
    | Storage paths
    |--------------------------------------------------------------------------
    |
    | The following paths will be searched for the image filename, submited 
    | by URI. 
    | 
    | Define as many directories as you like.
    |
    */
    
    'paths' => array(
        public_path('upload'),
        public_path("gallery-images"),
        public_path('asset/hotel-images'),
        public_path('asset/images'),
        public_path('asset/frontend/slider'),
        public_path('asset/admin/user-pic'),
        
        ),

    /*
    |--------------------------------------------------------------------------
    | Manipulation templates
    |--------------------------------------------------------------------------
    |
    | Here you may specify your own manipulation filter templates.
    | The keys of this array will define which templates 
    | are available in the URI:
    |
    | {route}/{template}/{filename}
    |
    | The values of this array will define which filter class
    | will be applied, by its fully qualified name.
    |
    */
    
    'templates' => array(

        'full' => function($image)
        {
            return $image->encode('jpg', 75);
        },

        'room-preview' => function($image)
        {
            return $image->fit(600,300)->encode('jpg', 75);
        },
        'gallery-thumb' => function($image)
        {
            $sizes = array(150,200,300,400);
            return $image->fit($sizes[rand(0,3)], 150);
        },
        'extra-small'=>function($image)
        {
            return $image->fit(50);
        },
        'avatar' => function($image)
        {
            return $image->fit(100, 100);
        },
        'small' => function($image)
        {
            return $image->fit(350, 300);
        },
        'medium' => 'Intervention\Image\Templates\Medium',
        'large' => 'Intervention\Image\Templates\Large',
        ),

    /*
    |--------------------------------------------------------------------------
    | Image Cache Lifetime
    |--------------------------------------------------------------------------
    |
    | Lifetime in minutes of the images handled by the imagecache route.
    |
    */

    'lifetime' => 43200,

    );

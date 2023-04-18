<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'admins' => 'c,r,u,d',
            'doctors' => 'c,r,u,d',
            'blogs' => 'c,r,u,d',
            'features' => 'c,r,u,d',
            'tags' => 'c,r,u,d',
            'book_types' => 'c,r,u,d',
            'website_reasons' => 'c,r,u,d',
            'payment_methods' => 'c,r,u,d',
            'experiences' => 'c,r,u,d',
            'consultations' => 'c,r,u,d',
            'courses' => 'c,r,u,d',
            'lessons' => 'c,r,u,d',
            'podcasts' => 'c,r,u,d',
            'roles' => 'c,r,u,d',
            'books' => 'c,r,u,d',
            "main_headers" => "u",
            "about_doctors" => "u",
            "about_podcasts" => "u",
            "about_headers" => "u",
            "special_advices" => "u",
            "store_headers" => "u",
            "center_consultings" => "u",

            
        ],
       
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];

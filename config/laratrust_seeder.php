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
        'super-admin' => [
            'admins' => 'c,r,u,d',
            'roles' => 'c,r,u,d',  // Roles && assign permission
            'managers' => 'c,r,u,d',
            'structures' => 'u' ,
            'about' => 'u' ,
            'privacy_terms' => 'u' ,
            'education'=>'r',
            'educational_stages'=>'c,r,u,d',
            'subjects' => 'c,r,u,d',
            'users'=>'r',
            'students'=>'c,r,u,d',
            'teachers'=>'c,r,u,d',
            'infos'=>'r,u',
            'packages'=>'r,d',
            'contacts'=>'r,d',
            'subscriptions'=>'r,u,d',
            'payments'=>'r,u',
            'banks'=>'c,r,u,d',
            'wallets'=>'r',
            'wallet-transactions'=>'r',
        ],
        'admin' => [
            'admins' => 'c,r,u,d',
            'users' => 'c,r,u,d',
            'structures' => 'u' ,
        ],
    ],

    'roles_translations' => [
        'super-admin' => [
            'en' => 'Super Admin',
            'ar' => 'مشرف عام'
        ],
        'admin' => [
            'en' => 'Admin',
            'ar' => 'مشرف'
        ],
        'teacher' => [
            'en' => 'User',
            'ar' => 'معلم'
        ],
        'assistant' => [
            'en' => 'Assistant',
            'ar' => 'مساعد معلم',
        ]
    ],

//    'roles_settings' => [
//        'super-admin' => [
//            'is_editable' => false,
//            'is_deletable' => false,
//            'has_additional_data' => false
//        ],
//        'admin' => [
//            'is_editable' => true,
//            'is_deletable' => false,
//            'has_additional_data' => false
//        ],
//        'teacher' => [
//            'is_editable' => true,
//            'is_deletable' => false,
//            'has_additional_data' => true
//        ],
//        'assistant' => [
//            'is_editable' => true,
//            'is_deletable' => false,
//            'has_additional_data' => true
//        ],
//    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        'l' => 'links'
    ]
];

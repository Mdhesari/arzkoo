<?php

return [
    'name' => 'Admin',
    'domain' => env('ADMIN_DOMAIN', 'http://localhost'),
    'prefix' => env('ADMIN_PREFIX', '/admin'),
    'auto_complete_limit' => 16,
    'webinars' => [
        'sell_video_commission' => 30
    ],
    'path' => [
        'general_setting' => 'setting/general'
    ],
    'lists' => [
        // [
        //     'title' => __(' Webinars '),
        //     'model' => '\App\Models\Webinar\Webinar',
        //     'icon' => 'ion ion-monitor',
        //     'route' => 'admin.webinars.list',
        //     'bg' => 'bg-info',
        // ],
        [
            'title' => __(' Users '),
            'model' => '\App\Models\MainUser',
            'icon' => 'ion ion-person-add',
            'route' => 'admin.users.list',
            'bg' => 'bg-success',
        ],
        // [
        //     'title' => __(' Payments '),
        //     'model' => '\App\Models\Payment\Payment',
        //     'icon' => 'ion ion-bag',
        //     'route' => 'admin.payments.list',
        //     'bg' => 'bg-warning',
        // ],
        // [
        //     'title' => __(' Categories '),
        //     'model' => '\App\Models\Category\Category',
        //     'icon' => 'ion ion-bag',
        //     'route' => 'admin.category.list',
        //     'bg' => 'bg-danger',
        // ],
    ],
    'roles' => [
        'super-admin' => [
            '*', // all permissions
        ],
        'admin' => [
            '!delete user', //  ! cannot do action
            '!create admin',
            '!update admin',
            '!delete admin',
            '!access-management',
        ],
        'writer' => [
            'write article'
        ],
        'support' => [
            'contact user',
        ],
    ],
    'permissions' => [
        'create user',
        'read user',
        'update user',
        'delete user',
        'create webinar',
        'read webinar',
        'update webinar',
        'delete webinar',
        'write article',
        'contact user',
        'access-management',
        'activity-log-management',
        'create admin',
        'read admin',
        'update admin',
        'delete admin',
        'create payment',
        'read payment',
        'update payment',
        'delete payment',
        'create setting',
        'read setting',
        'update setting',
        'delete setting',
        'create media',
        'read media',
        'update media',
        'delete media',
        'create category',
        'read category',
        'update category',
        'delete category',
    ]
];

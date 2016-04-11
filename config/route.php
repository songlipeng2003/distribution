<?php 
return [
    [
        'class' => 'yii\rest\UrlRule', 
        'controller' => 'region',
        'extraPatterns' => [
            'GET {id}/children' => 'children',
        ]
    ],
    # employee
    [
        'class' => 'yii\rest\UrlRule', 
        'controller' => 'employee/v1/account',
        'extraPatterns' => [
            'POST login' => 'login',
            'OPTIONS login' => 'options',
            'POST logout' => 'logout',
            'OPTIONS logout' => 'logout',
        ]
    ],
    [
        'class' => 'yii\rest\UrlRule', 
        'controller' => 'employee/v1/user',
        'extraPatterns' => [
            'POST change-password' => 'change-password',
            'OPTIONS change-password' => 'change-password',
        ]
    ],
];
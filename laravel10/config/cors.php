<?php

return [
    'paths' => ['api/*'],
    'allowed_methods' => ['*'], // 允许所有方法
    'allowed_origins' => ['*'], // 允许所有来源
    'allowed_headers' => ['*'], // 允许所有请求头
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];


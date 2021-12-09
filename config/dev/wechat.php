<?php declare(strict_types=1);

//wechat 应用配置
return [
    // 微信授权回调地址
    'callback' => 'https://www.xxx.com/oauth/wechat',

    // 微信授权成功之后，把jwt-token值回调给前端的地址
    'fontEndCallback'=>'https://www.xxx.com/#/user/oauth',
];

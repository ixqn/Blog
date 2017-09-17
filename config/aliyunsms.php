<?php

return [
    'accessKeyId' => "LTAI262rxMHbtrza",//参考本文档步骤2
    'accessKeySecret' => "mVe71KkcKnkZZzG150s3mbgDuYAwx4",//参考本文档步骤2
    //短信API产品名（短信产品名固定，无需修改）
    'product' => "Dysmsapi",
    //短信API产品域名（接口地址固定，无需修改）
    'domain' => "dysmsapi.aliyuncs.com",
    //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改）
    'region' => "cn-hangzhou",
    // 服务结点
    'endPointName' => "cn-hangzhou",
    // 模板签名
    'signName' => '竹文',
    // 模板CODE
    // 'templateCode' => 'SMS_95370051', // 测试,已废弃
    'templateCode' => [
        'sendRegCode' => 'SMS_96860003', // smsRegTemplate 注册时发送验证码
        'sendResetPasswordCode' => 'SMS_96865002',  // smsResetPasswordTemplate通过手机重置密码时发送验证码
    ],
];
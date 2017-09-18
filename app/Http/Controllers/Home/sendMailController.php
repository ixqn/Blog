<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

include_once app_path().'/SDK/'.'aliyun-php-sdk-core/Config.php';
use Dm\Request\V20151123 as Dm; 
use Profile\DefaultProfile;
use \DefaultAcsClient;

class sendMailController extends Controller
{
    public function __construct()
    {
        $mail = config('aliyunmail');
        $iClientProfile = DefaultProfile::getProfile("cn-hangzhou", $mail['accessKeyId'], $mail['accessKeySecret']);        
        $client = new DefaultAcsClient($iClientProfile);    
        $request = new Dm\SingleSendMailRequest();
        // 控制台创建的发信地址     
        $request->setAccountName($mail['setAccountName']);
        // 发信人昵称
        $request->setFromAlias($mail['setFromAlias']);
        $request->setAddressType(1);
        // 控制台创建的模板
        $request->setTagName("mailVerifyTemplate");
        $request->setReplyToAddress("true");

    }
    
    // 验证邮箱地址
    public function emailVerify($setToAddress, $setSubject, $setHtmlBody)
    {

        // 目标地址
        // 欢迎来到【作业部落】，请验证您的邮箱
        $request->setToAddress($setToAddress);
        $request->setSubject($setSubject);
        $request->setHtmlBody($setHtmlBody);

        $response = $client->getAcsResponse($request);
        return $response;




        // try {
        //     $response = $client->getAcsResponse($request);
        //     print_r($response);
        // }
        // catch (ClientException  $e) {
        //     print_r($e->getErrorCode());   
        //     print_r($e->getErrorMessage());   
        // }
        // catch (ServerException  $e) {        
        //     print_r($e->getErrorCode());   
        //     print_r($e->getErrorMessage());
        // }

    }

    // 通过邮箱找回密码
    public function emailReset()
    {
        // 目标地址
        $request->setToAddress($setToAddress);
        $request->setSubject($setSubject);
        $request->setHtmlBody($setHtmlBody);

        $response = $client->getAcsResponse($request);
        return $response;
    }
    

}



  
   

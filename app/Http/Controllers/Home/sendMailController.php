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
    public $request;
    public $client;
    public function __construct()
    {
        $mail = config('aliyunmail');
        $iClientProfile = DefaultProfile::getProfile("cn-hangzhou", $mail['accessKeyId'], $mail['accessKeySecret']);        
        $this->client = new DefaultAcsClient($iClientProfile);    
        $this-> request = new Dm\SingleSendMailRequest();
        // 控制台创建的发信地址     
        $this-> request->setAccountName($mail['setAccountName']);
        // 发信人昵称
        $this-> request->setFromAlias($mail['setFromAlias']);
        $this-> request->setAddressType(1);
        // 控制台创建的模板
        $this-> request->setTagName("mailVerifyTemplate");
        $this-> request->setReplyToAddress("true");

    }
    
    // 验证邮箱地址
    public function sendMail($setToAddress, $setSubject, $setHtmlBody)
    {

        // 目标地址
        // 欢迎来到【作业部落】，请验证您的邮箱
        $this-> request->setToAddress($setToAddress);
        $this-> request->setSubject($setSubject);
        $this-> request->setHtmlBody($setHtmlBody);

        $response = $this->client->getAcsResponse($this->request);
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



}



  
   

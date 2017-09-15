<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// include_once 'aliyun-php-sdk-core/Config.php';
include_once app_path().'/SDK/'.'aliyun-php-sdk-core/Config.php';
use Dm\Request\V20151123 as Dm; 
// include_once app_path().'/SDK/'.'aliyun-php-sdk-core/Profile/DefaultProfile.php';
// dd(__file__);
use Profile\DefaultProfile;
use \DefaultAcsClient;
class sendMailController extends Controller
{
    
    public function mailVerify(){
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
        // 目标地址
        $request->setToAddress("xqn@xqn.me");        
        $request->setSubject("邮件主题111");
        $request->setHtmlBody("邮件正文222");
        try {
            $response = $client->getAcsResponse($request);
            print_r($response);
        }
        catch (ClientException  $e) {
            print_r($e->getErrorCode());   
            print_r($e->getErrorMessage());   
        }
        catch (ServerException  $e) {        
            print_r($e->getErrorCode());   
            print_r($e->getErrorMessage());
        }

    }
    

}



  
   

<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Report;

class ReportController extends Controller
{
    // 插入投诉信息.
    public function add(Request $request)
    {
        $report = $request->all();

        $res = Report::create($report);

        if($res){
            $data = [
                'state'=>0,
                'msg'=>'我们已经收到您的举报,工作人员会尽快核实.'
            ];
        } else {
            $data = [
                'state'=>1,
                'msg'=>'系统异常,请稍后尝试.'
            ];
        }

        return $data;
    }
}

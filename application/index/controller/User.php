<?php
namespace app\index\controller;
use think\Controller;
//use think\db;
class User extends Controller
{
    public function index()
    {
        $project=[
            'name'=>'proj1',
            'starttime'=>'2018-1-1',
            'endtime'=>'2018-3-1',
            'contractor'=>'hanerx',
            'safetygrade'=>'高',
            'plan'=>'nothing here',
            'color'=>'high'
        ];
        $this->assign('project',$project);
        
        
        return $this->fetch('index');
    }
    public function waitinglist(){
        
        $waitinglist=[
            'list'=>[
                [
                'name'=>'item1',
                'user'=>'hanerx',
                'endtime'=>'2018-1-1',
                'status'=>'完成',
                'level'=>'严重'
                ]
            ],
            'status'=>1
        ];
        return json($waitinglist);
    }
    public function structuredata(){
        $style=[['color'=> '#F54F4A'],['color'=>'#FCCE10'],['color'=>'#B5C334']];
        $data=[[
            'name'=>'proj1',
            'itemStyle'=>$style[2],
            'value'=>5,
            'children'=>[['name'=>'proj2','itemStyle'=>$style[1],'value'=>2]]
        ]];
        $back=['data'=>$data,'status'=>1];
        return json($back);
    }
    public function waterfall(){
        $data=[['name'=>'proj','starttime'=>'2018-1-1 19:00','endtime'=>'2018-1-1 21:00','status'=>'YES'],['name'=>'proj2','starttime'=>'2018-1-1 11:00','endtime'=>'2018-1-1 13:00','status'=>'YES'],['name'=>'proj3','starttime'=>'2018-1-1 9:00','endtime'=>'2018-1-1 15:00','status'=>'NO']];
        $back=['data'=>$data,'status'=>1];
        return json($back);
    }
    public function resourcelist(){
        $data=[['name'=>'item1','uploader'=>'hanerx','uploadtime'=>'2019-1-1','status'=>'可用','safetygrade'=>0,'link'=>'https://www.baidu.com','type'=>'计划书']];
        $back=['data'=>$data,'status'=>1];
        return json($back);
    }
    public function chartingboxdata(){
        $data=[['user'=>'haner','status'=>'Note','time'=>'2018-1-1 9:00','note'=>'测试'],['user'=>'haner','status'=>'Debug','time'=>'2018-1-1 9:00','note'=>'table的下载不可用'],['user'=>'haner','status'=>'管理员','time'=>'2018-1-1 9:00','note'=>'测试']];
        $back=['data'=>$data,'status'=>1];
        return json($back);
    }
    public function email(){
        return $this->fetch('email');
    }
    public function emaillist(){
        return $this->fetch('email-list');
    }
    public function add(){
        return $this->fetch('add');
    }
    public function history(){
        return $this->fetch('history');
    }
    public function project(){
        return $this->fetch('project');
    }
    public function revise(){
        return $this->fetch('revise');
    }
    public function send(){
        return $this->fetch('send');
    }
    public function time(){
        return $this->fetch('time');
    }
}
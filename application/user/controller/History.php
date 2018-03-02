<?php
namespace app\user\controller;
use think\Controller;
//use think\db;
class History extends Controller
{
    public function index(){
        $project =new \app\api\controller\Project();
        $list=$project->gethistoryprojectbyuserid('1');
        $this->assign('list',$list);
        return $this->fetch('history');
    }
}
<?php
namespace app\user\controller;
use think\Controller;
//use think\db;
class Index extends Controller
{
    public function index(){
        $project=new \app\api\controller\Project();
        $waitinglist=$project->getuserwaitingprojectbyuserid('1');
        $workinglist=$project->getuserworkingprojectbyuserid('1');
        $this->assign("waitinglist",$waitinglist);
        $this->assign('workinglist',$workinglist);
        return $this->fetch('index');
    }
}
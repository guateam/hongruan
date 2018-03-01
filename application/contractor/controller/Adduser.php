<?php
namespace app\contractor\controller;
use think\Controller;
//use think\db;
class Adduser extends Controller
{
    public function index()
    {
        $project=new \app\api\controller\Project();
        $waitinglist=$project->getwaitinguserproject();
        $workinglist=$project->getworkingproject();
        $this->assign("waitinglist",$waitinglist);
        $this->assign("workinglist",$workinglist);
        return $this->fetch('adduser');
    }
}

<?php
namespace app\contractor\controller;
use think\Controller;
//use think\db;
class Addresource extends Controller
{
    public function index()
    {   
        $project=new \app\api\controller\Project();
        $waitinglist=$project->getwaitingresourceproject();
        $workinglist=$project->getworkingproject();
        $this->assign("waitinglist",$waitinglist);
        $this->assign("workinglist",$workinglist);
        return $this->fetch('addresource');
    }
}

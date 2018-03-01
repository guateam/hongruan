<?php
namespace app\contractor\controller;
use think\Controller;
//use think\db;
class History extends Controller
{
    public function index()
    {
        $project=new \app\api\controller\Project();
        $data=$project->gethistoryproject();
        $this->assign("data",$data);
        return $this->fetch('history');
    }
}

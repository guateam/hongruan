<?php
namespace app\user\controller;
use think\Controller;
//use think\db;
class Historyproject extends Controller
{
    public function index($id){
        $project=new \app\api\controller\Project();
            $data=$project->getbasicprojectbyid($id);
            if($data){
                $this->assign("project",$data);
                $children=$project->getchildrenproject($id);
                $this->assign("childrenlist",$children);
                $this->assign('id',$id);
                return $this->fetch('historyproject');
            }
            return $this->error("404 未知的历史项目");
    }

    public function getradarmap($id){
        $project=new \app\api\controller\Project();
        $data=$project->getradarmap($id);
        
    }
}
<?php
namespace app\contractor\controller;
use think\Controller;
//use think\db;
class Historyproject extends Controller
{
    public function index($id)
    {
        
            $project=new \app\api\controller\Project();
            $data=$project->getbasicprojectbyid($id);
            if($data){
                $this->assign("project",$data);
                $children=$project->getchildrenproject($id);
                $this->assign("childrenlist",$children);
                return $this->fetch('his-project');
            }
            return $this->error("404 未知的历史项目");
    }
}

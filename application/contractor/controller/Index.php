<?php
namespace app\contractor\controller;
use think\Controller;
//use think\db;
class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    public function getprojectpan(){
        $project=new \app\api\controller\Project();
        $data=$project->getprojectpan();
        if($data){
            $back=["data"=>$data,"status"=>1];
            return json($back);
        }
    }
}

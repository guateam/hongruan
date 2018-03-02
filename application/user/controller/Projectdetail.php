<?php
namespace app\user\controller;
use think\Controller;
//use think\db;
class Projectdetail extends Controller
{
    public function index($id)
    {   
        //project的基础数据
        $project=new \app\api\controller\Project();
        $data=$project->getbasicprojectbyid($id);
        if($data){
            $this->assign('project',$data);
            $this->assign('id',$id);
        }else{
            $this->error('不存在的项目');
        }
        return $this->fetch('projectdetail');
    }
    public function waitinglist($id){
        //获取需要
        $project=new \app\api\controller\Project();
        
        $data=$project->getprojectwatinglist($id);
        if($data){
            $back=['data'=>$data,'status'=>1];
            return json($back);
        }else{
            return json(['status'=>0]);
        }
    }
    public function structuredata($id){
        $project=new \app\api\controller\Project();
        
        $data=$project->getprojectstructuretree($id);
        if($data){
            $back=['data'=>[$data],'status'=>1];
            return json($back);
        }else{
            return json(['status'=>0]);
        }
        
    }
    public function waterfall($id){
        $project=new \app\api\controller\Project();
        
        $data=$project->getprojectwaterfall($id);
        if($data){
            $back=['data'=>$data,'status'=>1];
            return json($back);
        }else{
            return json(['status'=>0]);
        }
    }
    public function resourcelist($id){
        $project=new \app\api\controller\Project();
        
        $data=$project->getprojectresource($id,1);
        if($data){
            $back=['data'=>$data,'status'=>1];
            return json($back);
        }else{
            return json(['status'=>0]);
        }
    }
    public function chartingboxdata($id){
        $box=new \app\api\controller\ChatingBox();
        $project=new \app\api\controller\Project();
        
        $data=$box->read($id);
        if($data){
            $back=['data'=>$data,'status'=>1];
            return json($back);
        }else{
            return json(['status'=>0]);
        }
    }
}
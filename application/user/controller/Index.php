<?php
namespace app\user\controller;
use think\Controller;
//use think\db;
class Index extends Controller
{
    public function index()
    {   
        //project的基础数据
        $project=new \app\api\controller\Project();
        $data=$project->getbasicproject('000');
        if($data){
            $this->assign('project',$data);
        }else{
            $this->error('不存在的项目');
        }
        return $this->fetch('index');
    }
    public function waitinglist(){
        //获取需要
        $project=new \app\api\controller\Project();
        $id=($project->getbasicproject('000'))['id'];
        $data=$project->getprojectwatinglist($id);
        if($data){
            $back=['data'=>$data,'status'=>1];
            return json($back);
        }else{
            return json(['status'=>0]);
        }
    }
    public function structuredata(){
        $project=new \app\api\controller\Project();
        $id=($project->getbasicproject('000'))['id'];
        $data=$project->getprojectstructuretree($id);
        if($data){
            $back=['data'=>[$data],'status'=>1];
            return json($back);
        }else{
            return json(['status'=>0]);
        }
        
    }
    public function waterfall(){
        $project=new \app\api\controller\Project();
        $id=($project->getbasicproject('000'))['id'];
        $data=$project->getprojectwaterfall($id);
        if($data){
            $back=['data'=>$data,'status'=>1];
            return json($back);
        }else{
            return json(['status'=>0]);
        }
    }
    public function resourcelist(){
        $project=new \app\api\controller\Project();
        $id=($project->getbasicproject('000'))['id'];
        $data=$project->getprojectresource($id,1);
        if($data){
            $back=['data'=>$data,'status'=>1];
            return json($back);
        }else{
            return json(['status'=>0]);
        }
    }
    public function chartingboxdata(){
        $box=new \app\api\controller\ChatingBox();
        $project=new \app\api\controller\Project();
        $id=($project->getbasicproject('000'))['id'];
        $data=$box->read($id);
        if($data){
            $back=['data'=>$data,'status'=>1];
            return json($back);
        }else{
            return json(['status'=>0]);
        }
    }
}
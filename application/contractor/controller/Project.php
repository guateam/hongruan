<?php
namespace app\contractor\controller;
use think\Controller;
//use think\db;
class Project extends Controller
{
    public function index()
    {
        $project=new \app\api\controller\Project();
        $data=$project->getbasicprojectbyid('1');

        if($data){
            $this->assign('project',$data);
            $children=$project->getchildrenproject($data['id']);
            $tablist=[];
            $childlist=[];
            foreach ($children as $key => $value) {
                if($key==0){
                    $item=[
                        "tabtype"=>"home-tab",
                        'id'=>$value['id'],
                        'name'=>$value['name'],
                        'starttime'=>$value['starttime'],
                        'endtime'=>$value['endtime'],
                        'user'=>$value['user'],
                        'safetygrade'=>$value['safetygrade'],
                        'plan'=>$value['plan'],
                        'color'=>$value['color'],
                        'class'=>'active in'
                    ];
                    array_push($childlist,$item);
                    $item=["id"=>$value['id'],"name"=>$value['name'],'type'=>'home-tab','class'=>'active'];
                    array_push($tablist,$item);
                }else{
                    $item=[
                        "tabtype"=>"profile-tab",
                        'id'=>$value['id'],
                        'name'=>$value['name'],
                        'starttime'=>$value['starttime'],
                        'endtime'=>$value['endtime'],
                        'user'=>$value['user'],
                        'safetygrade'=>$value['safetygrade'],
                        'plan'=>$value['plan'],
                        'color'=>$value['color'],
                        'class'=>''
                    ];
                    array_push($childlist,$item);
                    $item=["id"=>$value['id'],"name"=>$value['name'],'type'=>'profile-tab','class'=>''];
                    array_push($tablist,$item);
                }
               
            }
            $this->assign('tablist',$tablist);
            $this->assign('childlist',$childlist);
        }else{
            $this->error('不存在的项目');
        }
        return $this->fetch('project');
    }
    
}
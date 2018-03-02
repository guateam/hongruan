<?php
namespace app\api\controller;
use think\Controller;
use app\api\model\Project as ProjectModel;
use app\api\model\Users;
use app\api\model\Resource;

class Project extends Controller{
    public function getbasicproject($userid){//已过期，不建议使用
        $project=ProjectModel::get(['UserId'=>$userid]);
        if($project){
            switch ($project->SafetyGrade) {
                case '高':
                    $color='high';
                    break;
                case '中':
                    $color='mid';
                    break;
                case '低':
                    $color='low';
                    break;
                default:
                    $color='';
                    break;
            }

            $data=[
                'id'=>$project->ID,
                'name'=>$project->ProjectName,
                'starttime'=>$project->ProjectStarttime,
                'endtime'=>$project->ProjectEndtime,
                'contractor'=>$project->Contractor,
                'safetygrade'=>$project->SafetyGrade,
                'plan'=>$project->Plan,
                'color'=>$color
            ];
            return $data;
        }else{
            return 0;
        }
    }

    public function getprojectstructuretree($projectid){//获取项目的树形结构图
        $style=[[],['color'=> '#F54F4A'],['color'=>'#FCCE10'],['color'=>'#B5C334']];
        $project=ProjectModel::get(['ID'=>$projectid]);
        if($project){
            switch ($project->SafetyGrade) {
                case '高':
                    $color=1;
                    break;
                case '中':
                    $color=2;
                    break;
                case '低':
                    $color=3;
                    break;
                default:
                    $color=0;
                    break;
            }
            
            $children=[];
            $list=[];
            $value=1;
            if($project->Children){
                $list=json_decode($project->Children);
                foreach($list as $item){
                    $child=$this->getprojectstructuretree($item);
                    array_push($children,$child);
                    $value=$value+$child['value'];
                }
            }
            if($color!=0){
                    $data=[
                        'name'=>$project->ProjectName,
                        'itemStyle'=>$style[$color],
                        'value'=>$value,
                        'children'=>$children
                    ];
                return $data;
            }else{
                $data=[
                    'name'=>$project->ProjectName,
                    'itemStyle'=>$style[$color],
                    'value'=>$value,
                    'children'=>$children
                ];
                return $data;
            }
        }
    }

    public function getprojectwaterfall($projectid){//获取项目的流水瀑布图
        $project=ProjectModel::get(['ID'=>$projectid]);
        if($project){
            $list=$this->getlist($project);
            $data=[];
            foreach ($list as $value) {
                $time1=strtotime('20'.date('y-m-d').'0:00');
                $time2=strtotime('20'.date('y-m-d').'23:59');
                $starttime=strtotime($value->ProjectStarttime);
                $endtime=strtotime($value->ProjectEndtime);
                if(($starttime>$time1) and ($endtime<$time2)){
                    $item=[
                        'name'=>$value->ProjectName,
                        'starttime'=>$value->ProjectStarttime,
                        'endtime'=>$value->ProjectEndtime,
                        'status'=>$value->State
                    ];
                    array_push($data,$item);
                }
            }
            return $data;
        }
    }

    public function getprojectwatinglist($projectid){//获取项目等待列表
        $project=ProjectModel::get(['ID'=>$projectid]);
        if($project){
            $list=$this->getlist($project);
            $data=[];
            $error=[];
            $warning=[];
            $success=[];
            $complete=[];
            foreach ($list as $value) {
                $idlist=explode(',',$value->UserID);
                foreach($idlist as $value1){
                    if($value1){
                        $username=(Users::get(['UserID'=>$value1])->UserName).'、';
                    }
                }
                $item=[
                    'name'=>$value->ProjectName,
                    'user'=>$username,
                    'endtime'=>$value->ProjectEndtime,
                    'status'=>$value->State,
                    'level'=>$value->SafetyGrade
                ];
                switch ($item['status']) {
                    case '延期':
                        array_push($error,$item);
                        break;
                    case '可能延期':
                        array_push($warning,$item);
                        break;
                    case '正点':
                        array_push($success,$item);
                        break;
                    default:
                        array_push($complete,$item);
                        break;
                }
                
            }
            $data=array_merge($error,$warning,$success,$complete);
            return $data;
        }
    }
    public function getprojectresource($projectid,$userid){//获取项目下资源列表
        $project=ProjectModel::get(['ID'=>$projectid]);
        if($project){
            $list=$this->getlist($project);
            $data=[];
            $idlist=[];
            foreach ($list as $value) {
                $id=json_decode($value->Resources);
                foreach ($id as $value) {
                    array_push($idlist,$value);
                }
                
            }
            $user=Users::get(['UserID'=>$userid])->SecurityPermissions;
            foreach ($idlist as $value) {
                $resource=Resource::get(['id'=>$value]);
                $item=[];
                if($resource->SafetyGrade<$user){
                    $item=[
                        'name'=>$resource->Name,
                        'uploader'=>$resource->Founder,
                        'uploadtime'=>$resource->CreationDate,
                        'status'=>'可用',
                        'safetygrade'=>$resource->SafetyGrade,
                        'link'=>$resource->LocalAddress,
                        'type'=>$resource->Type
                    ];
                }else{
                    $item=[
                        'name'=>$resource->Name,
                        'uploader'=>$resource->Founder,
                        'uploadtime'=>$resource->CreationDate,
                        'status'=>'不可用',
                        'safetygrade'=>$resource->SafetyGrade,
                        'type'=>$resource->Type
                    ];
                }
                array_push($data,$item);
            }
            return $data;
        }
    }
    private function getlist($project){//内部方法，获取所有子项目的id
        if($project->Children){
            $list=json_decode($project->Children);
            $data=[$project];
            foreach ($list as $value) {
                $item=ProjectModel::get(['ID'=>$value]);
                $child=$this->getlist($item);
                $data=array_merge($data,$child);
            }
            return $data;
        }else{
            return [$project];
        }
    }
    public function getbasicprojectbyid($id){//通过id获取project基础资料
        $project=ProjectModel::get(['ID'=>$id]);
        if($project){
            switch ($project->SafetyGrade) {
                case '高':
                    $color='high';
                    break;
                case '中':
                    $color='mid';
                    break;
                case '低':
                    $color='low';
                    break;
                default:
                    $color='';
                    break;
            }

            $idlist=explode(',',$project->UserID);
            foreach($idlist as $value){
                if($value){
                    $username=(Users::get(['UserID'=>$value])->UserName).'、';
                }
            } 
            $data=[
                'id'=>$project->ID,
                'name'=>$project->ProjectName,
                'starttime'=>$project->ProjectStarttime,
                'endtime'=>$project->ProjectEndtime,
                'user'=>$username,
                'safetygrade'=>$project->SafetyGrade,
                'plan'=>$project->Plan,
                'color'=>$color,
                'contractor'=>$project->Contractor,
            ];
            return $data;
        }else{
            return 0;
        }
    }
    public function getchildrenproject($projectid){//获取所有子项目
        $data=[];
        $project=ProjectModel::get(['ID'=>$projectid]);
        if($project){
            if($project->Children){
                $list=json_decode($project->Children);
                foreach($list as $item){
                    $child=$this->getbasicprojectbyid($item);
                    if($child!=0){
                        array_push($data,$child);
                    }
                }
                return $data;
            }

        }
    }

    

    public function getprojectpan(){//获取所有项目延期情况
        $ontime = ProjectModel::all(['State'=>'正点']);
        $dely0=ProjectModel::all(['State'=>'可能延期']);
        $dely=ProjectModel::all(['State'=>'延期']);
        $other=ProjectModel::all(['State'=>'其他']);
        $data=['series'=>["data"=>[["value"=>count($ontime),'name'=>'正点'],["value"=>count($dely0),'name'=>'可能延期'],["value"=>count($dely),'name'=>'延期'],["value"=>count($other),'name'=>'其他']]]];
        return $data;
    }
    
    public function gethistoryproject(){//获取所有历史项目
        $list=ProjectModel::all(["state"=>"完成","class"=>'root']);
        $data=[];
        foreach ($list as $value) {
            $link="jumphistory(".$value->ID.")";
            $item=[
                "name"=>$value->ProjectName,
                "endtime"=>$value->ProjectEndtime,
                "img"=>"http://localhost/tp5/public/static/image/4.jpg",
                "link"=>$link
            ];
            array_push($data,$item);
        }
        return $data;
    }
    
    public function gethistoryprojectbyuserid($userid){//获取指定userid的历史项目
        $list=$this->getprojectbyuserid($userid);
        $data=[];
        foreach ($list as $value) {
            if($value['State']=='完成' and $value['Class']=='root'){
                $link="jumphistory(".$value['ID'].")";
                $item=[
                    "name"=>$value['ProjectName'],
                    "endtime"=>$value['ProjectEndtime'],
                    "img"=>"http://localhost/tp5/public/static/image/4.jpg",
                    "link"=>$link
                ];
                array_push($data,$item);
            }
        }
        return $data;
    }

    public function getwaitinguserproject(){//获取等待人员分配的project
        $list=ProjectModel::all(["state"=>"等待人员"]);
        $data=[];
        foreach ($list as $value) {
            $link="jumpaddproject(".$value->ID.")";
            $item=[
                "name"=>$value->ProjectName,
                "endtime"=>$value->ProjectEndtime,
                "img"=>"http://localhost/tp5/public/static/image/4.jpg",
                "link"=>$link
            ];
            array_push($data,$item);
        }
        return $data;
    }
    public function getworkingproject(){//获取正在进行中的project
        $list3=ProjectModel::all(["state"=>"正点"]);
        $list2=ProjectModel::all(["state"=>"可能延期"]);
        $list1=ProjectModel::all(["state"=>"延期"]);
        $data=[];
        $list=array_merge($list1,$list2,$list3);
        foreach ($list as $value) {
            $link="jumpaddproject(".$value->ID.")";
            $item=[
                "name"=>$value->ProjectName,
                "endtime"=>$value->ProjectEndtime,
                "img"=>"http://localhost/tp5/public/static/image/4.jpg",
                "link"=>$link
            ];
            array_push($data,$item);
        }
        return $data;
    }
    
    public function getwaitingresourceproject(){//获取等待资源分配的project
        $list=ProjectModel::all(["state"=>"等待资源"]);
        $data=[];
        foreach ($list as $value) {
            $link="jumpaddproject(".$value->ID.")";
            $item=[
                "name"=>$value->ProjectName,
                "endtime"=>$value->ProjectEndtime,
                "img"=>"http://localhost/tp5/public/static/image/4.jpg",
                "link"=>$link
            ];
            array_push($data,$item);
        }
        return $data;
    }

    public function getprojectbyuserid($id){//获取含有此userid的所有项目
        $data=\think\Db::query("select * from project where UserID like '%,".$id.",%'");
        return $data;
    }
    
    public function getuserwaitingprojectbyuserid($userid){//获取等待接包人员确认接收的项目
        $list=$this->getprojectbyuserid($userid);
        $data=[];
        foreach ($list as $value) {
            if($value['State']=='代接收'){
                $link="jumpprojectdetail(".$value['ID'].")";
                $item=[
                    "name"=>$value['ProjectName'],
                    "endtime"=>$value['ProjectEndtime'],
                    "img"=>"http://localhost/tp5/public/static/image/4.jpg",
                    "link"=>$link
                ];
                array_push($data,$item);
            }
        }
        return $data;
    }

    public function getuserworkingprojectbyuserid($userid){//获取含此userid的正在进行的项目
        $list=$this->getprojectbyuserid($userid);
        $list1=[];
        $list2=[];
        $list3=[];
        $data=[];
        foreach ($list as $value) {
            $link="jumpprojectdetail(".$value['ID'].")";
            $item=[
                "name"=>$value['ProjectName'],
                "endtime"=>$value['ProjectEndtime'],
                "img"=>"http://localhost/tp5/public/static/image/4.jpg",
                "link"=>$link
            ];
            if($value['State']=='正点'){
                array_push($list3,$item);
            }elseif($value['State']=='可能延期'){
                array_push($list2,$item);
            }elseif($value['State']=='延期'){
                array_push($list1,$item);
            }
        }
        $data=array_merge($list1,$list2,$list3);
        return $data;
    }

    public function setprojectuserid($id,$idlist){//设置此id的project人员id
        $data=',';
        foreach ($idlist as $value) {
            $data=$data.$value.',';
        }
        $project=ProjectModel::get(["ID"=>$id]);
        $project->UserID=$data;
        $project->save();
    }

    public function addnewproject($contractor,$starttime,$endttime,$safetygrade,$projectname,$class,$plan){//添加新project
        $project=new ProjectModel();
        $project->data([
            "Contractor"=>$contractor,
            "Starttime"=>$starttime,
            "Endtime"=>$endttime,
            "SafetyGrade"=>$safetygrade,
            "ProjectName"=>$projectname,
            "Class"=>$class,
            "Plan"=>$plan
        ]);
        $project->save();
    }
    
    public function setprojectresourceid($id,$resourceidlist){//设置resourceid
        $project=ProjectModel::get(["ID"=>$id]);
        $project->Resources=json($resourceidlist);
        $project->save();
    }
}
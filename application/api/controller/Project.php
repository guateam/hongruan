<?php
namespace app\api\controller;
use think\Controller;
use app\api\model\Project as ProjectModel;
use app\api\model\Users;
use app\api\model\Resource;

class Project extends Controller{
    public function getbasicproject($userid){
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
    public function getprojectstructuretree($projectid){
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

    public function getprojectwaterfall($projectid){
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
    public function getprojectwatinglist($projectid){
        $project=ProjectModel::get(['ID'=>$projectid]);
        if($project){
            $list=$this->getlist($project);
            $data=[];
            $error=[];
            $warning=[];
            $success=[];
            $complete=[];
            foreach ($list as $value) {
                $item=[
                    'name'=>$value->ProjectName,
                    'user'=>$value->UserID,
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
    public function getprojectresource($projectid,$userid){
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
    private function getlist($project){
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
}
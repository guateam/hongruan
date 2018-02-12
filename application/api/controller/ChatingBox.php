<?php
namespace app\api\controller;
use think\Controller;
use app\api\model\ChatingBox as ChatingBoxModel;

class ChatingBox extends Controller{
    public function read($projectid){
        $list=ChatingBoxModel::all(['Project'=>$projectid]);
        $data=[];
        foreach ($list as $value) {
            $item=[
                'user'=>$value->User,
                'status'=>$value->State,
                'time'=>$value->Time,
                'note'=>$value->Note
            ];
            array_push($data,$item);
        }
        return $data;
    }
    public function send($user,$status,$time,$note,$projectid){
        $data=new ChatingBoxModel;
        $user->data([
            'User'  =>$user,
            'State' =>$status,
            'Time'=>$time,
            'Note'=>$note,
            'Project'=>$projectid
        ]);
        $user->save();
    }
}
<?php
namespace app\api\controller;
use think\Controller;
use app\api\model\Administractors as UserModel;

class Administractors extends Controller{
    /**
     * 注册方法
     */
    public function register(){
        $data=new UserModel($_POST);
        try{
            $data->allowField(true)->save();
            return json(['status'=>1]);
        }catch(Exception $e){
            return json(['status'=>0]);
        }
    }
    /**
     * 登陆方法
     */
    public function login(){
        $data=UserModel::get($_POST['UserName']);//从数据库调取此用户信息
        if($data){//判断是否有此用户名，感觉没必要告诉用户数据库是否为空，而且不知道model的空数据怎么检测所以不管了~
            if($data->Password!=$_POST['Password']){
                return json(['status'=>0]);
            }else{
                /**
                 * 这里如果是图片的话应该要转存一下吧
                 */
                if($_FILES['FaceInform']['error']>0){
                    return json(['status'=>-1]);
                }else{
                    if(move_uploaded_file($_FILES["file"]["tmp_name"],"upload/" . $_FILES["file"]["name"])){
                        $uploadFile="upload/" . $_FILES["file"]["name"];
                    }else{
                        return json(['status'=>-1]);
                    }
                }
                if(exec('FaceCompare.exe '.$data->FaceInformation.' '.$uploadFile)==0){
                    return json(['status'=>-1]);//调用红软的sdk并比对数据，感觉传回来的应该是个图片，这里调用exe文件 第一个是数据库中的文件 第二个是传输过来的文件
                }else{
                    return json(['status'=>1]);
                }
            }
        }else{
            return json(['status'=>-2]);
        }
    }
    /**
     * 修改用户信息
     */
    public function change(){
        $user = new UserModel();
        try{
            $user->allowField(true)->save($_POST,['UserName' => $_POST['UserName']]);
            return json(['status'=>1]);
        }catch(Exception $e){
            return json(['status'=>0]);
        }
    }
}
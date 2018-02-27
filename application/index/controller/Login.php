<?php
namespace app\index\controller;
use think\Controller;
//use think\db;
use api\controller\User;
class Login extends Controller
{
    public function index()
    {
        
        return $this->fetch('login');
    }
}
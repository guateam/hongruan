<?php
namespace app\index\controller;
use think\Controller;
//use think\db;
class Login extends Controller
{
    public function index()
    {
        return $this->fetch('login');
    }
}
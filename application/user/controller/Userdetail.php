<?php
namespace app\user\controller;
use think\Controller;
//use think\db;
class Userdetail extends Controller
{
    public function index(){
        return $this->fetch('userdetail');
    }
}
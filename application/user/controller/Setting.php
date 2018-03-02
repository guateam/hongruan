<?php
namespace app\user\controller;
use think\Controller;
//use think\db;
class Setting extends Controller
{
    public function index(){
        return $this->fetch('setting');
    }
}
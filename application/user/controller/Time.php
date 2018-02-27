<?php
namespace app\user\controller;
use think\Controller;
//use think\db;
class Time extends Controller
{
    public function index(){
        return $this->fetch('time');
    }
}
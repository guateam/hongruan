<?php
namespace app\user\controller;
use think\Controller;
//use think\db;
class History extends Controller
{
    public function index(){
        $this->fetch('history');
    }
}
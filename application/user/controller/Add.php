<?php
namespace app\user\controller;
use think\Controller;
//use think\db;
class Add extends Controller
{
    public function index(){
        $this->fetch('add');
    }
}
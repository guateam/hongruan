<?php
namespace app\user\controller;
use think\Controller;
//use think\db;
class Project extends Controller
{
    public function index(){
        $this->fetch('project');
    }
}
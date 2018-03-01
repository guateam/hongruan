<?php
namespace app\user\controller;
use think\Controller;
//use think\db;
class Incomedetail extends Controller
{
    public function index(){
        return $this->fetch('incomedetail');
    }
}
<?php
namespace app\user\controller;
use think\Controller;
//use think\db;
class Revise extends Controller
{
    public function index(){
        return $this->fetch('revise');
    }
}
<?php
namespace app\user\controller;
use think\Controller;
//use think\db;
class Send extends Controller
{
    public function index(){
        $this->fetch('send');
    }
}
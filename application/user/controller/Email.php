<?php
namespace app\user\controller;
use think\Controller;
//use think\db;
class Email extends Controller
{
    public function index(){
        $this->fetch('email');
    }
}
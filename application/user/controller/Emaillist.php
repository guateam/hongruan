<?php
namespace app\user\controller;
use think\Controller;
//use think\db;
class Emaillist extends Controller
{
    public function index(){
        return $this->fetch('email-list');
    }
}
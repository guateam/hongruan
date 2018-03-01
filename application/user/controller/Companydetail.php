<?php
namespace app\user\controller;
use think\Controller;
//use think\db;
class Companydetail extends Controller
{
    public function index(){
        return $this->fetch('companydetail');
    }
}
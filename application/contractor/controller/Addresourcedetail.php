<?php
namespace app\contractor\controller;
use think\Controller;
//use think\db;
class Addresourcedetail extends Controller
{
    public function index()
    {
        
        return $this->fetch('addresourcedetail');
    }
}

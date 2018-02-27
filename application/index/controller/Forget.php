<?php
namespace app\index\controller;
use think\Controller;
//use think\db;
class Forget extends Controller
{
    public function index()
    {
        return $this->fetch('forget');
    }
}
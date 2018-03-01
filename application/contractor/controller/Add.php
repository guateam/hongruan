<?php
namespace app\contractor\controller;
use think\Controller;
//use think\db;
class Add extends Controller
{
    public function index()
    {
        return $this->fetch('add');
    }
}

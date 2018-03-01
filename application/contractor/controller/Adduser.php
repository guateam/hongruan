<?php
namespace app\contractor\controller;
use think\Controller;
//use think\db;
class Adduser extends Controller
{
    public function index()
    {
        return $this->fetch('adduser');
    }
}

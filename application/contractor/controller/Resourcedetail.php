<?php
namespace app\contractor\controller;
use think\Controller;
//use think\db;
class Resourcedetail extends Controller
{
    public function index()
    {
        return $this->fetch('resourcedetail');
    }
}

<?php
namespace app\contractor\controller;
use think\Controller;
//use think\db;
class Resourcecontrol extends Controller
{
    public function index()
    {
        return $this->fetch('resourcecontrol');
    }
}

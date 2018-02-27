<?php
namespace app\index\controller;
use think\Controller;
//use think\db;
class Register extends Controller
{
    public function index()
    {
        return $this->fetch('register');
    }
}
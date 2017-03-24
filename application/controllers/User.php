<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        //检测用户是否存在
        $this->model->load('UserModel');
        $userInfo = $this->UserModel->getUserInfo($username);
        if($userInfo) {
            if($userInfo)
        }
        echo 'Error';exit;
    }

    public function logout()
    {}

    //密码加密校验
    public function passwdEncryt(string $password = '', string $salt = '', string $compairPassword = '')
    {
        $passwdMd5 = md5(md5($password).$salt);
        if($compairPassword) {
            if($passwdMd5 === $compairPassword) {
                return true;
            }
            return false;
        }
        return $passwdMd5;
    }
}
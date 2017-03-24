<?php
class UserModel extends CI_Model
{
    private $table = 'user';

    public function __construct()
    {
        parent::__construct();
    }

    public function getUserInfo(string $username = '', int $uid = 0)
    {
        if($username) {
            $where = "uname ='$username'";
        }

        if($uid) {
            $where = 'uid = '. $uid;
        }

        $info = $this->db->select('uid,uname,password')
                         ->where($where)
                         ->get($this->table)
                         ->result_array();
        return $info;
    }
}
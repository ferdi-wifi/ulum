<?php
class Login_model extends CI_Model{
    
    public function insert($data){
        $this->db->insert('tb_santri', $data);
    }
    public function cek($reg, $password){
        $sql = $this->db->query("SELECT * FROM tb_santri WHERE no_reg = '$reg' AND kata_sandi = '$password' ");
        return $sql;
    }
}
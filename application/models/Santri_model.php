<?php

class Santri_model extends CI_Model{
    public function tambah($data){
        $this->db->insert('tb_santri', $data);
    }
    public function update_foto($data, $id){
        $this->db->where('no_reg', $id)->update('tb_santri', $data);
    }
    public function upload_berkas($data){
        $this->db->insert('tb_gambar', $data);
    }
    public function upload_bayar($data){
        $this->db->insert('tb_bayar', $data);
    }
    public function get_reg(){
        $q = $this->db->query("SELECT MAX(RIGHT(no_reg,4)) AS kd_max FROM tb_santri");
        $kd = "";  
        if($q->num_rows()>0){ 
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        
        return "N-P".$kd;
    }
    public function edit_berkas($data, $id){
        $this->db->where('id_gambar', $id)
                    ->update('tb_gambar', $data);
    }
    public function edit_bayar($data, $id){
        $this->db->where('id_bayar', $id)
                    ->update('tb_bayar', $data);
    }
    public function read_profil($id){
        return $this->db->query("SELECT * FROM tb_santri WHERE no_reg = '$id' ");
    }
    public function read_ayah($id, $ayah){
        $query= $this->db->select('*')
                    ->from('tb_wali')
                    ->where('id_santri',$id)
                    ->where('status_wali',$ayah)
                    ->order_by('id_wali','DESC')
                    ->get();
    return $query;
      
        // return $this->db->get_where('tb_wali', array('id_santri' => $id, 'status_wali'=>$ayah))->row();
    }
    public function read_ibu($id, $ibu){
    $query= $this->db->select('*')
                    ->from('tb_wali')
                    ->where('id_santri', $id)
                    ->where('status_wali', $ibu)
                    ->order_by('id_wali','DESC')
                    ->get();
    return $query;

       // return $this->db->get_where('tb_wali', array('id_santri' => $id, 'status_wali'=>$ibu));
    }
    public function update_email($data, $id){
        $this->db->where('no_reg', $id)
                    ->update('tb_santri', $data);
    }
    public function hapus($id){
        $this->db->where('id_gambar', $id)
                    ->delete('tb_gambar');
    }
    public function masuk_wali($data){
        $this->db->insert('tb_wali', $data);
    }
    public function hapus_wali($id){
        $this->db->where('id_wali', $id)
                    ->delete('tb_wali');
    }
    public function update_s($data, $id){
        $this->db->where('no_reg', $id)
                    ->update('tb_santri', $data);
    }

    // untuk login admin
    public function cek_user($user, $pass){
        return $this->db->query("SELECT * FROM users WHERE username = '$user' && password = '$pass' ");
    }
    public function jumlah_santri(){
        return $this->db->get('tb_santri');
    }
    public function perempuan(){
        return $this->db->query("SELECT * FROM tb_santri WHERE jenis_kelamin='perempuan' ");
    }
    public function laki(){
        return $this->db->query("SELECT * FROM tb_santri WHERE jenis_kelamin='laki-laki' ");
    }
    

    // untuk santri
    public function get_san(){
        return $this->db->query("SELECT * FROM tb_santri ORDER BY no_reg ASC");
    }
    public function delete_santri($id){
        $this->db->where('no_reg', $id)
                    ->delete('tb_santri');
    }
    public function get_sanid($id){
        return $this->db->query("SELECT * FROM tb_santri WHERE no_reg = '$id' ");
    }
    public function update_san($data, $id){
        $this->db->where('no_reg', $id)
                    ->update('tb_santri', $data);
    }

    // untuk berkas
    public function get_berkas($id){
        return $this->db->query("SELECT * FROM tb_gambar WHERE id_santri = '$id' ");
    }
    // wali
    public function get_wali($id){
        return $this->db->query("SELECT * FROM tb_wali WHERE id_santri = '$id' ");
    }
    public function insert_wali($data){
        $this->db->insert('tb_wali', $data);
    }
    public function update_wali($data, $id){
        $this->db->where('id_wali', $id)
                    ->update('tb_wali', $data);
    }
    public function read_users(){
        return $this->db->get('users');
    }
    // users

    public function read_bayar(){
        return $this->db->get('tb_bayar');
    }
    public function update_users($data, $id){
        $this->db->where('id_users', $id)
                    ->update('users', $data);
    }
    public function update_bayar($data, $id){
        $this->db->where('id_bayar', $id)
                    ->update('tb_bayar', $data);
    }
    public function insert_users($data){
        $this->db->insert('users', $data);
    }
    public function delete_users($id){
        $this->db->where('id_users', $id)
                    ->delete('users');
    }
    public function delete_bayar($id){
        $this->db->where('id_bayar', $id)
                    ->delete('tb_bayar');
    }
    //Lapoaran
    public function santri(){
        $query= $this->db->select('*')
                    ->from('tb_santri')
                    ->order_by('no_reg','ASC')
                    ->get()->result();
        return $query;
    }
    public function provinsi($id){
        return $this->db->get_where('wilayah_provinsi', array('id'=>$id))->row();
    }
    public function kabupaten($id){
        return $this->db->get_where('wilayah_kabupaten', array('id'=>$id))->row();
    }
    public function kecamatan($id){
        return $this->db->get_where('wilayah_kecamatan', array('id'=>$id))->row();
    }
    public function desa($id){
        return $this->db->get_where('wilayah_desa', array('id'=>$id))->row();
    }
    public function salaf($nama){
        $query= $this->db->select('*')
                    ->from('tb_santri')
                    ->where('status_pendidikan',$nama)
                    ->order_by('no_reg','ASC')
                    ->get()->result();
        return $query;
    }
    public function formal($nama){
        $query= $this->db->select('*')
                    ->from('tb_santri')
                    ->where('lembaga_pendidikan',$nama)
                    ->order_by('no_reg','ASC')
                    ->get()->result();
        return $query;
    }
    
}
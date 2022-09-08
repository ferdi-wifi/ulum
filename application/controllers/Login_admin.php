<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_admin extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('santri_model');
        
    }
    public function index(){
        $this->load->view('admin/login');
    }
    public function test(){
        $user =htmlspecialchars($this->input->post('username'));
        $pass =md5(htmlspecialchars($this->input->post('password')));
        $data = [
            'username'=>htmlspecialchars($this->input->post('username')),
            'password'=>htmlspecialchars($this->input->post('password'))
        ];
        $sql = $this->santri_model->cek_user($user, $pass)->num_rows();
        $users = $this->santri_model->cek_user($user, $pass)->row_array();
        if ($sql > 0){
            $this->session->set_userdata('nama', $users['nama']);
            $this->session->set_userdata('username', $users['username']);
            $this->session->set_userdata('password', $users['password']);
            $this->session->set_flashdata('succ', '<script>swal("Berhasil !", "Selamat Datang Di Control Panel !", "success")</script>');
            redirect('admin_control_panel');
        }else{
            $this->session->set_flashdata('gagal', '<script>swal("Gagal !", "Username atau password Salah !", "error")</script>');
            redirect('admin-control-panel-raudlatul-ulum');
        }
    }
    public function logout(){

        $this->session->sess_destroy();
        $this->session->set_flashdata('succ_log', '<script>swal("Berhasil !", "Berhasil Log out !", "success")</script>');
        redirect('admin-control-panel-raudlatul-ulum');
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('santri_model');
        $this->load->library('Pdf');
       
    }
    public function index(){
        $this->load->view('page/home');
    }
    
    public function daftar(){
        $data['no_reg']  = $this->santri_model->get_reg();
        $get_prov = $this->db->select('*')->from('wilayah_provinsi')->get();
        $data['provinsi'] = $get_prov->result();
        
   		$data['path'] = base_url('assets');   
        $this->load->view('page/daftar', $data);
        $this->load->view('page/footer');
    }
    public function cek_login(){
       
        $reg = htmlspecialchars($this->input->post('reg'));
        $password = htmlspecialchars($this->input->post('password'));

        $tabel = $this->login_model->cek($reg, $password)->num_rows();
        $tabel1 = $this->login_model->cek($reg, $password)->row_array();
        
        if($tabel > 0){
            
			$this->session->set_userdata('no_reg', $tabel1['no_reg']);
			$this->session->set_userdata('foto_diri', $tabel1['foto_diri']);
            $this->session->set_userdata('password', $tabel1['kata_sandi']);
            $this->session->set_userdata('nama_lengkap', $tabel1['nama_lengkap']);
            $this->session->set_flashdata('login', 'Selamat Datang !');
            redirect('profil');
        }else{
            $this->session->set_flashdata('login_gagal', '<script>swal("Login Gagal !", "Username atau Password salah.", "error")</script>');
            redirect(base_url());
        }
        
    }

    public function profil(){
       if($this->session->userdata('no_reg') != ''){
           $show = $this->session->userdata('no_reg');
           $sql = $this->db->query("SELECT * FROM tb_gambar WHERE id_santri = '$show' ");
           $data['berkas'] = $sql->result();
           $get_prov = $this->db->select('*')->from('wilayah_provinsi')->get();
           $data['provinsi'] = $get_prov->result();
           
           $data['path'] = base_url('assets');   
           $data['profil'] = $this->santri_model->read_profil($show)->row_array();
		   $this->load->view('page/profil', $data);
		   $this->load->view('page/footer');
	   }else{
		   $this->session->set_flashdata('login_dulu', '<script>swal("Silahkan Login Dulu !", "Masukan Username dan Password.", "error")</script>');
		   redirect('');
	   }
    }

    public function akun(){
        if($this->session->userdata('no_reg') != ''){
            $show = $this->session->userdata('no_reg');
            $sql = $this->db->query("SELECT * FROM tb_gambar WHERE id_santri = '$show' ");
            $data['berkas'] = $sql->result();
            $get_prov = $this->db->select('*')->from('wilayah_provinsi')->get();
            $data['provinsi'] = $get_prov->result();
            
            $data['path'] = base_url('assets');   
            $data['profil'] = $this->santri_model->read_profil($show)->row_array();
            $this->load->view('page/akun', $data);
            $this->load->view('page/footer');
        }else{
            $this->session->set_flashdata('login_dulu', '<script>swal("Silahkan Login Dulu !", "Masukan Username dan Password.", "error")</script>');
            redirect('');
        }
     }
     public function berkas(){
        if($this->session->userdata('no_reg') != ''){
            $show = $this->session->userdata('no_reg');
            $sql = $this->db->query("SELECT * FROM tb_gambar WHERE id_santri = '$show' ");
            $data['berkas'] = $sql->result();
            $get_prov = $this->db->select('*')->from('wilayah_provinsi')->get();
            $data['provinsi'] = $get_prov->result();
            
            $data['path'] = base_url('assets');   
            $data['profil'] = $this->santri_model->read_profil($show)->row_array();
            $this->load->view('page/berkas', $data);
            $this->load->view('page/footer');
        }else{
            $this->session->set_flashdata('login_dulu', '<script>swal("Silahkan Login Dulu !", "Masukan Username dan Password.", "error")</script>');
            redirect('');
        }
     }
     public function bayar(){
        if($this->session->userdata('no_reg') != ''){
            $show = $this->session->userdata('no_reg');
            $sql = $this->db->query("SELECT * FROM tb_bayar WHERE id_santri = '$show' ");
            $data['bayar'] = $sql->result();
            $get_prov = $this->db->select('*')->from('wilayah_provinsi')->get();
            $data['provinsi'] = $get_prov->result();
            
            $data['path'] = base_url('assets');   
            $data['profil'] = $this->santri_model->read_profil($show)->row_array();
            $this->load->view('page/bayar', $data);
            $this->load->view('page/footer');
        }else{
            $this->session->set_flashdata('login_dulu', '<script>swal("Silahkan Login Dulu !", "Masukan Username dan Password.", "error")</script>');
            redirect('');
        }
     }
     public function cetak(){
        if($this->session->userdata('no_reg') != ''){
            $show = $this->session->userdata('no_reg');
            $sql = $this->db->query("SELECT * FROM tb_gambar WHERE id_santri = '$show' ");
            $data['berkas'] = $sql->result();
            $get_prov = $this->db->select('*')->from('wilayah_provinsi')->get();
            $data['provinsi'] = $get_prov->result();
            $id = $this->session->userdata('no_reg');
            // $data['cetak'] =$this->santri_model->read_profil($id)->row_array();
            
            $data['path'] = base_url('assets');   
            $data['profil'] = $this->santri_model->read_profil($show)->row_array();
            $this->load->view('page/cetak', $data);
            $this->load->view('page/footer');
        }else{
            $this->session->set_flashdata('login_dulu', '<script>swal("Silahkan Login Dulu !", "Masukan Username dan Password.", "error")</script>');
            redirect('');
        }
     }
     public function cetakpdf(){
        if($this->session->userdata('no_reg') != ''){
            $show = $this->session->userdata('no_reg');
            $sql = $this->db->query("SELECT * FROM tb_gambar WHERE id_santri = '$show' ");
            $data['berkas'] = $sql->result();
            $get_prov = $this->db->select('*')->from('wilayah_provinsi')->get();
            $data['provinsi'] = $get_prov->result();
            
            $data['path'] = base_url('assets');   
            $data['profil'] = $this->santri_model->read_profil($show)->row_array();
            $this->load->view('page/cetak', $data);
            $this->load->view('page/footer');
        }else{
            $this->session->set_flashdata('login_dulu', '<script>swal("Silahkan Login Dulu !", "Masukan Username dan Password.", "error")</script>');
            redirect('');
        }
     }
     public function orangtua(){
        if($this->session->userdata('no_reg') != ''){
            $show = $this->session->userdata('no_reg');
            $sql = $this->db->query("SELECT * FROM tb_gambar WHERE id_santri = '$show' ");
            $data['berkas'] = $sql->result();
            $get_prov = $this->db->select('*')->from('wilayah_provinsi')->get();
            $data['provinsi'] = $get_prov->result();
            
            $data['path'] = base_url('assets');   
            $data['profil'] = $this->santri_model->read_profil($show)->row_array();
            $this->load->view('page/orangtua', $data);
            $this->load->view('page/footer');
        }else{
            $this->session->set_flashdata('login_dulu', '<script>swal("Silahkan Login Dulu !", "Masukan Username dan Password.", "error")</script>');
            redirect('');
        }
     }

    public function profil_masuk(){
        if($this->session->userdata('no_reg') != ''){
            $id = $this->session->userdata('no_reg');
            $data = [
                'nomer_kk'=>htmlspecialchars($this->input->post('kk')),
                'nik'=>htmlspecialchars($this->input->post('nik')),
                'nama_lengkap'=>htmlspecialchars($this->input->post('nama')),
                'jenis_kelamin'=>htmlspecialchars($this->input->post('gender')),
                'tempat_lahir'=>htmlspecialchars($this->input->post('tempat')),
                'tanggal_lahir'=>htmlspecialchars($this->input->post('tanggal')),
                'tinggal_bersama'=>htmlspecialchars($this->input->post('tinggal')),
                'pendidikan_terakhir'=>htmlspecialchars($this->input->post('pendidikan')),
               
                'alamat_detail'=>htmlspecialchars($this->input->post('alamat')),
                'kode_pos'=>htmlspecialchars($this->input->post('kodepos')),

                'mondok'=>htmlspecialchars($this->input->post('mondok')),
                'jenis_pendaftaran'=>htmlspecialchars($this->input->post('jenis')),
                'lembaga_pendidikan'=>htmlspecialchars($this->input->post('formal')),
                'status_pendidikan'=>htmlspecialchars($this->input->post('status')),
                'ukuran_seragam'=>htmlspecialchars($this->input->post('ukuran_seragam')),
            
            ];
            $this->santri_model->update_s($data, $id);
            $this->session->set_flashdata('insert', '<script>swal("Berhasil !", "Data Diperbarui !", "success")</script>');
		    redirect('profil');
        }else{
            $this->session->set_flashdata('login_dulu', '<script>swal("Silahkan Login Dulu !", "Masukan Username dan Password.", "error")</script>');
            redirect('');
        }
    }

    public function insert(){
        
            $data = [
                'no_reg'=>htmlspecialchars($this->input->post('no_reg')),
                'nomer_kk'=>htmlspecialchars($this->input->post('kk')),
                'nik'=>htmlspecialchars($this->input->post('nik')),
                'nama_lengkap'=>htmlspecialchars($this->input->post('nama')),
                'jenis_kelamin'=>htmlspecialchars($this->input->post('gender')),
                'tempat_lahir'=>htmlspecialchars($this->input->post('tempat')),
                'tanggal_lahir'=>htmlspecialchars($this->input->post('date')),
                'anak_ke'=>htmlspecialchars($this->input->post('anak')),
                'dari_saudara'=>htmlspecialchars($this->input->post('dari_anak')),

                'tinggal_bersama'=>htmlspecialchars($this->input->post('tinggal')),
                'pendidikan_terakhir'=>htmlspecialchars($this->input->post('pendidikan')),
                'provinsi'=>htmlspecialchars($this->input->post('prov')),
                'kabupaten'=>htmlspecialchars($this->input->post('kab')),
                'kecamatan'=>htmlspecialchars($this->input->post('kec')),
                'desa'=>htmlspecialchars($this->input->post('des')),
                'alamat_detail'=>htmlspecialchars($this->input->post('jalan')),
                'kode_pos'=>htmlspecialchars($this->input->post('pos')),

                'mondok'=>htmlspecialchars($this->input->post('mondok')),
                'jenis_pendaftaran'=>htmlspecialchars($this->input->post('jenis_pendaftaran')),
                'lembaga_pendidikan'=>htmlspecialchars($this->input->post('lembaga')),
                'status_pendidikan'=>htmlspecialchars($this->input->post('status')),
                'ukuran_seragam'=>htmlspecialchars($this->input->post('ukuran_seragam')),
                'email'=>htmlspecialchars($this->input->post('email')),
                'no_telp'=>htmlspecialchars($this->input->post('telp')),
                'kata_sandi'=>htmlspecialchars($this->input->post('sandi')),
                'kata_sandi_ulang'=>htmlspecialchars($this->input->post('ulang_sandi')),
            ];
            $this->santri_model->tambah($data);
            $this->session->set_flashdata('berhasil', '<b>Pendaftaran Sukses !</b>');
            $this->session->set_userdata('show', 'sudah_daftar');
            redirect('berhasil');


      
        
        
       
        
    }
    public function berhasil(){
		if($this->session->userdata('show') != ''){
			$this->load->view('page/berhasil');
		}else{
			$this->session->set_flashdata('daftar_dulu', '<script>swal("Silahkan Daftar Dulu !", "Lengkapi Formulir Pendaftaran.", "error")</script>');
			redirect('daftar');
		}
        
    }
    public function logout(){
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout', 'Berhasil Logout !');
        redirect('');
	}
	public function upload_foto(){
        if($this->session->userdata('no_reg') != ''){

            if( $this->input->post('kolo_ada') != '' ){
            
                $config['upload_path'] = './upload/user/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['encrypt_name'] = TRUE;
                $config['min_width'] = '800';
                $config['min_height'] = '800';
                $this->upload->initialize($config);

                $id = htmlspecialchars($this->input->post('id'));
                $sql = $this->db->query("SELECT * FROM tb_santri WHERE no_reg = '$id' ")->row_array();

                unlink("./upload/user/".$sql['foto_diri']);

                if($this->upload->do_upload('diri_sendiri')){
                    $nama = $this->upload->data();
                    $data = ['foto_diri'=>$nama['file_name']];
                    $this->santri_model->update_foto($data, $id);
                    $this->session->set_flashdata('gambar_berhasil', '<script>swal("Berhasil !", "Upload Foto Berhasil.", "success")</script>');
                    redirect('profil');
                }else{
                    $this->session->set_flashdata('error_gambar', '<script>swal("Gagal !", "Gambar harus berformat gif/jgp/png atau jpeg. Dan minimal ukuran gambar adalah 800 X 800", "error")</script>');
                    redirect('profil');
                }
            }else{
            
                $config['upload_path'] = './upload/user/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['encrypt_name'] = TRUE;
                $config['min_width'] = '800';
                $config['min_height'] = '800';
                $this->upload->initialize($config);

                $id = htmlspecialchars($this->input->post('id'));
                if($this->upload->do_upload('diri_sendiri')){
                    $nama = $this->upload->data();
                    $data = ['foto_diri'=>$nama['file_name']];
                    $this->santri_model->update_foto($data, $id);
                    $this->session->set_flashdata('gambar_berhasil', '<script>swal("Berhasil !", "Upload Foto Berhasil.", "success")</script>');
                    redirect('profil');
                }else{
                    $this->session->set_flashdata('error_gambar', '<script>swal("Gagal !", "Gambar harus berformat gif/jgp/png atau jpeg. Dan minimal ukuran gambar adalah 800 X 800", "error")</script>');
                    redirect('profil');
                }

            }
        
         }else{
            $this->session->set_flashdata('login_dulu', '<script>swal("Silahkan Login Dulu !", "Masukan Username dan Password.", "error")</script>');
		    redirect('');
        }
		
		

    }
    
    public function simpan_wali(){
        if($this->session->userdata('no_reg') != ''){
            $data = [
                'id_santri'=>$this->session->userdata('no_reg'),
                'nama'=>htmlspecialchars($this->input->post('nama')),
                'jenis_kelamin'=>htmlspecialchars($this->input->post('jenis_kelamin')),
                'tempat_lahir'=>htmlspecialchars($this->input->post('tempat')),
                'pendidikan_terakhir'=>htmlspecialchars($this->input->post('pendidikan')),
                'no_tel'=>htmlspecialchars($this->input->post('no')),
                'pekerjaan'=>htmlspecialchars($this->input->post('kerja')),
                'penghasilan'=>htmlspecialchars($this->input->post('hasil')),
                'status_wali'=>htmlspecialchars($this->input->post('status')),
                'agama'=>htmlspecialchars($this->input->post('agama')),
            ];

            $this->santri_model->masuk_wali($data);
            $this->session->set_flashdata('berhasil', '<script>swal("Sukses !", "Data Wali Telah masuk.", "success")</script>');
            redirect('orangtua');
        }else{
            $this->session->set_flashdata('login_dulu', '<script>swal("Silahkan Login Dulu !", "Masukan Username dan Password.", "error")</script>');
		    redirect('orangtua');
        }
    }
    public function hapus_wali($id){
        $this->santri_model->hapus_wali($id);
        $this->session->set_flashdata('berhasil', '<script>swal("Sukses !", "Wali Berhasil Dihapus !.", "success")</script>');
        redirect('orangtua');
    }
    public function upload_bayar(){
        if($this->session->userdata('no_reg') != ''){
           
            $config=[
                'upload_path'=>'./upload/bayar/',
                'allowed_types'=>'gif|jpg|png|jpeg',
                'file_name'=>$nama_file,
                'min_width'=>'700',
                'min_height'=>'700'];
           
            $this->upload->initialize($config);

            //

            $id = htmlspecialchars($this->input->post('no_reg'));
            if($this->upload->do_upload('bayar')){
                $nama = $this->upload->data();
                $gambar=$nama['file_name'];
                $data = [
                    'id_santri'=>$id,
                    'bukti_bayar'=>$gambar,
                    'status'=> 'Proses',
                ];
                $this->santri_model->upload_bayar($data);
                $this->session->set_flashdata('bayar_berhasil', '<script>swal("Berhasil !", "Upload Pembayaran Berhasil.", "success")</script>');
                redirect('bayar');
            }else{
                $this->session->set_flashdata('error_bayar', '<script>swal("Gagal !", "Gambar harus berformat gif/jgp/png atau jpeg. Dan minimal ukuran gambar adalah 800 X 800", "error")</script>');
                redirect('bayar');
            }
        }else{
            $this->session->set_flashdata('login_dulu', '<script>swal("Silahkan Login Dulu !", "Masukan Username dan Password.", "error")</script>');
		    redirect('');
        }
    }
    public function upload_berkas(){
        if($this->session->userdata('no_reg') != ''){
           
            // $config['upload_path'] = './upload/berkas/';
            // $config['allowed_types'] = 'gif|jpg|png|jpeg';
            // $config['encrypt_name'] = TRUE;
            // $config['min_width'] = '800';
            // $config['min_height'] = '800';
            // $this->upload->initialize($config);

            //
            $nama_file=htmlspecialchars($this->input->post('jenis')).$this->session->userdata('no_reg').'_'.time();
            $config=[
                'upload_path'=>'./upload/berkas/',
                'allowed_types'=>'gif|jpg|png|jpeg',
                'file_name'=>$nama_file,
                'min_width'=>'800',
                'min_height'=>'800'];
           
            $this->upload->initialize($config);

            //

            $id = htmlspecialchars($this->input->post('no_reg'));
            if($this->upload->do_upload('berkas')){
                $nama = $this->upload->data();
                $gambar=$nama['file_name'];
                $data = [
                    'id_santri'=>$id,
                    'url_gambar'=>$gambar,
                    'jenis_berkas'=> htmlspecialchars($this->input->post('jenis')),
                    'ket'=>htmlspecialchars($this->input->post('ket'))
                ];
                $this->santri_model->upload_berkas($data);
                $this->session->set_flashdata('berkas_berhasil', '<script>swal("Berhasil !", "Upload Bekas Berhasil.", "success")</script>');
                redirect('berkas');
            }else{
                $this->session->set_flashdata('error_berkas', '<script>swal("Gagal !", "Gambar harus berformat gif/jgp/png atau jpeg. Dan minimal ukuran gambar adalah 800 X 800", "error")</script>');
                redirect('berkas');
            }
        }else{
            $this->session->set_flashdata('login_dulu', '<script>swal("Silahkan Login Dulu !", "Masukan Username dan Password.", "error")</script>');
		    redirect('');
        }
    }
    public function edit_berkas(){
        if($this->session->userdata('no_reg') != ''){
            if( $_FILES['berkas']['name'] != '' ){
                $config['upload_path'] = './upload/berkas/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['encrypt_name'] = TRUE;
                $config['min_width'] = '800';
                $config['min_height'] = '800';
                $this->upload->initialize($config);

                $id1 = htmlspecialchars($this->input->post('id'));
                $sql = $this->db->query("SELECT * FROM tb_gambar WHERE id_gambar = '$id1' ")->row_array();

                unlink("./upload/berkas/".$sql['url_gambar']);
        
                $id = htmlspecialchars($this->input->post('id'));
                if($this->upload->do_upload('berkas')){
                    $nama = $this->upload->data();
                    $data = [
                        'id_santri'=>$this->session->userdata('no_reg'),
                        'url_gambar'=>$nama['file_name'],
                        'jenis_berkas'=> htmlspecialchars($this->input->post('jenis')),
                        'ket'=>htmlspecialchars($this->input->post('ket'))
                    ];
                    $this->santri_model->edit_berkas($data, $id);
                    $this->session->set_flashdata('berkas_berhasil', '<script>swal("Berhasil !", "Upload Bekas Berhasil.", "success")</script>');
                    redirect('berkas');
                }else{
                    $this->session->set_flashdata('error_berkas', '<script>swal("Gagal !", "Gambar harus berformat gif/jgp/png atau jpeg. Dan minimal ukuran gambar adalah 800 X 800", "error")</script>');
                    redirect('berkas');
                }
            }else{
                $id1 = htmlspecialchars($this->input->post('no_reg'));
                $id = htmlspecialchars($this->input->post('id'));
                $data = [
                    'id_santri'=>$id1,
                    
                    'jenis_berkas'=> htmlspecialchars($this->input->post('jenis')),
                    'ket'=>htmlspecialchars($this->input->post('ket'))
                ];
                $this->santri_model->edit_berkas($data, $id);
                $this->session->set_flashdata('berkas_berhasil', '<script>swal("Berhasil !", "Upload Bekas Berhasil.", "success")</script>');
                redirect('berkas');
            }
        }else{
            $this->session->set_flashdata('login_dulu', '<script>swal("Silahkan Login Dulu !", "Masukan Username dan Password.", "error")</script>');
		    redirect('');
        }
        
    }
    public function edit_bayar(){
        if($this->session->userdata('no_reg') != ''){
            if( $_FILES['bayar']['name'] != '' ){
                $config['upload_path'] = './upload/bayar/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['encrypt_name'] = TRUE;
                $config['min_width'] = '700';
                $config['min_height'] = '700';
                $this->upload->initialize($config);

                $id1 = htmlspecialchars($this->input->post('id'));
                $sql = $this->db->query("SELECT * FROM tb_bayar WHERE id_bayar = '$id1' ")->row_array();

                unlink("./upload/bayar/".$sql['url_gambar']);
        
                $id = htmlspecialchars($this->input->post('id'));
                if($this->upload->do_upload('bayar')){
                    $nama = $this->upload->data();
                    $data = [
                        'id_santri'=>$this->session->userdata('no_reg'),
                        'bukti_bayar'=>$nama['file_name'],
                        
                    ];
                    $this->santri_model->edit_bayar($data, $id);
                    $this->session->set_flashdata('bayar_berhasil', '<script>swal("Berhasil !", "Upload Bekas Berhasil.", "success")</script>');
                    redirect('bayar');
                }else{
                    $this->session->set_flashdata('error_bayar', '<script>swal("Gagal !", "Gambar harus berformat gif/jgp/png atau jpeg. Dan minimal ukuran gambar adalah 700 X 700", "error")</script>');
                    redirect('bayar');
                }
            }else{
                $id1 = htmlspecialchars($this->input->post('no_reg'));
                $id = htmlspecialchars($this->input->post('id'));
                $data = [
                    'id_santri'=>$id1,

                ];
                $this->santri_model->edit_bayar($data, $id);
                $this->session->set_flashdata('bayar_berhasil', '<script>swal("Berhasil !", "Upload Bekas Berhasil.", "success")</script>');
                redirect('bayar');
            }
        }else{
            $this->session->set_flashdata('login_dulu', '<script>swal("Silahkan Login Dulu !", "Masukan Username dan Password.", "error")</script>');
		    redirect('');
        }
        
    }
    public function simpan_akun(){
        if($this->session->userdata('no_reg') != ''){
            $id = $this->session->userdata('no_reg');
            if($this->input->post('kata_sandi') == ''){
                    $data = [
                        'email'=>htmlspecialchars($this->input->post('email')),
                        'no_telp'=>htmlspecialchars($this->input->post('nomor')),
                    ];
                    $this->santri_model->update_email($data, $id);
                    $this->session->set_flashdata('email_berhasil', '<script>swal("Berhasil !", "Akun Diperbarui.", "success")</script>');
                    redirect('akun');
                
            }else{
                if($this->input->post('kata_sandi') === $this->session->userdata('password')){
                    $data = [
                        'email'=>htmlspecialchars($this->input->post('email')),
                        'no_telp'=>htmlspecialchars($this->input->post('nomor')),
                        'kata_sandi'=>htmlspecialchars($this->input->post('konfirmasi')),
                        'kata_sandi_ulang'=>htmlspecialchars($this->input->post('konfirmasi')),
                    ];
                    $this->santri_model->update_email($data, $id);
                    $this->session->set_flashdata('email_berhasil', '<script>swal("Berhasil !", "Akun Diperbarui.", "success")</script>');
                    redirect('akun');
                }else{
                    $this->session->set_flashdata('sandi_salah', '<script>swal("Gagal !", "Kata Sandi Tidak Cocok !", "error")</script>');
                    redirect('akun');
                }
            }
        }else{
            $this->session->set_flashdata('login_dulu', '<script>swal("Silahkan Login Dulu !", "Masukan Username dan Password.", "error")</script>');
		    redirect('');
        }

    }

    public function hapus_berkas($id){
        if($this->session->userdata('no_reg') != ''){
            $id1 = $id;
            $sql = $this->db->query("SELECT * FROM tb_gambar WHERE id_gambar = '$id1' ")->row_array();

            unlink("./upload/berkas/".$sql['url_gambar']);
            $this->santri_model->hapus($id);
            $this->session->set_flashdata('hapus_berhasil', '<script>swal("Berhasil !", "Berkas Berhasil Dihapus.", "success")</script>');
            redirect('berkas');
        }else{
            $this->session->set_flashdata('login_dulu', '<script>swal("Silahkan Login Dulu !", "Masukan Username dan Password.", "error")</script>');
		    redirect('');
        }
    }

    // public function pendaftaran(){
    //     if($this->session->userdata('no_reg') != ''){
    //         $id = $this->session->userdata('no_reg');
    //         $data['profil'] =$this->santri_model->read_profil($id)->row_array();
    //         $this->load->view('page/pendaftaran', $data);
    //     }else{
    //         $this->session->set_flashdata('login_dulu', '<script>swal("Silahkan Login Dulu !", "Masukan Username dan Password.", "error")</script>');
	// 	    redirect('');
    //     }
    // }
    public function pondok()
    {
        $this->load->helper('tanggal');
        if($this->session->userdata('no_reg') != ''){
            $ayah="Ayah Kandung";
            $ibu="Ibu Kandung";
            $id = $this->session->userdata('no_reg');
            $data['cetak'] =$this->santri_model->read_profil($id)->row_array();

            $data['ayah'] =$this->santri_model->read_ayah($id,$ayah);

            $data['ibu'] =$this->santri_model->read_ibu($id,$ibu);


            $alm =$this->santri_model->read_profil($id)->row_array();

            $data['des'] = $this->db->query("SELECT * FROM wilayah_desa WHERE id=$alm[desa]")->row_array();
            $data['kec'] = $this->db->query("SELECT * FROM wilayah_kecamatan WHERE id=$alm[kecamatan]")->row_array();
            $data['kab'] = $this->db->query("SELECT * FROM wilayah_kabupaten WHERE id=$alm[kabupaten] ")->row_array();
            $data['prov'] = $this->db->query("SELECT * FROM wilayah_provinsi WHERE id=$alm[provinsi] ")->row_array();
            $this->load->view('page/pondok', $data);
        }else{
            $this->session->set_flashdata('login_dulu', '<script>swal("Silahkan Login Dulu !", "Masukan Username dan Password.", "error")</script>');
            redirect('');
        }
       
    }

 public function formal()
    {
        $this->load->helper('tanggal');
        if($this->session->userdata('no_reg') != ''){
            $ayah="Ayah Kandung";
            $ibu="Ibu Kandung";
            $id = $this->session->userdata('no_reg');
            $data['cetak'] =$this->santri_model->read_profil($id)->row_array();

            $data['ayah'] =$this->santri_model->read_ayah($id,$ayah);
            
            $data['ibu'] =$this->santri_model->read_ibu($id,$ibu);


            $alm =$this->santri_model->read_profil($id)->row_array();

            $data['des'] = $this->db->query("SELECT * FROM wilayah_desa WHERE id=$alm[desa]")->row_array();
            $data['kec'] = $this->db->query("SELECT * FROM wilayah_kecamatan WHERE id=$alm[kecamatan]")->row_array();
            $data['kab'] = $this->db->query("SELECT * FROM wilayah_kabupaten WHERE id=$alm[kabupaten] ")->row_array();
            $data['prov'] = $this->db->query("SELECT * FROM wilayah_provinsi WHERE id=$alm[provinsi] ")->row_array();
            $this->load->view('page/formal', $data);
        }else{
            $this->session->set_flashdata('login_dulu', '<script>swal("Silahkan Login Dulu !", "Masukan Username dan Password.", "error")</script>');
            redirect('');
        }
       
    }
    public function salaf()
    {
        $this->load->helper('tanggal');
        if($this->session->userdata('no_reg') != ''){
            $ayah="Ayah Kandung";
            $ibu="Ibu Kandung";
            $id = $this->session->userdata('no_reg');
            $data['cetak'] =$this->santri_model->read_profil($id)->row_array();

            $data['ayah'] =$this->santri_model->read_ayah($id,$ayah);
            
            $data['ibu'] =$this->santri_model->read_ibu($id,$ibu);


            $alm =$this->santri_model->read_profil($id)->row_array();

            $data['des'] = $this->db->query("SELECT * FROM wilayah_desa WHERE id=$alm[desa]")->row_array();
            $data['kec'] = $this->db->query("SELECT * FROM wilayah_kecamatan WHERE id=$alm[kecamatan]")->row_array();
            $data['kab'] = $this->db->query("SELECT * FROM wilayah_kabupaten WHERE id=$alm[kabupaten] ")->row_array();
            $data['prov'] = $this->db->query("SELECT * FROM wilayah_provinsi WHERE id=$alm[provinsi] ")->row_array();
            $this->load->view('page/salaf', $data);
        }else{
            $this->session->set_flashdata('login_dulu', '<script>swal("Silahkan Login Dulu !", "Masukan Username dan Password.", "error")</script>');
            redirect('');
        }
       
    }
}

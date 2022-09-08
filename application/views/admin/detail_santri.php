<?php $this->load->view('admin/header') ?>

<!-- /top tiles -->
<br><br><br><br><br><br><br><br>
<?php echo $this->session->flashdata('succ') ?>
<div class="row" style="padding: 20px;">
	<!-- tulis disini -->
    <a href="<?=base_url()?>admin_control_panel/data_santri" class="btn btn-primary"> Kembali</a>

	<div class="card">
		<div class="card-header">
			<h3>No. Registrasi <?=$santri['no_reg']?></h3>
		</div>
		<div class="card-body">
            <?php if($santri['foto_diri'] != ''){ ?>
                <img src="<?=base_url('upload')?>/user/<?=$santri['foto_diri']?>" class="img-fluid" width="200"
                    alt="Fotonya">
                <?php
            }else{ ?>
                    <img src="<?=base_url('upload')?>/user/fotokosong.gif" class="img-fluid" width="200"
                    alt="Fotonya">
            <?php } ?>
			<br><br>
			<div class="row mt-4">
				<div class="col-sm-3">
					Nomer KK
				</div>
				<div class="col-sm-8">
					<?=$santri['nomer_kk']?>
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-sm-3">
					N I K
				</div>
				<div class="col-sm-8">
					<?=$santri['nik']?>
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-sm-3">
					Nama Lengkap
				</div>
				<div class="col-sm-8">
					<?=$santri['nama_lengkap']?>
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-sm-3">
					Gender
				</div>
				<div class="col-sm-8">
					<?=$santri['jenis_kelamin']?>
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-sm-3">
					Tempat, Tanggal Lahir
				</div>
				<div class="col-sm-8">
					<?php
                        function tgl_indo($tanggal){
                            $bulan = array (
                                1 =>   'Januari',
                                'Februari',
                                'Maret',
                                'April',
                                'Mei',
                                'Juni',
                                'Juli',
                                'Agustus',
                                'September',
                                'Oktober',
                                'November',
                                'Desember'
                            );
                            $pecahkan = explode('-', $tanggal);
                            
                            // variabel pecahkan 0 = tanggal
                            // variabel pecahkan 1 = bulan
                            // variabel pecahkan 2 = tahun
                        
                            return $pecahkan[0] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[2];
                        }
                    ?>
					<?=$santri['tempat_lahir']?>, <?php echo tgl_indo($santri['tanggal_lahir'])?>

				</div>
			</div>
            <div class="row mt-4">
                <div class="col-sm-3">
                    Anak Ke
                </div>
                <div class="col-sm-8">
                    <?=$santri['anak_ke']?> Dari <?=$santri['dari_saudara']?> Bersaudara
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-3">
                    Tinggal Bersama
                </div>
                <div class="col-sm-8">
                    <?=$santri['tinggal_bersama']?>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-3">
                    Pendidikan Terakhir
                </div>
                <div class="col-sm-8">
                    <?=$santri['pendidikan_terakhir']?>
                </div>
            </div>
            <hr>
            <div class="row mt-4">
                <div class="col-sm-3">
                    Alamat 
                </div>
                <?php
                                
                $prov = $this->db->query("SELECT * FROM wilayah_provinsi WHERE id = '$santri[provinsi]' ")->row_array();
                $kab = $this->db->query("SELECT * FROM wilayah_kabupaten WHERE id = '$santri[kabupaten]' ")->row_array();
                $kec = $this->db->query("SELECT * FROM wilayah_kecamatan WHERE id = '$santri[kecamatan]' ")->row_array();
                $ds = $this->db->query("SELECT * FROM wilayah_desa WHERE id = '$santri[desa]' ")->row_array();
                
                ?>
                <div class="col-sm-8">
                   Provinsi <b><?=$prov['nama']?></b> <br>
                   Kabupaten <b><?=$kab['nama']?></b> <br>
                   Kecamatan <b><?=$kec['nama']?></b> <br>
                   Desa <b><?=$ds['nama']?></b> 
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-3">
                    Alamat Detail
                </div>
                <div class="col-sm-8">
                    <?=$santri['alamat_detail']?>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-3">
                    Pendidikan Terakhir
                </div>
                <div class="col-sm-8">
                    <?=$santri['pendidikan_terakhir']?>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-3">
                    Kode Pos
                </div>
                <div class="col-sm-8">
                    <?=$santri['kode_pos']?>
                </div>
            </div>
            <hr>

            <div class="row mt-4">
                <div class="col-sm-3">
                    Tempat Mondok
                </div>
                <div class="col-sm-8">
                    <?=$santri['mondok']?>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-3">
                    Jenis Pendaftaran
                </div>
                <div class="col-sm-8">
                    <?=$santri['jenis_pendaftaran']?>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-3">
                    Lembaga Formal
                </div>
                <div class="col-sm-8">
                    <?=$santri['lembaga_pendidikan']?>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-3">
                    Lembaga Salaf
                </div>
                <div class="col-sm-8">
                    <?=$santri['status_pendidikan']?>
                </div>
            </div>
            <hr class="my-3">
            <div class="row mt-4">
                <div class="col-sm-3">
                    Ukuran Seragam
                </div>
                <div class="col-sm-8">
                    <?=$santri['ukuran_seragam']?>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-3">
                    E-Mail
                </div>
                <div class="col-sm-8">
                    <?=$santri['email']?>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-3">
                    No. Telephon
                </div>
                <div class="col-sm-8">
                    <?=$santri['no_telp']?>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-3">
                    Kata Sandi
                </div>
                <div class="col-sm-8">
                    <?=$santri['kata_sandi']?>
                </div>
            </div>




		</div>
        <hr>
        <h1>Berkas-berkas</h1>
        <div class="row">
            <?php foreach($berkas as $b){
                ?>
                    <div class="col-sm-3">
                        <img src="<?=base_url('upload')?>/berkas/<?=$b->url_gambar?>" class="img-fluid img-thumbnail" alt="">
                        <span class="badge badge-success" style="position: absolute; top: 10px; left: 25px;"><?=$b->jenis_berkas?></span>
                      <br><br>
                        <small>
                            Keterangan : <br>
                            <?=$b->ket?> 
                            <br/>
                            <?php echo anchor('Admin_control_panel/download_data/'.$b->url_gambar, $b->ket, array('class'=>'btn btn-danger fa fa-download',
            'onclick'=>'return confirm(\'apakah data mau didownload\')')) ?>
                        </small>
                    </div>
                <?php
            } ?>
        </div>    

        <hr>
        <h1>Wali Santri</h1>
        <div class="row">
        <?php
                    $id = $santri['no_reg'];

                    
                    $sql  = $this->db->query("SELECT * FROM tb_wali WHERE id_santri = '$id' ");
                    $sql2  = $this->db->query("SELECT * FROM tb_wali WHERE id_santri = '$id' ")->result();
                    $tabel = $sql->num_rows();
                    if($tabel > 0){
                        ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Tempat Lahir</th>
                                        <th>Pendidikan</th>
                                        <th>Pekerjaan</th>
                                        <th>Penghasilan</th>
                                        <th>No Telephon</th>
                                        <th>Status</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no =1;
                                    foreach ($sql2 as $n) {
                                        ?>
                                            <tr>
                                                <td><?=$no?></td>
                                                <td><?=$n->nama?></td>
                                                <td><?=$n->tempat_lahir?></td>
                                                <td><?=$n->pendidikan_terakhir?></td>
                                                <td><?=$n->pekerjaan?></td>
                                                <td><?php
                                                    $hasil_rupiah = "Rp " . number_format($n->penghasilan,2,',','.');
	                                                echo $hasil_rupiah . " / bulan";
                                                ?></td>
                                                <td><?=$n->no_tel?></td>
                                                <td><?=$n->status_wali?></td>
                                               
                                            </tr>
                                        <?php $no++;
                                    } ?>
                                </tbody>
                            </table>
                        <?php
                    }else{
                        ?>
                            <div class="alert alert-danger" role="alert">
                                <i>Tidak ada wali</i>
                            </div>
                        <?php
                    }
                ?>
        </div>
                 


	</div>
</div>






</div>
<br />
<?php $this->load->view('admin/footer') ?>

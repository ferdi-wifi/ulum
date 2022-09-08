<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_control_panel extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('santri_model');
        
        if($this->session->userdata('nama') == '' && $this->session->userdata('username') == ''){
            $this->session->set_flashdata('login_dulu', '<script>swal("Login Dulu !", "Silahkan Login Dulu !", "error")</script>');
            redirect('admin-control-panel-Raudlatul-ulum');
        }
        
    }
    public function index(){
        $data['jumlah_santri'] = $this->santri_model->jumlah_santri()->num_rows();
        $data['perempuan'] = $this->santri_model->perempuan()->num_rows();
        $data['laki'] = $this->santri_model->laki()->num_rows();
        $this->load->view('admin/home', $data);
    }
    public function laporan(){
        $dadi="Madrasah I'dadiyah Raudlatul Ulum";
        $wustho="Pendidikan Diniyah Raudlatul Ulum Wustho";
        $ulya="Pendidikan Diniyah Raudlatul Ulum Tingkat Ulya";
        $madya="Ma'had Aly Raudlatul Ulum";
        $ma="MA Raudlatul Ulum";
        $mts="MTS Raudlatul Ulum";
        $mi="MI Raudlatul Ulum";
        $tk="TK Raudlatul Ulum";
        $paud="PAUD Raudlatul Ulum";
        $data['jumlah_santri'] = $this->santri_model->jumlah_santri()->num_rows();
        $data['dadi'] = $this->db->where('status_pendidikan',$dadi)->get('tb_santri')->num_rows();
        $data['wustho'] = $this->db->where('status_pendidikan',$wustho)->get('tb_santri')->num_rows();
        $data['ulya'] = $this->db->where('status_pendidikan',$ulya)->get('tb_santri')->num_rows();
        $data['madya'] = $this->db->where('status_pendidikan',$madya)->get('tb_santri')->num_rows();
        $data['ma'] = $this->db->where('lembaga_pendidikan',$ma)->get('tb_santri')->num_rows();
        $data['mts'] = $this->db->where('lembaga_pendidikan',$mts)->get('tb_santri')->num_rows();
        $data['mi'] = $this->db->where('lembaga_pendidikan',$mi)->get('tb_santri')->num_rows();
        $data['tk'] = $this->db->where('lembaga_pendidikan',$tk)->get('tb_santri')->num_rows();
        $data['paud'] = $this->db->where('lembaga_pendidikan',$paud)->get('tb_santri')->num_rows();
        $this->load->view('admin/laporan', $data);
    }
    public function laporansantri(){
        // Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();

		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
							   ->setLastModifiedBy('My Notes Code')
							   ->setTitle("Data Santri")
							   ->setSubject("Santri")
							   ->setDescription("Laporan Semua Data Santri")
							   ->setKeywords("Data Santri");

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "Laporan Pendaftar Santri Raudlatul Ulum 2021-2022 TANGGAL DOWNLOAD ".date('d-m-Y')); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:X1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "NO REGISTER"); 
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "NOMOR KK"); 
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "NIK"); 
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "NAMA LENGKAP"); 
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "JENIS KELAMIN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "TEMPAT LAHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('H3', "TANGGAL LAHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('I3', "ANAK KE"); 
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "DARI SAUDARA"); 
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "TINGGAL BERSAMA"); 
		$excel->setActiveSheetIndex(0)->setCellValue('L3', "PENDIDIKAN TERAKHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('M3', "PROVINSI"); 
		$excel->setActiveSheetIndex(0)->setCellValue('N3', "KABUPATEN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('O3', "KECAMATAN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('P3', "DESA"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Q3', "ALAMAT LENGKAP"); 
		$excel->setActiveSheetIndex(0)->setCellValue('R3', "KODE POS"); 
		$excel->setActiveSheetIndex(0)->setCellValue('S3', "MONDOK"); 
        $excel->setActiveSheetIndex(0)->setCellValue('T3', "JENIS PENDAFTARAN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('U3', "LEMBAGA PENDIDIKAN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('V3', "STATUS PENDIDIKAN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('W3', "UKURAN SERAGAM"); 
		$excel->setActiveSheetIndex(0)->setCellValue('X3', "NO TELP"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Y3', "NAMA AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Z3', "AGAMA AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AA3', "PEKERJAAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AB3', "TELP AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AC3', "PENDIDIKAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AD3', "PENGHASILAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AE3', "NAMA IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AF3', "AGAMA IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AG3', "PEKERJAAN IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AH3', "TELP IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AI3', "PENDIDIKAN IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AJ3', "PENGHASILAN IBU"); 
		
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('P3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Q3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('R3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('S3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('T3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('U3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('V3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('W3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('X3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Y3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Z3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AA3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AB3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AC3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AD3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AE3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AF3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AG3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AH3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AI3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AJ3')->applyFromArray($style_col);
	

		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $santri = $this->santri_model->santri();
		

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($santri as $data){ // Lakukan looping pada variabel siswa
			
			$ayah =$this->santri_model->read_ayah($data->no_reg,"Ayah Kandung");
			$ibu =$this->santri_model->read_ibu($data->no_reg, "Ibu Kandung");
			if ($ayah->num_rows() > 0) {
				foreach ($ayah->result_object() as $y) {
					$ayahnama=$y->nama;
					$ayahagama=$y->agama;
					$ayahpekerjaan=$y->pekerjaan;
					$ayahtlp=$y->no_tel;
					$pendidikanayah=$y->pendidikan_terakhir;
					$penghasilanayah=$y->penghasilan;

				}

			   } else {
					$ayahnama="";
					$ayahagama="";
					$ayahpekerjaan="";
					$ayahtlp="";
					$pendidikanayah="";
					$penghasilanayah="";
			   }

			   if ($ibu->num_rows() > 0) {
				foreach ($ibu->result_object() as $yi) {
					$ibunama=$yi->nama;
					$ibuagama=$yi->agama;
					$ibupekerjaan=$yi->pekerjaan;
					$ibutlp=$yi->no_tel;
					$pendidikanibu=$yi->pendidikan_terakhir;
					$penghasilanibu=$yi->penghasilan;

				}

			   } else {
					$ibunama="";
					$ibuagama="";
					$ibupekerjaan="";
					$ibutlp="";
					$pendidikanibu="";
					$penghasilanibu="";
			   }

			
            $provinsi = $this->santri_model->provinsi($data->provinsi);
            $kabupaten = $this->santri_model->kabupaten($data->kabupaten);
            $kecamatan = $this->santri_model->kecamatan($data->kecamatan);
			$desa = $this->santri_model->desa($data->desa);
			
			if ($data->provinsi=="") {
				$prov= "Data Provinsi Belum diisi";
			} else {
				$prov=$provinsi->nama;
			}

			if ($data->kabupaten=="") {
				$kab= "Data Kabupaten Belum diisi";
			} else {
				$kab=$kabupaten->nama;
			}

			if ($data->kecamatan=="") {
				$kec= "Data Kecamatan Belum diisi";
			} else {
				$kec=$kecamatan->nama;
			}

			if ($data->desa=="") {
				$des= "Data Desa Belum diisi";
			} else {
				$des=$desa->nama;
			}
			
        
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->no_reg);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, "'".$data->nomer_kk);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, "'".$data->nik);
            $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->nama_lengkap);
            $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, ucwords($data->jenis_kelamin));
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->tempat_lahir);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->tanggal_lahir);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->anak_ke);
            $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->dari_saudara);
            $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->tinggal_bersama);
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data->pendidikan_terakhir);
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $prov);
			$excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $kab);
            $excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $kec);
            $excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $des);
			$excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $data->alamat_detail);
			$excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, $data->kode_pos);
			$excel->setActiveSheetIndex(0)->setCellValue('S'.$numrow, $data->mondok);
            $excel->setActiveSheetIndex(0)->setCellValue('T'.$numrow, $data->jenis_pendaftaran);
            $excel->setActiveSheetIndex(0)->setCellValue('U'.$numrow, $data->lembaga_pendidikan);
			$excel->setActiveSheetIndex(0)->setCellValue('V'.$numrow, $data->status_pendidikan);
			$excel->setActiveSheetIndex(0)->setCellValue('W'.$numrow, $data->ukuran_seragam);
			$excel->setActiveSheetIndex(0)->setCellValue('X'.$numrow, $data->no_telp);
			$excel->setActiveSheetIndex(0)->setCellValue('Y'.$numrow, $ayahnama);
			$excel->setActiveSheetIndex(0)->setCellValue('Z'.$numrow, $ayahagama);
			$excel->setActiveSheetIndex(0)->setCellValue('AA'.$numrow, $ayahpekerjaan);
			$excel->setActiveSheetIndex(0)->setCellValue('AB'.$numrow, $ayahtlp);
			$excel->setActiveSheetIndex(0)->setCellValue('AC'.$numrow, $pendidikanayah);
			$excel->setActiveSheetIndex(0)->setCellValue('AD'.$numrow, $penghasilanayah);
			$excel->setActiveSheetIndex(0)->setCellValue('AE'.$numrow, $ibunama);
			$excel->setActiveSheetIndex(0)->setCellValue('AF'.$numrow, $ibuagama);
			$excel->setActiveSheetIndex(0)->setCellValue('AG'.$numrow, $ibupekerjaan);
			$excel->setActiveSheetIndex(0)->setCellValue('AH'.$numrow, $ibutlp);
			$excel->setActiveSheetIndex(0)->setCellValue('AI'.$numrow, $pendidikanibu);
			$excel->setActiveSheetIndex(0)->setCellValue('AJ'.$numrow, $penghasilanibu);
		
			
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Q'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('R'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('S'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('T'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('U'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('V'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('W'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('X'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Y'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Z'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AA'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AB'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AC'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AD'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AE'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AF'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AG'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AH'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AI'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AJ'.$numrow)->applyFromArray($style_row);
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(10); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(20); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(25); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(18); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(18); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('O')->setWidth(18); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('P')->setWidth(18); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(35); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('R')->setWidth(10); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('S')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('T')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('U')->setWidth(35); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('V')->setWidth(35); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('W')->setWidth(20); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('X')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('Y')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('Z')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AA')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AB')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AC')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AD')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AE')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AF')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AG')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AH')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AI')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AJ')->setWidth(20); // Set width kolom D
		
		
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Laporan Data Pendaftar Santri");
		$excel->setActiveSheetIndex(0);

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Pendaftar Santri'.time().'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
    }
    public function laporansalafdadi(){
        // Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();

		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
							   ->setLastModifiedBy('My Notes Code')
							   ->setTitle("Data Santri")
							   ->setSubject("Santri")
							   ->setDescription("Laporan Semua Data Santri")
							   ->setKeywords("Data Santri");

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "Laporan Pendaftar Madrasah I'dadiyah Raudlatul Ulum  2021-2022 TANGGAL DOWNLOAD ".date('d-m-Y')); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:X1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "NO REGISTER"); 
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "NOMOR KK"); 
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "NIK"); 
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "NAMA LENGKAP"); 
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "JENIS KELAMIN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "TEMPAT LAHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('H3', "TANGGAL LAHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('I3', "ANAK KE"); 
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "DARI SAUDARA"); 
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "TINGGAL BERSAMA"); 
		$excel->setActiveSheetIndex(0)->setCellValue('L3', "PENDIDIKAN TERAKHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('M3', "PROVINSI"); 
		$excel->setActiveSheetIndex(0)->setCellValue('N3', "KABUPATEN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('O3', "KECAMATAN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('P3', "DESA"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Q3', "ALAMAT LENGKAP"); 
		$excel->setActiveSheetIndex(0)->setCellValue('R3', "KODE POS"); 
		$excel->setActiveSheetIndex(0)->setCellValue('S3', "MONDOK"); 
        $excel->setActiveSheetIndex(0)->setCellValue('T3', "JENIS PENDAFTARAN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('U3', "LEMBAGA PENDIDIKAN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('V3', "STATUS PENDIDIKAN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('W3', "UKURAN SERAGAM"); 
		$excel->setActiveSheetIndex(0)->setCellValue('X3', "NO TELP"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Y3', "NAMA AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Z3', "AGAMA AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AA3', "PEKERJAAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AB3', "TELP AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AC3', "PENDIDIKAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AD3', "PENGHASILAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AE3', "NAMA IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AF3', "AGAMA IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AG3', "PEKERJAAN IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AH3', "TELP IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AI3', "PENDIDIKAN IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AJ3', "PENGHASILAN IBU"); 
		
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('P3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Q3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('R3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('S3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('T3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('U3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('V3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('W3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('X3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Y3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Z3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AA3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AB3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AC3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AD3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AE3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AF3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AG3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AH3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AI3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AJ3')->applyFromArray($style_col);
	

		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		$nama="Madrasah I'dadiyah Raudlatul Ulum";
        $santri = $this->santri_model->salaf($nama);

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($santri as $data){ // Lakukan looping pada variabel siswa
			
			$ayah =$this->santri_model->read_ayah($data->no_reg,"Ayah Kandung");
			$ibu =$this->santri_model->read_ibu($data->no_reg, "Ibu Kandung");
			if ($ayah->num_rows() > 0) {
				foreach ($ayah->result_object() as $y) {
					$ayahnama=$y->nama;
					$ayahagama=$y->agama;
					$ayahpekerjaan=$y->pekerjaan;
					$ayahtlp=$y->no_tel;
					$pendidikanayah=$y->pendidikan_terakhir;
					$penghasilanayah=$y->penghasilan;

				}

			   } else {
					$ayahnama="";
					$ayahagama="";
					$ayahpekerjaan="";
					$ayahtlp="";
					$pendidikanayah="";
					$penghasilanayah="";
			   }

			   if ($ibu->num_rows() > 0) {
				foreach ($ibu->result_object() as $yi) {
					$ibunama=$yi->nama;
					$ibuagama=$yi->agama;
					$ibupekerjaan=$yi->pekerjaan;
					$ibutlp=$yi->no_tel;
					$pendidikanibu=$yi->pendidikan_terakhir;
					$penghasilanibu=$yi->penghasilan;

				}

			   } else {
					$ibunama="";
					$ibuagama="";
					$ibupekerjaan="";
					$ibutlp="";
					$pendidikanibu="";
					$penghasilanibu="";
			   }

			
            $provinsi = $this->santri_model->provinsi($data->provinsi);
            $kabupaten = $this->santri_model->kabupaten($data->kabupaten);
            $kecamatan = $this->santri_model->kecamatan($data->kecamatan);
			$desa = $this->santri_model->desa($data->desa);
			
			if ($data->provinsi=="") {
				$prov= "Data Provinsi Belum diisi";
			} else {
				$prov=$provinsi->nama;
			}

			if ($data->kabupaten=="") {
				$kab= "Data Kabupaten Belum diisi";
			} else {
				$kab=$kabupaten->nama;
			}

			if ($data->kecamatan=="") {
				$kec= "Data Kecamatan Belum diisi";
			} else {
				$kec=$kecamatan->nama;
			}

			if ($data->desa=="") {
				$des= "Data Desa Belum diisi";
			} else {
				$des=$desa->nama;
			}
			
        
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->no_reg);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, "'".$data->nomer_kk);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, "'".$data->nik);
            $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->nama_lengkap);
            $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, ucwords($data->jenis_kelamin));
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->tempat_lahir);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->tanggal_lahir);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->anak_ke);
            $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->dari_saudara);
            $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->tinggal_bersama);
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data->pendidikan_terakhir);
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $prov);
			$excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $kab);
            $excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $kec);
            $excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $des);
			$excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $data->alamat_detail);
			$excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, $data->kode_pos);
			$excel->setActiveSheetIndex(0)->setCellValue('S'.$numrow, $data->mondok);
            $excel->setActiveSheetIndex(0)->setCellValue('T'.$numrow, $data->jenis_pendaftaran);
            $excel->setActiveSheetIndex(0)->setCellValue('U'.$numrow, $data->lembaga_pendidikan);
			$excel->setActiveSheetIndex(0)->setCellValue('V'.$numrow, $data->status_pendidikan);
			$excel->setActiveSheetIndex(0)->setCellValue('W'.$numrow, $data->ukuran_seragam);
			$excel->setActiveSheetIndex(0)->setCellValue('X'.$numrow, $data->no_telp);
			$excel->setActiveSheetIndex(0)->setCellValue('Y'.$numrow, $ayahnama);
			$excel->setActiveSheetIndex(0)->setCellValue('Z'.$numrow, $ayahagama);
			$excel->setActiveSheetIndex(0)->setCellValue('AA'.$numrow, $ayahpekerjaan);
			$excel->setActiveSheetIndex(0)->setCellValue('AB'.$numrow, $ayahtlp);
			$excel->setActiveSheetIndex(0)->setCellValue('AC'.$numrow, $pendidikanayah);
			$excel->setActiveSheetIndex(0)->setCellValue('AD'.$numrow, $penghasilanayah);
			$excel->setActiveSheetIndex(0)->setCellValue('AE'.$numrow, $ibunama);
			$excel->setActiveSheetIndex(0)->setCellValue('AF'.$numrow, $ibuagama);
			$excel->setActiveSheetIndex(0)->setCellValue('AG'.$numrow, $ibupekerjaan);
			$excel->setActiveSheetIndex(0)->setCellValue('AH'.$numrow, $ibutlp);
			$excel->setActiveSheetIndex(0)->setCellValue('AI'.$numrow, $pendidikanibu);
			$excel->setActiveSheetIndex(0)->setCellValue('AJ'.$numrow, $penghasilanibu);
		
			
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Q'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('R'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('S'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('T'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('U'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('V'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('W'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('X'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Y'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Z'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AA'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AB'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AC'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AD'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AE'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AF'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AG'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AH'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AI'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AJ'.$numrow)->applyFromArray($style_row);
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(10); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(20); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(25); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(18); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(18); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('O')->setWidth(18); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('P')->setWidth(18); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(35); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('R')->setWidth(10); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('S')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('T')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('U')->setWidth(35); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('V')->setWidth(35); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('W')->setWidth(20); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('X')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('Y')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('Z')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AA')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AB')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AC')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AD')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AE')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AF')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AG')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AH')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AI')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AJ')->setWidth(20); // Set width kolom D
		
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Laporan Data Pendaftar Santri");
		$excel->setActiveSheetIndex(0);

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Pendaftar Santri Madrasah Idadiyah Raudlatul Ulum'.time().'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
    }
    public function laporansalafwustho(){
        // Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();

		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
							   ->setLastModifiedBy('My Notes Code')
							   ->setTitle("Data Santri")
							   ->setSubject("Santri")
							   ->setDescription("Laporan Semua Data Santri")
							   ->setKeywords("Data Santri");

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "Laporan Pendaftar Pendidikan Diniyah Formal Raudlatul Ulum Tingkat Wustho 2021-2022 TANGGAL DOWNLOAD ".date('d-m-Y')); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:X1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "NO REGISTER"); 
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "NOMOR KK"); 
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "NIK"); 
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "NAMA LENGKAP"); 
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "JENIS KELAMIN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "TEMPAT LAHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('H3', "TANGGAL LAHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('I3', "ANAK KE"); 
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "DARI SAUDARA"); 
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "TINGGAL BERSAMA"); 
		$excel->setActiveSheetIndex(0)->setCellValue('L3', "PENDIDIKAN TERAKHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('M3', "PROVINSI"); 
		$excel->setActiveSheetIndex(0)->setCellValue('N3', "KABUPATEN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('O3', "KECAMATAN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('P3', "DESA"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Q3', "ALAMAT LENGKAP"); 
		$excel->setActiveSheetIndex(0)->setCellValue('R3', "KODE POS"); 
		$excel->setActiveSheetIndex(0)->setCellValue('S3', "MONDOK"); 
        $excel->setActiveSheetIndex(0)->setCellValue('T3', "JENIS PENDAFTARAN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('U3', "LEMBAGA PENDIDIKAN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('V3', "STATUS PENDIDIKAN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('W3', "UKURAN SERAGAM"); 
		$excel->setActiveSheetIndex(0)->setCellValue('X3', "NO TELP"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Y3', "NAMA AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Z3', "AGAMA AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AA3', "PEKERJAAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AB3', "TELP AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AC3', "PENDIDIKAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AD3', "PENGHASILAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AE3', "NAMA IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AF3', "AGAMA IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AG3', "PEKERJAAN IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AH3', "TELP IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AI3', "PENDIDIKAN IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AJ3', "PENGHASILAN IBU"); 
		
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('P3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Q3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('R3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('S3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('T3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('U3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('V3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('W3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('X3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Y3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Z3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AA3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AB3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AC3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AD3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AE3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AF3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AG3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AH3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AI3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AJ3')->applyFromArray($style_col);
	

		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		$nama="Pendidikan Diniyah Formal Raudlatul Ulum Tingkat Wustho";
        $santri = $this->santri_model->salaf($nama);
		

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($santri as $data){ // Lakukan looping pada variabel siswa
			
			$ayah =$this->santri_model->read_ayah($data->no_reg,"Ayah Kandung");
			$ibu =$this->santri_model->read_ibu($data->no_reg, "Ibu Kandung");
			if ($ayah->num_rows() > 0) {
				foreach ($ayah->result_object() as $y) {
					$ayahnama=$y->nama;
					$ayahagama=$y->agama;
					$ayahpekerjaan=$y->pekerjaan;
					$ayahtlp=$y->no_tel;
					$pendidikanayah=$y->pendidikan_terakhir;
					$penghasilanayah=$y->penghasilan;

				}

			   } else {
					$ayahnama="";
					$ayahagama="";
					$ayahpekerjaan="";
					$ayahtlp="";
					$pendidikanayah="";
					$penghasilanayah="";
			   }

			   if ($ibu->num_rows() > 0) {
				foreach ($ibu->result_object() as $yi) {
					$ibunama=$yi->nama;
					$ibuagama=$yi->agama;
					$ibupekerjaan=$yi->pekerjaan;
					$ibutlp=$yi->no_tel;
					$pendidikanibu=$yi->pendidikan_terakhir;
					$penghasilanibu=$yi->penghasilan;

				}

			   } else {
					$ibunama="";
					$ibuagama="";
					$ibupekerjaan="";
					$ibutlp="";
					$pendidikanibu="";
					$penghasilanibu="";
			   }

			
            $provinsi = $this->santri_model->provinsi($data->provinsi);
            $kabupaten = $this->santri_model->kabupaten($data->kabupaten);
            $kecamatan = $this->santri_model->kecamatan($data->kecamatan);
			$desa = $this->santri_model->desa($data->desa);
			
			if ($data->provinsi=="") {
				$prov= "Data Provinsi Belum diisi";
			} else {
				$prov=$provinsi->nama;
			}

			if ($data->kabupaten=="") {
				$kab= "Data Kabupaten Belum diisi";
			} else {
				$kab=$kabupaten->nama;
			}

			if ($data->kecamatan=="") {
				$kec= "Data Kecamatan Belum diisi";
			} else {
				$kec=$kecamatan->nama;
			}

			if ($data->desa=="") {
				$des= "Data Desa Belum diisi";
			} else {
				$des=$desa->nama;
			}
			
        
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->no_reg);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, "'".$data->nomer_kk);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, "'".$data->nik);
            $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->nama_lengkap);
            $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, ucwords($data->jenis_kelamin));
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->tempat_lahir);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->tanggal_lahir);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->anak_ke);
            $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->dari_saudara);
            $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->tinggal_bersama);
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data->pendidikan_terakhir);
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $prov);
			$excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $kab);
            $excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $kec);
            $excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $des);
			$excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $data->alamat_detail);
			$excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, $data->kode_pos);
			$excel->setActiveSheetIndex(0)->setCellValue('S'.$numrow, $data->mondok);
            $excel->setActiveSheetIndex(0)->setCellValue('T'.$numrow, $data->jenis_pendaftaran);
            $excel->setActiveSheetIndex(0)->setCellValue('U'.$numrow, $data->lembaga_pendidikan);
			$excel->setActiveSheetIndex(0)->setCellValue('V'.$numrow, $data->status_pendidikan);
			$excel->setActiveSheetIndex(0)->setCellValue('W'.$numrow, $data->ukuran_seragam);
			$excel->setActiveSheetIndex(0)->setCellValue('X'.$numrow, $data->no_telp);
			$excel->setActiveSheetIndex(0)->setCellValue('Y'.$numrow, $ayahnama);
			$excel->setActiveSheetIndex(0)->setCellValue('Z'.$numrow, $ayahagama);
			$excel->setActiveSheetIndex(0)->setCellValue('AA'.$numrow, $ayahpekerjaan);
			$excel->setActiveSheetIndex(0)->setCellValue('AB'.$numrow, $ayahtlp);
			$excel->setActiveSheetIndex(0)->setCellValue('AC'.$numrow, $pendidikanayah);
			$excel->setActiveSheetIndex(0)->setCellValue('AD'.$numrow, $penghasilanayah);
			$excel->setActiveSheetIndex(0)->setCellValue('AE'.$numrow, $ibunama);
			$excel->setActiveSheetIndex(0)->setCellValue('AF'.$numrow, $ibuagama);
			$excel->setActiveSheetIndex(0)->setCellValue('AG'.$numrow, $ibupekerjaan);
			$excel->setActiveSheetIndex(0)->setCellValue('AH'.$numrow, $ibutlp);
			$excel->setActiveSheetIndex(0)->setCellValue('AI'.$numrow, $pendidikanibu);
			$excel->setActiveSheetIndex(0)->setCellValue('AJ'.$numrow, $penghasilanibu);
		
			
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Q'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('R'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('S'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('T'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('U'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('V'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('W'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('X'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Y'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Z'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AA'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AB'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AC'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AD'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AE'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AF'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AG'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AH'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AI'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AJ'.$numrow)->applyFromArray($style_row);
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(10); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(20); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(25); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(18); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(18); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('O')->setWidth(18); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('P')->setWidth(18); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(35); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('R')->setWidth(10); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('S')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('T')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('U')->setWidth(35); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('V')->setWidth(35); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('W')->setWidth(20); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('X')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('Y')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('Z')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AA')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AB')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AC')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AD')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AE')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AF')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AG')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AH')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AI')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AJ')->setWidth(20); // Set width kolom D
		
		
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Laporan Data Pendaftar Santri");
		$excel->setActiveSheetIndex(0);

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Pendaftar Santri Pendidikan Diniyah Formal Raudlatul Ulum Tingkat Wustho'.time().'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
    }
    public function laporansalafmahad(){
        // Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();

		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
							   ->setLastModifiedBy('My Notes Code')
							   ->setTitle("Data Santri")
							   ->setSubject("Santri")
							   ->setDescription("Laporan Semua Data Santri")
							   ->setKeywords("Data Santri");

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "Laporan Pendaftar Ma'had Aly Raudlatul Ulum 2021-2022 TANGGAL DOWNLOAD ".date('d-m-Y')); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:X1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "NO REGISTER"); 
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "NOMOR KK"); 
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "NIK"); 
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "NAMA LENGKAP"); 
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "JENIS KELAMIN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "TEMPAT LAHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('H3', "TANGGAL LAHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('I3', "ANAK KE"); 
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "DARI SAUDARA"); 
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "TINGGAL BERSAMA"); 
		$excel->setActiveSheetIndex(0)->setCellValue('L3', "PENDIDIKAN TERAKHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('M3', "PROVINSI"); 
		$excel->setActiveSheetIndex(0)->setCellValue('N3', "KABUPATEN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('O3', "KECAMATAN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('P3', "DESA"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Q3', "ALAMAT LENGKAP"); 
		$excel->setActiveSheetIndex(0)->setCellValue('R3', "KODE POS"); 
		$excel->setActiveSheetIndex(0)->setCellValue('S3', "MONDOK"); 
        $excel->setActiveSheetIndex(0)->setCellValue('T3', "JENIS PENDAFTARAN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('U3', "LEMBAGA PENDIDIKAN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('V3', "STATUS PENDIDIKAN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('W3', "UKURAN SERAGAM"); 
		$excel->setActiveSheetIndex(0)->setCellValue('X3', "NO TELP"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Y3', "NAMA AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Z3', "AGAMA AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AA3', "PEKERJAAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AB3', "TELP AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AC3', "PENDIDIKAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AD3', "PENGHASILAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AE3', "NAMA IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AF3', "AGAMA IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AG3', "PEKERJAAN IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AH3', "TELP IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AI3', "PENDIDIKAN IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AJ3', "PENGHASILAN IBU"); 
		
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('P3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Q3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('R3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('S3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('T3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('U3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('V3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('W3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('X3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Y3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Z3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AA3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AB3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AC3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AD3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AE3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AF3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AG3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AH3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AI3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AJ3')->applyFromArray($style_col);
	

		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $nama="Ma'had Aly Raudlatul Ulum";
        $santri = $this->santri_model->salaf($nama);
		

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($santri as $data){ // Lakukan looping pada variabel siswa
			
			$ayah =$this->santri_model->read_ayah($data->no_reg,"Ayah Kandung");
			$ibu =$this->santri_model->read_ibu($data->no_reg, "Ibu Kandung");
			if ($ayah->num_rows() > 0) {
				foreach ($ayah->result_object() as $y) {
					$ayahnama=$y->nama;
					$ayahagama=$y->agama;
					$ayahpekerjaan=$y->pekerjaan;
					$ayahtlp=$y->no_tel;
					$pendidikanayah=$y->pendidikan_terakhir;
					$penghasilanayah=$y->penghasilan;

				}

			   } else {
					$ayahnama="";
					$ayahagama="";
					$ayahpekerjaan="";
					$ayahtlp="";
					$pendidikanayah="";
					$penghasilanayah="";
			   }

			   if ($ibu->num_rows() > 0) {
				foreach ($ibu->result_object() as $yi) {
					$ibunama=$yi->nama;
					$ibuagama=$yi->agama;
					$ibupekerjaan=$yi->pekerjaan;
					$ibutlp=$yi->no_tel;
					$pendidikanibu=$yi->pendidikan_terakhir;
					$penghasilanibu=$yi->penghasilan;

				}

			   } else {
					$ibunama="";
					$ibuagama="";
					$ibupekerjaan="";
					$ibutlp="";
					$pendidikanibu="";
					$penghasilanibu="";
			   }

			
            $provinsi = $this->santri_model->provinsi($data->provinsi);
            $kabupaten = $this->santri_model->kabupaten($data->kabupaten);
            $kecamatan = $this->santri_model->kecamatan($data->kecamatan);
			$desa = $this->santri_model->desa($data->desa);
			
			if ($data->provinsi=="") {
				$prov= "Data Provinsi Belum diisi";
			} else {
				$prov=$provinsi->nama;
			}

			if ($data->kabupaten=="") {
				$kab= "Data Kabupaten Belum diisi";
			} else {
				$kab=$kabupaten->nama;
			}

			if ($data->kecamatan=="") {
				$kec= "Data Kecamatan Belum diisi";
			} else {
				$kec=$kecamatan->nama;
			}

			if ($data->desa=="") {
				$des= "Data Desa Belum diisi";
			} else {
				$des=$desa->nama;
			}
			
        
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->no_reg);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, "'".$data->nomer_kk);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, "'".$data->nik);
            $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->nama_lengkap);
            $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, ucwords($data->jenis_kelamin));
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->tempat_lahir);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->tanggal_lahir);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->anak_ke);
            $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->dari_saudara);
            $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->tinggal_bersama);
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data->pendidikan_terakhir);
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $prov);
			$excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $kab);
            $excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $kec);
            $excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $des);
			$excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $data->alamat_detail);
			$excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, $data->kode_pos);
			$excel->setActiveSheetIndex(0)->setCellValue('S'.$numrow, $data->mondok);
            $excel->setActiveSheetIndex(0)->setCellValue('T'.$numrow, $data->jenis_pendaftaran);
            $excel->setActiveSheetIndex(0)->setCellValue('U'.$numrow, $data->lembaga_pendidikan);
			$excel->setActiveSheetIndex(0)->setCellValue('V'.$numrow, $data->status_pendidikan);
			$excel->setActiveSheetIndex(0)->setCellValue('W'.$numrow, $data->ukuran_seragam);
			$excel->setActiveSheetIndex(0)->setCellValue('X'.$numrow, $data->no_telp);
			$excel->setActiveSheetIndex(0)->setCellValue('Y'.$numrow, $ayahnama);
			$excel->setActiveSheetIndex(0)->setCellValue('Z'.$numrow, $ayahagama);
			$excel->setActiveSheetIndex(0)->setCellValue('AA'.$numrow, $ayahpekerjaan);
			$excel->setActiveSheetIndex(0)->setCellValue('AB'.$numrow, $ayahtlp);
			$excel->setActiveSheetIndex(0)->setCellValue('AC'.$numrow, $pendidikanayah);
			$excel->setActiveSheetIndex(0)->setCellValue('AD'.$numrow, $penghasilanayah);
			$excel->setActiveSheetIndex(0)->setCellValue('AE'.$numrow, $ibunama);
			$excel->setActiveSheetIndex(0)->setCellValue('AF'.$numrow, $ibuagama);
			$excel->setActiveSheetIndex(0)->setCellValue('AG'.$numrow, $ibupekerjaan);
			$excel->setActiveSheetIndex(0)->setCellValue('AH'.$numrow, $ibutlp);
			$excel->setActiveSheetIndex(0)->setCellValue('AI'.$numrow, $pendidikanibu);
			$excel->setActiveSheetIndex(0)->setCellValue('AJ'.$numrow, $penghasilanibu);
		
			
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Q'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('R'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('S'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('T'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('U'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('V'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('W'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('X'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Y'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Z'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AA'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AB'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AC'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AD'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AE'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AF'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AG'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AH'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AI'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AJ'.$numrow)->applyFromArray($style_row);
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(10); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(20); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(25); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(18); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(18); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('O')->setWidth(18); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('P')->setWidth(18); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(35); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('R')->setWidth(10); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('S')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('T')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('U')->setWidth(35); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('V')->setWidth(35); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('W')->setWidth(20); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('X')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('Y')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('Z')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AA')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AB')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AC')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AD')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AE')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AF')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AG')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AH')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AI')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AJ')->setWidth(20); // Set width kolom D
			
		
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Laporan Data Pendaftar Santri");
		$excel->setActiveSheetIndex(0);

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Pendaftar Santri Mahad Aly Raudlatul Ulum'.time().'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
    }
    public function laporansalafulya(){
        // Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();

		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
							   ->setLastModifiedBy('My Notes Code')
							   ->setTitle("Data Santri")
							   ->setSubject("Santri")
							   ->setDescription("Laporan Semua Data Santri")
							   ->setKeywords("Data Santri");

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "Laporan Pendaftar Pendidikan Diniyah Formal Raudlatul Ulum Tingkat Ulya 2021-2022 TANGGAL DOWNLOAD ".date('d-m-Y')); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:X1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "NO REGISTER"); 
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "NOMOR KK"); 
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "NIK"); 
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "NAMA LENGKAP"); 
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "JENIS KELAMIN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "TEMPAT LAHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('H3', "TANGGAL LAHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('I3', "ANAK KE"); 
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "DARI SAUDARA"); 
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "TINGGAL BERSAMA"); 
		$excel->setActiveSheetIndex(0)->setCellValue('L3', "PENDIDIKAN TERAKHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('M3', "PROVINSI"); 
		$excel->setActiveSheetIndex(0)->setCellValue('N3', "KABUPATEN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('O3', "KECAMATAN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('P3', "DESA"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Q3', "ALAMAT LENGKAP"); 
		$excel->setActiveSheetIndex(0)->setCellValue('R3', "KODE POS"); 
		$excel->setActiveSheetIndex(0)->setCellValue('S3', "MONDOK"); 
        $excel->setActiveSheetIndex(0)->setCellValue('T3', "JENIS PENDAFTARAN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('U3', "LEMBAGA PENDIDIKAN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('V3', "STATUS PENDIDIKAN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('W3', "UKURAN SERAGAM"); 
		$excel->setActiveSheetIndex(0)->setCellValue('X3', "NO TELP"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Y3', "NAMA AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Z3', "AGAMA AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AA3', "PEKERJAAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AB3', "TELP AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AC3', "PENDIDIKAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AD3', "PENGHASILAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AE3', "NAMA IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AF3', "AGAMA IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AG3', "PEKERJAAN IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AH3', "TELP IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AI3', "PENDIDIKAN IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AJ3', "PENGHASILAN IBU"); 
		
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('P3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Q3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('R3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('S3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('T3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('U3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('V3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('W3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('X3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Y3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Z3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AA3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AB3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AC3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AD3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AE3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AF3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AG3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AH3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AI3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AJ3')->applyFromArray($style_col);
	

		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		$nama="Pendidikan Diniyah Formal Raudlatul Ulum Tingkat Ulya";
        $santri = $this->santri_model->salaf($nama);
        
		

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($santri as $data){ // Lakukan looping pada variabel siswa
			
			$ayah =$this->santri_model->read_ayah($data->no_reg,"Ayah Kandung");
			$ibu =$this->santri_model->read_ibu($data->no_reg, "Ibu Kandung");
			if ($ayah->num_rows() > 0) {
				foreach ($ayah->result_object() as $y) {
					$ayahnama=$y->nama;
					$ayahagama=$y->agama;
					$ayahpekerjaan=$y->pekerjaan;
					$ayahtlp=$y->no_tel;
					$pendidikanayah=$y->pendidikan_terakhir;
					$penghasilanayah=$y->penghasilan;

				}

			   } else {
					$ayahnama="";
					$ayahagama="";
					$ayahpekerjaan="";
					$ayahtlp="";
					$pendidikanayah="";
					$penghasilanayah="";
			   }

			   if ($ibu->num_rows() > 0) {
				foreach ($ibu->result_object() as $yi) {
					$ibunama=$yi->nama;
					$ibuagama=$yi->agama;
					$ibupekerjaan=$yi->pekerjaan;
					$ibutlp=$yi->no_tel;
					$pendidikanibu=$yi->pendidikan_terakhir;
					$penghasilanibu=$yi->penghasilan;

				}

			   } else {
					$ibunama="";
					$ibuagama="";
					$ibupekerjaan="";
					$ibutlp="";
					$pendidikanibu="";
					$penghasilanibu="";
			   }

			
            $provinsi = $this->santri_model->provinsi($data->provinsi);
            $kabupaten = $this->santri_model->kabupaten($data->kabupaten);
            $kecamatan = $this->santri_model->kecamatan($data->kecamatan);
			$desa = $this->santri_model->desa($data->desa);
			
			if ($data->provinsi=="") {
				$prov= "Data Provinsi Belum diisi";
			} else {
				$prov=$provinsi->nama;
			}

			if ($data->kabupaten=="") {
				$kab= "Data Kabupaten Belum diisi";
			} else {
				$kab=$kabupaten->nama;
			}

			if ($data->kecamatan=="") {
				$kec= "Data Kecamatan Belum diisi";
			} else {
				$kec=$kecamatan->nama;
			}

			if ($data->desa=="") {
				$des= "Data Desa Belum diisi";
			} else {
				$des=$desa->nama;
			}
			
        
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->no_reg);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, "'".$data->nomer_kk);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, "'".$data->nik);
            $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->nama_lengkap);
            $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, ucwords($data->jenis_kelamin));
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->tempat_lahir);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->tanggal_lahir);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->anak_ke);
            $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->dari_saudara);
            $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->tinggal_bersama);
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data->pendidikan_terakhir);
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $prov);
			$excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $kab);
            $excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $kec);
            $excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $des);
			$excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $data->alamat_detail);
			$excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, $data->kode_pos);
			$excel->setActiveSheetIndex(0)->setCellValue('S'.$numrow, $data->mondok);
            $excel->setActiveSheetIndex(0)->setCellValue('T'.$numrow, $data->jenis_pendaftaran);
            $excel->setActiveSheetIndex(0)->setCellValue('U'.$numrow, $data->lembaga_pendidikan);
			$excel->setActiveSheetIndex(0)->setCellValue('V'.$numrow, $data->status_pendidikan);
			$excel->setActiveSheetIndex(0)->setCellValue('W'.$numrow, $data->ukuran_seragam);
			$excel->setActiveSheetIndex(0)->setCellValue('X'.$numrow, $data->no_telp);
			$excel->setActiveSheetIndex(0)->setCellValue('Y'.$numrow, $ayahnama);
			$excel->setActiveSheetIndex(0)->setCellValue('Z'.$numrow, $ayahagama);
			$excel->setActiveSheetIndex(0)->setCellValue('AA'.$numrow, $ayahpekerjaan);
			$excel->setActiveSheetIndex(0)->setCellValue('AB'.$numrow, $ayahtlp);
			$excel->setActiveSheetIndex(0)->setCellValue('AC'.$numrow, $pendidikanayah);
			$excel->setActiveSheetIndex(0)->setCellValue('AD'.$numrow, $penghasilanayah);
			$excel->setActiveSheetIndex(0)->setCellValue('AE'.$numrow, $ibunama);
			$excel->setActiveSheetIndex(0)->setCellValue('AF'.$numrow, $ibuagama);
			$excel->setActiveSheetIndex(0)->setCellValue('AG'.$numrow, $ibupekerjaan);
			$excel->setActiveSheetIndex(0)->setCellValue('AH'.$numrow, $ibutlp);
			$excel->setActiveSheetIndex(0)->setCellValue('AI'.$numrow, $pendidikanibu);
			$excel->setActiveSheetIndex(0)->setCellValue('AJ'.$numrow, $penghasilanibu);
		
			
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Q'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('R'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('S'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('T'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('U'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('V'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('W'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('X'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Y'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Z'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AA'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AB'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AC'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AD'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AE'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AF'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AG'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AH'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AI'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AJ'.$numrow)->applyFromArray($style_row);
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(10); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(20); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(25); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(18); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(18); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('O')->setWidth(18); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('P')->setWidth(18); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(35); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('R')->setWidth(10); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('S')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('T')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('U')->setWidth(35); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('V')->setWidth(35); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('W')->setWidth(20); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('X')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('Y')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('Z')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AA')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AB')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AC')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AD')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AE')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AF')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AG')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AH')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AI')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AJ')->setWidth(20); // Set width kolom D
		
		
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Laporan Data Pendaftar Santri");
		$excel->setActiveSheetIndex(0);

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Pendaftar Santri Pendidikan Diniyah Formal Raudlatul Ulum Tingkat Ulya'.time().'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
    }
    public function laporanformalma(){
        // Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();

		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
							   ->setLastModifiedBy('My Notes Code')
							   ->setTitle("Data Santri")
							   ->setSubject("Santri")
							   ->setDescription("Laporan Semua Data Santri")
							   ->setKeywords("Data Santri");

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "Laporan Pendaftar MA Raudlatul Ulum 202012022 TANGGAL DOWNLOAD ".date('d-m-Y')); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:X1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "NO REGISTER"); 
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "NOMOR KK"); 
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "NIK"); 
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "NAMA LENGKAP"); 
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "JENIS KELAMIN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "TEMPAT LAHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('H3', "TANGGAL LAHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('I3', "ANAK KE"); 
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "DARI SAUDARA"); 
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "TINGGAL BERSAMA"); 
		$excel->setActiveSheetIndex(0)->setCellValue('L3', "PENDIDIKAN TERAKHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('M3', "PROVINSI"); 
		$excel->setActiveSheetIndex(0)->setCellValue('N3', "KABUPATEN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('O3', "KECAMATAN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('P3', "DESA"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Q3', "ALAMAT LENGKAP"); 
		$excel->setActiveSheetIndex(0)->setCellValue('R3', "KODE POS"); 
		$excel->setActiveSheetIndex(0)->setCellValue('S3', "MONDOK"); 
        $excel->setActiveSheetIndex(0)->setCellValue('T3', "JENIS PENDAFTARAN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('U3', "LEMBAGA PENDIDIKAN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('V3', "STATUS PENDIDIKAN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('W3', "UKURAN SERAGAM"); 
		$excel->setActiveSheetIndex(0)->setCellValue('X3', "NO TELP"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Y3', "NAMA AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Z3', "AGAMA AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AA3', "PEKERJAAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AB3', "TELP AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AC3', "PENDIDIKAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AD3', "PENGHASILAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AE3', "NAMA IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AF3', "AGAMA IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AG3', "PEKERJAAN IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AH3', "TELP IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AI3', "PENDIDIKAN IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AJ3', "PENGHASILAN IBU"); 
		
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('P3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Q3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('R3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('S3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('T3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('U3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('V3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('W3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('X3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Y3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Z3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AA3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AB3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AC3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AD3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AE3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AF3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AG3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AH3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AI3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AJ3')->applyFromArray($style_col);
	

		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $nama="MA Raudlatul Ulum";
        $santri = $this->santri_model->formal($nama);
		

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($santri as $data){ // Lakukan looping pada variabel siswa
			
			$ayah =$this->santri_model->read_ayah($data->no_reg,"Ayah Kandung");
			$ibu =$this->santri_model->read_ibu($data->no_reg, "Ibu Kandung");
			if ($ayah->num_rows() > 0) {
				foreach ($ayah->result_object() as $y) {
					$ayahnama=$y->nama;
					$ayahagama=$y->agama;
					$ayahpekerjaan=$y->pekerjaan;
					$ayahtlp=$y->no_tel;
					$pendidikanayah=$y->pendidikan_terakhir;
					$penghasilanayah=$y->penghasilan;

				}

			   } else {
					$ayahnama="";
					$ayahagama="";
					$ayahpekerjaan="";
					$ayahtlp="";
					$pendidikanayah="";
					$penghasilanayah="";
			   }

			   if ($ibu->num_rows() > 0) {
				foreach ($ibu->result_object() as $yi) {
					$ibunama=$yi->nama;
					$ibuagama=$yi->agama;
					$ibupekerjaan=$yi->pekerjaan;
					$ibutlp=$yi->no_tel;
					$pendidikanibu=$yi->pendidikan_terakhir;
					$penghasilanibu=$yi->penghasilan;

				}

			   } else {
					$ibunama="";
					$ibuagama="";
					$ibupekerjaan="";
					$ibutlp="";
					$pendidikanibu="";
					$penghasilanibu="";
			   }

			
            $provinsi = $this->santri_model->provinsi($data->provinsi);
            $kabupaten = $this->santri_model->kabupaten($data->kabupaten);
            $kecamatan = $this->santri_model->kecamatan($data->kecamatan);
			$desa = $this->santri_model->desa($data->desa);
			
			if ($data->provinsi=="") {
				$prov= "Data Provinsi Belum diisi";
			} else {
				$prov=$provinsi->nama;
			}

			if ($data->kabupaten=="") {
				$kab= "Data Kabupaten Belum diisi";
			} else {
				$kab=$kabupaten->nama;
			}

			if ($data->kecamatan=="") {
				$kec= "Data Kecamatan Belum diisi";
			} else {
				$kec=$kecamatan->nama;
			}

			if ($data->desa=="") {
				$des= "Data Desa Belum diisi";
			} else {
				$des=$desa->nama;
			}
			
        
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->no_reg);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, "'".$data->nomer_kk);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, "'".$data->nik);
            $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->nama_lengkap);
            $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, ucwords($data->jenis_kelamin));
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->tempat_lahir);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->tanggal_lahir);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->anak_ke);
            $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->dari_saudara);
            $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->tinggal_bersama);
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data->pendidikan_terakhir);
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $prov);
			$excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $kab);
            $excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $kec);
            $excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $des);
			$excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $data->alamat_detail);
			$excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, $data->kode_pos);
			$excel->setActiveSheetIndex(0)->setCellValue('S'.$numrow, $data->mondok);
            $excel->setActiveSheetIndex(0)->setCellValue('T'.$numrow, $data->jenis_pendaftaran);
            $excel->setActiveSheetIndex(0)->setCellValue('U'.$numrow, $data->lembaga_pendidikan);
			$excel->setActiveSheetIndex(0)->setCellValue('V'.$numrow, $data->status_pendidikan);
			$excel->setActiveSheetIndex(0)->setCellValue('W'.$numrow, $data->ukuran_seragam);
			$excel->setActiveSheetIndex(0)->setCellValue('X'.$numrow, $data->no_telp);
			$excel->setActiveSheetIndex(0)->setCellValue('Y'.$numrow, $ayahnama);
			$excel->setActiveSheetIndex(0)->setCellValue('Z'.$numrow, $ayahagama);
			$excel->setActiveSheetIndex(0)->setCellValue('AA'.$numrow, $ayahpekerjaan);
			$excel->setActiveSheetIndex(0)->setCellValue('AB'.$numrow, $ayahtlp);
			$excel->setActiveSheetIndex(0)->setCellValue('AC'.$numrow, $pendidikanayah);
			$excel->setActiveSheetIndex(0)->setCellValue('AD'.$numrow, $penghasilanayah);
			$excel->setActiveSheetIndex(0)->setCellValue('AE'.$numrow, $ibunama);
			$excel->setActiveSheetIndex(0)->setCellValue('AF'.$numrow, $ibuagama);
			$excel->setActiveSheetIndex(0)->setCellValue('AG'.$numrow, $ibupekerjaan);
			$excel->setActiveSheetIndex(0)->setCellValue('AH'.$numrow, $ibutlp);
			$excel->setActiveSheetIndex(0)->setCellValue('AI'.$numrow, $pendidikanibu);
			$excel->setActiveSheetIndex(0)->setCellValue('AJ'.$numrow, $penghasilanibu);
		
			
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Q'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('R'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('S'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('T'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('U'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('V'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('W'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('X'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Y'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Z'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AA'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AB'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AC'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AD'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AE'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AF'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AG'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AH'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AI'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AJ'.$numrow)->applyFromArray($style_row);
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(10); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(20); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(25); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(18); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(18); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('O')->setWidth(18); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('P')->setWidth(18); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(35); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('R')->setWidth(10); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('S')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('T')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('U')->setWidth(35); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('V')->setWidth(35); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('W')->setWidth(20); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('X')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('Y')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('Z')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AA')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AB')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AC')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AD')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AE')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AF')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AG')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AH')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AI')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AJ')->setWidth(20); // Set width kolom D
		
		
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Laporan Data Pendaftar Santri");
		$excel->setActiveSheetIndex(0);

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Pendaftar MA Raudlatul Ulum'.time().'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
    }

    public function laporanformalmts(){
        // Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();

		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
							   ->setLastModifiedBy('My Notes Code')
							   ->setTitle("Data Santri")
							   ->setSubject("Santri")
							   ->setDescription("Laporan Semua Data Santri")
							   ->setKeywords("Data Santri");

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "Laporan Pendaftar MTS Raudlatul Ulum 2021-2022 TANGGAL DOWNLOAD ".date('d-m-Y')); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:X1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "NO REGISTER"); 
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "NOMOR KK"); 
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "NIK"); 
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "NAMA LENGKAP"); 
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "JENIS KELAMIN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "TEMPAT LAHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('H3', "TANGGAL LAHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('I3', "ANAK KE"); 
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "DARI SAUDARA"); 
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "TINGGAL BERSAMA"); 
		$excel->setActiveSheetIndex(0)->setCellValue('L3', "PENDIDIKAN TERAKHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('M3', "PROVINSI"); 
		$excel->setActiveSheetIndex(0)->setCellValue('N3', "KABUPATEN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('O3', "KECAMATAN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('P3', "DESA"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Q3', "ALAMAT LENGKAP"); 
		$excel->setActiveSheetIndex(0)->setCellValue('R3', "KODE POS"); 
		$excel->setActiveSheetIndex(0)->setCellValue('S3', "MONDOK"); 
        $excel->setActiveSheetIndex(0)->setCellValue('T3', "JENIS PENDAFTARAN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('U3', "LEMBAGA PENDIDIKAN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('V3', "STATUS PENDIDIKAN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('W3', "UKURAN SERAGAM"); 
		$excel->setActiveSheetIndex(0)->setCellValue('X3', "NO TELP"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Y3', "NAMA AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Z3', "AGAMA AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AA3', "PEKERJAAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AB3', "TELP AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AC3', "PENDIDIKAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AD3', "PENGHASILAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AE3', "NAMA IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AF3', "AGAMA IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AG3', "PEKERJAAN IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AH3', "TELP IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AI3', "PENDIDIKAN IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AJ3', "PENGHASILAN IBU"); 
		
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('P3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Q3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('R3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('S3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('T3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('U3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('V3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('W3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('X3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Y3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Z3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AA3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AB3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AC3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AD3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AE3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AF3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AG3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AH3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AI3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AJ3')->applyFromArray($style_col);
	

		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		$nama="MTS Raudlatul Ulum";
        $santri = $this->santri_model->formal($nama);
		

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($santri as $data){ // Lakukan looping pada variabel siswa
			
			$ayah =$this->santri_model->read_ayah($data->no_reg,"Ayah Kandung");
			$ibu =$this->santri_model->read_ibu($data->no_reg, "Ibu Kandung");
			if ($ayah->num_rows() > 0) {
				foreach ($ayah->result_object() as $y) {
					$ayahnama=$y->nama;
					$ayahagama=$y->agama;
					$ayahpekerjaan=$y->pekerjaan;
					$ayahtlp=$y->no_tel;
					$pendidikanayah=$y->pendidikan_terakhir;
					$penghasilanayah=$y->penghasilan;

				}

			   } else {
					$ayahnama="";
					$ayahagama="";
					$ayahpekerjaan="";
					$ayahtlp="";
					$pendidikanayah="";
					$penghasilanayah="";
			   }

			   if ($ibu->num_rows() > 0) {
				foreach ($ibu->result_object() as $yi) {
					$ibunama=$yi->nama;
					$ibuagama=$yi->agama;
					$ibupekerjaan=$yi->pekerjaan;
					$ibutlp=$yi->no_tel;
					$pendidikanibu=$yi->pendidikan_terakhir;
					$penghasilanibu=$yi->penghasilan;

				}

			   } else {
					$ibunama="";
					$ibuagama="";
					$ibupekerjaan="";
					$ibutlp="";
					$pendidikanibu="";
					$penghasilanibu="";
			   }

			
            $provinsi = $this->santri_model->provinsi($data->provinsi);
            $kabupaten = $this->santri_model->kabupaten($data->kabupaten);
            $kecamatan = $this->santri_model->kecamatan($data->kecamatan);
			$desa = $this->santri_model->desa($data->desa);
			
			if ($data->provinsi=="") {
				$prov= "Data Provinsi Belum diisi";
			} else {
				$prov=$provinsi->nama;
			}

			if ($data->kabupaten=="") {
				$kab= "Data Kabupaten Belum diisi";
			} else {
				$kab=$kabupaten->nama;
			}

			if ($data->kecamatan=="") {
				$kec= "Data Kecamatan Belum diisi";
			} else {
				$kec=$kecamatan->nama;
			}

			if ($data->desa=="") {
				$des= "Data Desa Belum diisi";
			} else {
				$des=$desa->nama;
			}
			
        
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->no_reg);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, "'".$data->nomer_kk);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, "'".$data->nik);
            $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->nama_lengkap);
            $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, ucwords($data->jenis_kelamin));
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->tempat_lahir);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->tanggal_lahir);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->anak_ke);
            $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->dari_saudara);
            $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->tinggal_bersama);
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data->pendidikan_terakhir);
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $prov);
			$excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $kab);
            $excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $kec);
            $excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $des);
			$excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $data->alamat_detail);
			$excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, $data->kode_pos);
			$excel->setActiveSheetIndex(0)->setCellValue('S'.$numrow, $data->mondok);
            $excel->setActiveSheetIndex(0)->setCellValue('T'.$numrow, $data->jenis_pendaftaran);
            $excel->setActiveSheetIndex(0)->setCellValue('U'.$numrow, $data->lembaga_pendidikan);
			$excel->setActiveSheetIndex(0)->setCellValue('V'.$numrow, $data->status_pendidikan);
			$excel->setActiveSheetIndex(0)->setCellValue('W'.$numrow, $data->ukuran_seragam);
			$excel->setActiveSheetIndex(0)->setCellValue('X'.$numrow, $data->no_telp);
			$excel->setActiveSheetIndex(0)->setCellValue('Y'.$numrow, $ayahnama);
			$excel->setActiveSheetIndex(0)->setCellValue('Z'.$numrow, $ayahagama);
			$excel->setActiveSheetIndex(0)->setCellValue('AA'.$numrow, $ayahpekerjaan);
			$excel->setActiveSheetIndex(0)->setCellValue('AB'.$numrow, $ayahtlp);
			$excel->setActiveSheetIndex(0)->setCellValue('AC'.$numrow, $pendidikanayah);
			$excel->setActiveSheetIndex(0)->setCellValue('AD'.$numrow, $penghasilanayah);
			$excel->setActiveSheetIndex(0)->setCellValue('AE'.$numrow, $ibunama);
			$excel->setActiveSheetIndex(0)->setCellValue('AF'.$numrow, $ibuagama);
			$excel->setActiveSheetIndex(0)->setCellValue('AG'.$numrow, $ibupekerjaan);
			$excel->setActiveSheetIndex(0)->setCellValue('AH'.$numrow, $ibutlp);
			$excel->setActiveSheetIndex(0)->setCellValue('AI'.$numrow, $pendidikanibu);
			$excel->setActiveSheetIndex(0)->setCellValue('AJ'.$numrow, $penghasilanibu);
		
			
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Q'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('R'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('S'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('T'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('U'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('V'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('W'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('X'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Y'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Z'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AA'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AB'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AC'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AD'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AE'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AF'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AG'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AH'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AI'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AJ'.$numrow)->applyFromArray($style_row);
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(10); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(20); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(25); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(18); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(18); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('O')->setWidth(18); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('P')->setWidth(18); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(35); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('R')->setWidth(10); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('S')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('T')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('U')->setWidth(35); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('V')->setWidth(35); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('W')->setWidth(20); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('X')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('Y')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('Z')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AA')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AB')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AC')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AD')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AE')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AF')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AG')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AH')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AI')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AJ')->setWidth(20); // Set width kolom D
		
		
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Laporan Data Pendaftar Santri");
		$excel->setActiveSheetIndex(0);

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Pendaftar MTS Raudlatul Ulum'.time().'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
    }

    public function laporanformalmi(){
        // Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();

		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
							   ->setLastModifiedBy('My Notes Code')
							   ->setTitle("Data Santri")
							   ->setSubject("Santri")
							   ->setDescription("Laporan Semua Data Santri")
							   ->setKeywords("Data Santri");

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "Laporan Pendaftar MI Raudlatul Ulum 2021-2022 TANGGAL DOWNLOAD ".date('d-m-Y')); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:X1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "NO REGISTER"); 
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "NOMOR KK"); 
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "NIK"); 
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "NAMA LENGKAP"); 
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "JENIS KELAMIN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "TEMPAT LAHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('H3', "TANGGAL LAHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('I3', "ANAK KE"); 
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "DARI SAUDARA"); 
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "TINGGAL BERSAMA"); 
		$excel->setActiveSheetIndex(0)->setCellValue('L3', "PENDIDIKAN TERAKHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('M3', "PROVINSI"); 
		$excel->setActiveSheetIndex(0)->setCellValue('N3', "KABUPATEN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('O3', "KECAMATAN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('P3', "DESA"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Q3', "ALAMAT LENGKAP"); 
		$excel->setActiveSheetIndex(0)->setCellValue('R3', "KODE POS"); 
		$excel->setActiveSheetIndex(0)->setCellValue('S3', "MONDOK"); 
        $excel->setActiveSheetIndex(0)->setCellValue('T3', "JENIS PENDAFTARAN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('U3', "LEMBAGA PENDIDIKAN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('V3', "STATUS PENDIDIKAN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('W3', "UKURAN SERAGAM"); 
		$excel->setActiveSheetIndex(0)->setCellValue('X3', "NO TELP"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Y3', "NAMA AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Z3', "AGAMA AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AA3', "PEKERJAAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AB3', "TELP AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AC3', "PENDIDIKAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AD3', "PENGHASILAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AE3', "NAMA IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AF3', "AGAMA IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AG3', "PEKERJAAN IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AH3', "TELP IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AI3', "PENDIDIKAN IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AJ3', "PENGHASILAN IBU"); 
		
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('P3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Q3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('R3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('S3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('T3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('U3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('V3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('W3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('X3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Y3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Z3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AA3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AB3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AC3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AD3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AE3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AF3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AG3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AH3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AI3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AJ3')->applyFromArray($style_col);
	

		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $nama="MI Raudlatul Ulum";
        $santri = $this->santri_model->formal($nama);
		

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($santri as $data){ // Lakukan looping pada variabel siswa
			
			$ayah =$this->santri_model->read_ayah($data->no_reg,"Ayah Kandung");
			$ibu =$this->santri_model->read_ibu($data->no_reg, "Ibu Kandung");
			if ($ayah->num_rows() > 0) {
				foreach ($ayah->result_object() as $y) {
					$ayahnama=$y->nama;
					$ayahagama=$y->agama;
					$ayahpekerjaan=$y->pekerjaan;
					$ayahtlp=$y->no_tel;
					$pendidikanayah=$y->pendidikan_terakhir;
					$penghasilanayah=$y->penghasilan;

				}

			   } else {
					$ayahnama="";
					$ayahagama="";
					$ayahpekerjaan="";
					$ayahtlp="";
					$pendidikanayah="";
					$penghasilanayah="";
			   }

			   if ($ibu->num_rows() > 0) {
				foreach ($ibu->result_object() as $yi) {
					$ibunama=$yi->nama;
					$ibuagama=$yi->agama;
					$ibupekerjaan=$yi->pekerjaan;
					$ibutlp=$yi->no_tel;
					$pendidikanibu=$yi->pendidikan_terakhir;
					$penghasilanibu=$yi->penghasilan;

				}

			   } else {
					$ibunama="";
					$ibuagama="";
					$ibupekerjaan="";
					$ibutlp="";
					$pendidikanibu="";
					$penghasilanibu="";
			   }

			
            $provinsi = $this->santri_model->provinsi($data->provinsi);
            $kabupaten = $this->santri_model->kabupaten($data->kabupaten);
            $kecamatan = $this->santri_model->kecamatan($data->kecamatan);
			$desa = $this->santri_model->desa($data->desa);
			
			if ($data->provinsi=="") {
				$prov= "Data Provinsi Belum diisi";
			} else {
				$prov=$provinsi->nama;
			}

			if ($data->kabupaten=="") {
				$kab= "Data Kabupaten Belum diisi";
			} else {
				$kab=$kabupaten->nama;
			}

			if ($data->kecamatan=="") {
				$kec= "Data Kecamatan Belum diisi";
			} else {
				$kec=$kecamatan->nama;
			}

			if ($data->desa=="") {
				$des= "Data Desa Belum diisi";
			} else {
				$des=$desa->nama;
			}
			
        
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->no_reg);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, "'".$data->nomer_kk);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, "'".$data->nik);
            $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->nama_lengkap);
            $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, ucwords($data->jenis_kelamin));
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->tempat_lahir);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->tanggal_lahir);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->anak_ke);
            $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->dari_saudara);
            $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->tinggal_bersama);
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data->pendidikan_terakhir);
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $prov);
			$excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $kab);
            $excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $kec);
            $excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $des);
			$excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $data->alamat_detail);
			$excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, $data->kode_pos);
			$excel->setActiveSheetIndex(0)->setCellValue('S'.$numrow, $data->mondok);
            $excel->setActiveSheetIndex(0)->setCellValue('T'.$numrow, $data->jenis_pendaftaran);
            $excel->setActiveSheetIndex(0)->setCellValue('U'.$numrow, $data->lembaga_pendidikan);
			$excel->setActiveSheetIndex(0)->setCellValue('V'.$numrow, $data->status_pendidikan);
			$excel->setActiveSheetIndex(0)->setCellValue('W'.$numrow, $data->ukuran_seragam);
			$excel->setActiveSheetIndex(0)->setCellValue('X'.$numrow, $data->no_telp);
			$excel->setActiveSheetIndex(0)->setCellValue('Y'.$numrow, $ayahnama);
			$excel->setActiveSheetIndex(0)->setCellValue('Z'.$numrow, $ayahagama);
			$excel->setActiveSheetIndex(0)->setCellValue('AA'.$numrow, $ayahpekerjaan);
			$excel->setActiveSheetIndex(0)->setCellValue('AB'.$numrow, $ayahtlp);
			$excel->setActiveSheetIndex(0)->setCellValue('AC'.$numrow, $pendidikanayah);
			$excel->setActiveSheetIndex(0)->setCellValue('AD'.$numrow, $penghasilanayah);
			$excel->setActiveSheetIndex(0)->setCellValue('AE'.$numrow, $ibunama);
			$excel->setActiveSheetIndex(0)->setCellValue('AF'.$numrow, $ibuagama);
			$excel->setActiveSheetIndex(0)->setCellValue('AG'.$numrow, $ibupekerjaan);
			$excel->setActiveSheetIndex(0)->setCellValue('AH'.$numrow, $ibutlp);
			$excel->setActiveSheetIndex(0)->setCellValue('AI'.$numrow, $pendidikanibu);
			$excel->setActiveSheetIndex(0)->setCellValue('AJ'.$numrow, $penghasilanibu);
		
			
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Q'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('R'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('S'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('T'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('U'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('V'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('W'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('X'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Y'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Z'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AA'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AB'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AC'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AD'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AE'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AF'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AG'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AH'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AI'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AJ'.$numrow)->applyFromArray($style_row);
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(10); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(20); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(25); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(18); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(18); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('O')->setWidth(18); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('P')->setWidth(18); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(35); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('R')->setWidth(10); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('S')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('T')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('U')->setWidth(35); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('V')->setWidth(35); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('W')->setWidth(20); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('X')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('Y')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('Z')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AA')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AB')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AC')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AD')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AE')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AF')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AG')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AH')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AI')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AJ')->setWidth(20); // Set width kolom D
		
		
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Laporan Data Pendaftar Santri");
		$excel->setActiveSheetIndex(0);

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Pendaftar MI Raudlatul Ulum'.time().'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
    }

    public function laporanformaltk(){
        // Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();

		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
							   ->setLastModifiedBy('My Notes Code')
							   ->setTitle("Data Santri")
							   ->setSubject("Santri")
							   ->setDescription("Laporan Semua Data Santri")
							   ->setKeywords("Data Santri");

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "Laporan Pendaftar TK Nurul Hasan 2020-2021 TANGGAL DOWNLOAD ".date('d-m-Y')); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:X1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "NO REGISTER"); 
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "NOMOR KK"); 
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "NIK"); 
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "NAMA LENGKAP"); 
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "JENIS KELAMIN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "TEMPAT LAHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('H3', "TANGGAL LAHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('I3', "ANAK KE"); 
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "DARI SAUDARA"); 
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "TINGGAL BERSAMA"); 
		$excel->setActiveSheetIndex(0)->setCellValue('L3', "PENDIDIKAN TERAKHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('M3', "PROVINSI"); 
		$excel->setActiveSheetIndex(0)->setCellValue('N3', "KABUPATEN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('O3', "KECAMATAN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('P3', "DESA"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Q3', "ALAMAT LENGKAP"); 
		$excel->setActiveSheetIndex(0)->setCellValue('R3', "KODE POS"); 
		$excel->setActiveSheetIndex(0)->setCellValue('S3', "MONDOK"); 
        $excel->setActiveSheetIndex(0)->setCellValue('T3', "JENIS PENDAFTARAN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('U3', "LEMBAGA PENDIDIKAN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('V3', "STATUS PENDIDIKAN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('W3', "UKURAN SERAGAM"); 
		$excel->setActiveSheetIndex(0)->setCellValue('X3', "NO TELP"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Y3', "NAMA AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Z3', "AGAMA AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AA3', "PEKERJAAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AB3', "TELP AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AC3', "PENDIDIKAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AD3', "PENGHASILAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AE3', "NAMA IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AF3', "AGAMA IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AG3', "PEKERJAAN IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AH3', "TELP IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AI3', "PENDIDIKAN IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AJ3', "PENGHASILAN IBU"); 
		
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('P3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Q3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('R3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('S3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('T3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('U3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('V3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('W3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('X3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Y3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Z3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AA3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AB3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AC3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AD3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AE3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AF3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AG3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AH3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AI3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AJ3')->applyFromArray($style_col);
	

		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		$nama="TK Nurul Hasan";
        $santri = $this->santri_model->formal($nama);
		

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($santri as $data){ // Lakukan looping pada variabel siswa
			
			$ayah =$this->santri_model->read_ayah($data->no_reg,"Ayah Kandung");
			$ibu =$this->santri_model->read_ibu($data->no_reg, "Ibu Kandung");
			if ($ayah->num_rows() > 0) {
				foreach ($ayah->result_object() as $y) {
					$ayahnama=$y->nama;
					$ayahagama=$y->agama;
					$ayahpekerjaan=$y->pekerjaan;
					$ayahtlp=$y->no_tel;
					$pendidikanayah=$y->pendidikan_terakhir;
					$penghasilanayah=$y->penghasilan;

				}

			   } else {
					$ayahnama="";
					$ayahagama="";
					$ayahpekerjaan="";
					$ayahtlp="";
					$pendidikanayah="";
					$penghasilanayah="";
			   }

			   if ($ibu->num_rows() > 0) {
				foreach ($ibu->result_object() as $yi) {
					$ibunama=$yi->nama;
					$ibuagama=$yi->agama;
					$ibupekerjaan=$yi->pekerjaan;
					$ibutlp=$yi->no_tel;
					$pendidikanibu=$yi->pendidikan_terakhir;
					$penghasilanibu=$yi->penghasilan;

				}

			   } else {
					$ibunama="";
					$ibuagama="";
					$ibupekerjaan="";
					$ibutlp="";
					$pendidikanibu="";
					$penghasilanibu="";
			   }

			
            $provinsi = $this->santri_model->provinsi($data->provinsi);
            $kabupaten = $this->santri_model->kabupaten($data->kabupaten);
            $kecamatan = $this->santri_model->kecamatan($data->kecamatan);
			$desa = $this->santri_model->desa($data->desa);
			
			if ($data->provinsi=="") {
				$prov= "Data Provinsi Belum diisi";
			} else {
				$prov=$provinsi->nama;
			}

			if ($data->kabupaten=="") {
				$kab= "Data Kabupaten Belum diisi";
			} else {
				$kab=$kabupaten->nama;
			}

			if ($data->kecamatan=="") {
				$kec= "Data Kecamatan Belum diisi";
			} else {
				$kec=$kecamatan->nama;
			}

			if ($data->desa=="") {
				$des= "Data Desa Belum diisi";
			} else {
				$des=$desa->nama;
			}
			
        
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->no_reg);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, "'".$data->nomer_kk);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, "'".$data->nik);
            $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->nama_lengkap);
            $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, ucwords($data->jenis_kelamin));
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->tempat_lahir);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->tanggal_lahir);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->anak_ke);
            $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->dari_saudara);
            $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->tinggal_bersama);
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data->pendidikan_terakhir);
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $prov);
			$excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $kab);
            $excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $kec);
            $excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $des);
			$excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $data->alamat_detail);
			$excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, $data->kode_pos);
			$excel->setActiveSheetIndex(0)->setCellValue('S'.$numrow, $data->mondok);
            $excel->setActiveSheetIndex(0)->setCellValue('T'.$numrow, $data->jenis_pendaftaran);
            $excel->setActiveSheetIndex(0)->setCellValue('U'.$numrow, $data->lembaga_pendidikan);
			$excel->setActiveSheetIndex(0)->setCellValue('V'.$numrow, $data->status_pendidikan);
			$excel->setActiveSheetIndex(0)->setCellValue('W'.$numrow, $data->ukuran_seragam);
			$excel->setActiveSheetIndex(0)->setCellValue('X'.$numrow, $data->no_telp);
			$excel->setActiveSheetIndex(0)->setCellValue('Y'.$numrow, $ayahnama);
			$excel->setActiveSheetIndex(0)->setCellValue('Z'.$numrow, $ayahagama);
			$excel->setActiveSheetIndex(0)->setCellValue('AA'.$numrow, $ayahpekerjaan);
			$excel->setActiveSheetIndex(0)->setCellValue('AB'.$numrow, $ayahtlp);
			$excel->setActiveSheetIndex(0)->setCellValue('AC'.$numrow, $pendidikanayah);
			$excel->setActiveSheetIndex(0)->setCellValue('AD'.$numrow, $penghasilanayah);
			$excel->setActiveSheetIndex(0)->setCellValue('AE'.$numrow, $ibunama);
			$excel->setActiveSheetIndex(0)->setCellValue('AF'.$numrow, $ibuagama);
			$excel->setActiveSheetIndex(0)->setCellValue('AG'.$numrow, $ibupekerjaan);
			$excel->setActiveSheetIndex(0)->setCellValue('AH'.$numrow, $ibutlp);
			$excel->setActiveSheetIndex(0)->setCellValue('AI'.$numrow, $pendidikanibu);
			$excel->setActiveSheetIndex(0)->setCellValue('AJ'.$numrow, $penghasilanibu);
		
			
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Q'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('R'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('S'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('T'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('U'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('V'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('W'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('X'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Y'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Z'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AA'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AB'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AC'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AD'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AE'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AF'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AG'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AH'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AI'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AJ'.$numrow)->applyFromArray($style_row);
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(10); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(20); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(25); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(18); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(18); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('O')->setWidth(18); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('P')->setWidth(18); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(35); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('R')->setWidth(10); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('S')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('T')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('U')->setWidth(35); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('V')->setWidth(35); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('W')->setWidth(20); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('X')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('Y')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('Z')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AA')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AB')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AC')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AD')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AE')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AF')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AG')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AH')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AI')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AJ')->setWidth(20); // Set width kolom D
		
		
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Laporan Data Pendaftar Santri");
		$excel->setActiveSheetIndex(0);

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Pendaftar TK Raudlatul Ulum'.time().'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
    }
    public function laporanformalpaud(){
        // Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();

		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
							   ->setLastModifiedBy('My Notes Code')
							   ->setTitle("Data Santri")
							   ->setSubject("Santri")
							   ->setDescription("Laporan Semua Data Santri")
							   ->setKeywords("Data Santri");

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "Laporan Pendaftar PAUD Raudlatul Ulum 2021-2022 TANGGAL DOWNLOAD ".date('d-m-Y')); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:X1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "NO REGISTER"); 
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "NOMOR KK"); 
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "NIK"); 
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "NAMA LENGKAP"); 
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "JENIS KELAMIN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "TEMPAT LAHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('H3', "TANGGAL LAHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('I3', "ANAK KE"); 
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "DARI SAUDARA"); 
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "TINGGAL BERSAMA"); 
		$excel->setActiveSheetIndex(0)->setCellValue('L3', "PENDIDIKAN TERAKHIR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('M3', "PROVINSI"); 
		$excel->setActiveSheetIndex(0)->setCellValue('N3', "KABUPATEN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('O3', "KECAMATAN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('P3', "DESA"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Q3', "ALAMAT LENGKAP"); 
		$excel->setActiveSheetIndex(0)->setCellValue('R3', "KODE POS"); 
		$excel->setActiveSheetIndex(0)->setCellValue('S3', "MONDOK"); 
        $excel->setActiveSheetIndex(0)->setCellValue('T3', "JENIS PENDAFTARAN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('U3', "LEMBAGA PENDIDIKAN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('V3', "STATUS PENDIDIKAN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('W3', "UKURAN SERAGAM"); 
		$excel->setActiveSheetIndex(0)->setCellValue('X3', "NO TELP"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Y3', "NAMA AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('Z3', "AGAMA AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AA3', "PEKERJAAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AB3', "TELP AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AC3', "PENDIDIKAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AD3', "PENGHASILAN AYAH"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AE3', "NAMA IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AF3', "AGAMA IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AG3', "PEKERJAAN IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AH3', "TELP IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AI3', "PENDIDIKAN IBU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('AJ3', "PENGHASILAN IBU"); 
		
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('P3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Q3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('R3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('S3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('T3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('U3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('V3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('W3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('X3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Y3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Z3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AA3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AB3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AC3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AD3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AE3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AF3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AG3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AH3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AI3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AJ3')->applyFromArray($style_col);
	

		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		$nama="PAUD Raudlatul Ulum";
        $santri = $this->santri_model->formal($nama);
		

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($santri as $data){ // Lakukan looping pada variabel siswa
			
			$ayah =$this->santri_model->read_ayah($data->no_reg,"Ayah Kandung");
			$ibu =$this->santri_model->read_ibu($data->no_reg, "Ibu Kandung");
			if ($ayah->num_rows() > 0) {
				foreach ($ayah->result_object() as $y) {
					$ayahnama=$y->nama;
					$ayahagama=$y->agama;
					$ayahpekerjaan=$y->pekerjaan;
					$ayahtlp=$y->no_tel;
					$pendidikanayah=$y->pendidikan_terakhir;
					$penghasilanayah=$y->penghasilan;

				}

			   } else {
					$ayahnama="";
					$ayahagama="";
					$ayahpekerjaan="";
					$ayahtlp="";
					$pendidikanayah="";
					$penghasilanayah="";
			   }

			   if ($ibu->num_rows() > 0) {
				foreach ($ibu->result_object() as $yi) {
					$ibunama=$yi->nama;
					$ibuagama=$yi->agama;
					$ibupekerjaan=$yi->pekerjaan;
					$ibutlp=$yi->no_tel;
					$pendidikanibu=$yi->pendidikan_terakhir;
					$penghasilanibu=$yi->penghasilan;

				}

			   } else {
					$ibunama="";
					$ibuagama="";
					$ibupekerjaan="";
					$ibutlp="";
					$pendidikanibu="";
					$penghasilanibu="";
			   }

			
            $provinsi = $this->santri_model->provinsi($data->provinsi);
            $kabupaten = $this->santri_model->kabupaten($data->kabupaten);
            $kecamatan = $this->santri_model->kecamatan($data->kecamatan);
			$desa = $this->santri_model->desa($data->desa);
			
			if ($data->provinsi=="") {
				$prov= "Data Provinsi Belum diisi";
			} else {
				$prov=$provinsi->nama;
			}

			if ($data->kabupaten=="") {
				$kab= "Data Kabupaten Belum diisi";
			} else {
				$kab=$kabupaten->nama;
			}

			if ($data->kecamatan=="") {
				$kec= "Data Kecamatan Belum diisi";
			} else {
				$kec=$kecamatan->nama;
			}

			if ($data->desa=="") {
				$des= "Data Desa Belum diisi";
			} else {
				$des=$desa->nama;
			}
			
        
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->no_reg);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, "'".$data->nomer_kk);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, "'".$data->nik);
            $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->nama_lengkap);
            $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, ucwords($data->jenis_kelamin));
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->tempat_lahir);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->tanggal_lahir);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->anak_ke);
            $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->dari_saudara);
            $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->tinggal_bersama);
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data->pendidikan_terakhir);
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $prov);
			$excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $kab);
            $excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $kec);
            $excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $des);
			$excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $data->alamat_detail);
			$excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, $data->kode_pos);
			$excel->setActiveSheetIndex(0)->setCellValue('S'.$numrow, $data->mondok);
            $excel->setActiveSheetIndex(0)->setCellValue('T'.$numrow, $data->jenis_pendaftaran);
            $excel->setActiveSheetIndex(0)->setCellValue('U'.$numrow, $data->lembaga_pendidikan);
			$excel->setActiveSheetIndex(0)->setCellValue('V'.$numrow, $data->status_pendidikan);
			$excel->setActiveSheetIndex(0)->setCellValue('W'.$numrow, $data->ukuran_seragam);
			$excel->setActiveSheetIndex(0)->setCellValue('X'.$numrow, $data->no_telp);
			$excel->setActiveSheetIndex(0)->setCellValue('Y'.$numrow, $ayahnama);
			$excel->setActiveSheetIndex(0)->setCellValue('Z'.$numrow, $ayahagama);
			$excel->setActiveSheetIndex(0)->setCellValue('AA'.$numrow, $ayahpekerjaan);
			$excel->setActiveSheetIndex(0)->setCellValue('AB'.$numrow, $ayahtlp);
			$excel->setActiveSheetIndex(0)->setCellValue('AC'.$numrow, $pendidikanayah);
			$excel->setActiveSheetIndex(0)->setCellValue('AD'.$numrow, $penghasilanayah);
			$excel->setActiveSheetIndex(0)->setCellValue('AE'.$numrow, $ibunama);
			$excel->setActiveSheetIndex(0)->setCellValue('AF'.$numrow, $ibuagama);
			$excel->setActiveSheetIndex(0)->setCellValue('AG'.$numrow, $ibupekerjaan);
			$excel->setActiveSheetIndex(0)->setCellValue('AH'.$numrow, $ibutlp);
			$excel->setActiveSheetIndex(0)->setCellValue('AI'.$numrow, $pendidikanibu);
			$excel->setActiveSheetIndex(0)->setCellValue('AJ'.$numrow, $penghasilanibu);
		
			
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Q'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('R'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('S'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('T'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('U'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('V'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('W'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('X'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Y'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Z'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AA'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AB'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AC'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AD'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AE'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AF'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AG'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AH'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AI'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AJ'.$numrow)->applyFromArray($style_row);
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(10); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(20); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(25); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(18); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(18); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('O')->setWidth(18); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('P')->setWidth(18); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(35); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('R')->setWidth(10); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('S')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('T')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('U')->setWidth(35); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('V')->setWidth(35); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('W')->setWidth(20); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('X')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('Y')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('Z')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AA')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AB')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AC')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AD')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AE')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AF')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AG')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AH')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AI')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('AJ')->setWidth(20); // Set width kolom D
		
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Laporan Data Pendaftar Santri");
		$excel->setActiveSheetIndex(0);

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Pendaftar PAUD Raudlatul Ulum'.time().'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
    }
    public function data_santri(){
        $data['jumlah_santri'] = $this->santri_model->jumlah_santri()->num_rows();
        $data['perempuan'] = $this->santri_model->perempuan()->num_rows();
        $data['laki'] = $this->santri_model->laki()->num_rows();
        $data['santri'] = $this->santri_model->get_san()->result();
        $this->load->view('admin/santri', $data);
    }
    public function hapus_santri($id){
        
        $this->santri_model->delete_santri($id);
        $this->session->set_flashdata('berhasil', '<script>swal("Berhasil !", "Data Telah dihapus !", "success")</script>');
        redirect('admin_control_panel/data_santri');
    }

    public function detail($id){
        $data['berkas'] = $this->santri_model->get_berkas($id)->result();
        $data['wali'] = $this->santri_model->get_wali($id)->result();
        $data['jumlah_santri'] = $this->santri_model->jumlah_santri()->num_rows();
        $data['perempuan'] = $this->santri_model->perempuan()->num_rows();
        $data['laki'] = $this->santri_model->laki()->num_rows();
        $data['santri'] = $this->santri_model->get_sanid($id)->row_array();
        $this->load->view('admin/detail_santri', $data);
    }
    public function edit($id){
        $data['jumlah_santri'] = $this->santri_model->jumlah_santri()->num_rows();
        $data['perempuan'] = $this->santri_model->perempuan()->num_rows();
        $data['laki'] = $this->santri_model->laki()->num_rows();
        $data['santri'] = $this->santri_model->get_sanid($id)->row_array();

        $data['berkas'] = $this->santri_model->get_berkas($id)->result();
        $data['jumlah'] = $this->santri_model->get_berkas($id)->num_rows();

        
        $this->load->view('admin/edit_santri', $data);
    }
    public function foto_diri(){
        $config['upload_path'] = './upload/user/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['encrypt_name'] = TRUE;
        $config['min_width'] = '800';
        $config['min_height'] = '800';
        $this->upload->initialize($config);

        $id = $this->input->post('id');
        $sql = $this->db->query("SELECT * FROM tb_santri WHERE no_reg = '$id' ")->row_array();
        
        unlink("./upload/user/".$sql['foto_diri']);

        if($this->upload->do_upload('foto')){
            $nama = $this->upload->data();
            $data = ['foto_diri'=>$nama['file_name']];
            $this->santri_model->update_foto($data, $id);
            $this->session->set_flashdata('gambar_berhasil', '<script>swal("Berhasil !", "Upload Foto Berhasil.", "success")</script>');
            redirect('admin_control_panel/edit/'.$id);
        }else{
            $this->session->set_flashdata('error_gambar', '<script>swal("Gagal !", "Gambar harus berformat gif/jgp/png atau jpeg. Dan minimal ukuran gambar adalah 800 X 800", "error")</script>');
            redirect('admin_control_panel/edit/'.$id);
        }
       
    }
    public function update_san($id){
        $data = [
            'nomer_kk'=>$this->input->post('kk'),
            'nik'=>$this->input->post('nik'),
            'nama_lengkap'=>$this->input->post('nama'),
            'jenis_kelamin'=>$this->input->post('gender'),
            'tempat_lahir'=>$this->input->post('tempat'),
            'tanggal_lahir'=>$this->input->post('tanggal'),
            'anak_ke'=>$this->input->post('anak_ke'),
            'dari_saudara'=>$this->input->post('dari_saudara'),
            'tinggal_bersama'=>$this->input->post('tinggal_bersama'),
            'pendidikan_terakhir'=>$this->input->post('pendidikan'),
            'alamat_detail'=>$this->input->post('alamat'),
            'kode_pos'=>$this->input->post('kode_pos'),
            'no_telp'=>$this->input->post('no_tel'),
        ];
        $this->santri_model->update_san($data, $id);
        $this->session->set_flashdata('update', '<script>swal("Berhasil !", "Edit Data Berhasil.", "success")</script>');
        redirect('admin_control_panel/edit/'.$id);
    }
    public function hapus_berkas($id){
        $id1 = $id;
        $sql = $this->db->query("SELECT * FROM tb_gambar WHERE id_gambar = '$id1' ")->row_array();
        
        unlink("./upload/berkas/".$sql['url_gambar']);
        $this->santri_model->hapus($id);
        $this->session->set_flashdata('hapus_berkas', '<script>swal("Berhasil !", "Berkas Berhasil Dihapus.", "success")</script>');
        redirect('admin_control_panel/edit/'.$id);
    }
    public function edit_berkas(){
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
            $no = $this->input->post('id_santri');
            $id = htmlspecialchars($this->input->post('id'));
            if($this->upload->do_upload('berkas')){
                $nama = $this->upload->data();
                $data = [
                    'id_santri'=>$no,
                    'url_gambar'=>$nama['file_name'],
                    'jenis_berkas'=> htmlspecialchars($this->input->post('jenis')),
                    'ket'=>htmlspecialchars($this->input->post('ket'))
                ];
                $this->santri_model->edit_berkas($data, $id);
                $this->session->set_flashdata('berkas_berhasil', '<script>swal("Berhasil !", "Upload Bekas Berhasil.", "success")</script>');
                redirect('admin_control_panel/edit/'.$no);
            }else{
                $this->session->set_flashdata('error_berkas', '<script>swal("Gagal !", "Gambar harus berformat gif/jgp/png atau jpeg. Dan minimal ukuran gambar adalah 800 X 800", "error")</script>');
                redirect('admin_control_panel/edit/'.$no);
            }
        }else{
            $id1 = htmlspecialchars($this->input->post('no_reg'));
            $id = htmlspecialchars($this->input->post('id'));
            $no1 = $this->input->post('id_santri');
            $data = [
                'id_santri'=>$no1,
                
                'jenis_berkas'=> htmlspecialchars($this->input->post('jenis')),
                'ket'=>htmlspecialchars($this->input->post('ket'))
            ];
            $no = $this->input->post('id_santri');
            $this->santri_model->edit_berkas($data, $id);
            $this->session->set_flashdata('berkas_berhasil', '<script>swal("Berhasil !", "Upload Bekas Berhasil.", "success")</script>');
            redirect('admin_control_panel/edit/'.$no);
        }
    }
    public function hapus_wali($id){
        $this->santri_model->hapus_wali($id);
        $no = $this->uri->segment(4);
        
        $this->session->set_flashdata('hapus_wali', '<script>swal("Sukses !", "Wali Berhasil Dihapus !.", "success")</script>');
        redirect('admin_control_panel/edit/'.$no);
    }
    public function tambah_wali($id){
        $data = [
            'nama'=>$this->input->post('nama'),
            'id_santri'=>$id,
            'jenis_kelamin'=>$this->input->post('gender'),
            'tempat_lahir'=>$this->input->post('tempat'),
            'pendidikan_terakhir'=>$this->input->post('pendidikan'),
            'no_tel'=>$this->input->post('nomer'),
            'pekerjaan'=>$this->input->post('job'),
            'penghasilan'=>$this->input->post('penghasilan'),
            'status_wali'=>$this->input->post('status')
        ];

        $this->santri_model->insert_wali($data);
        $this->session->set_flashdata('berhasil_wali', '<script>swal("Sukses !", "Wali Berhasil Ditambahkan !.", "success")</script>');
        redirect('admin_control_panel/edit/'.$id);
    }
    public function edit_wali($id){
        $no = $this->input->post('no_reg');
        $data = [
            'nama'=>$this->input->post('nama'),
            'id_santri'=>$no,
            'jenis_kelamin'=>$this->input->post('gender'),
            'tempat_lahir'=>$this->input->post('tempat'),
            'pendidikan_terakhir'=>$this->input->post('pendidikan'),
            'no_tel'=>$this->input->post('nomer'),
            'pekerjaan'=>$this->input->post('job'),
            'penghasilan'=>$this->input->post('penghasilan'),
            
        ];
        $this->santri_model->update_wali($data, $id);
        $this->session->set_flashdata('edit_wali', '<script>swal("Sukses !", "Wali Berhasil Diedit !.", "success")</script>');
        redirect('admin_control_panel/edit/'.$no);

    }

    public function upload_berkas(){
        $config['upload_path'] = './upload/berkas/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = TRUE;
            $config['min_width'] = '800';
            $config['min_height'] = '800';
            $this->upload->initialize($config);

            

            $id = $this->input->post('no_reg');
            if($this->upload->do_upload('berkas')){
                $nama = $this->upload->data();
                $data = [
                    'id_santri'=>$id,
                    'url_gambar'=>$nama['file_name'],
                    'jenis_berkas'=> htmlspecialchars($this->input->post('jenis')),
                    'ket'=>htmlspecialchars($this->input->post('ket'))
                ];
                $this->santri_model->upload_berkas($data);
                $this->session->set_flashdata('berkas_berhasil', '<script>swal("Berhasil !", "Upload Bekas Berhasil.", "success")</script>');
                redirect('admin_control_panel/edit/'.$id);
            }else{
                $this->session->set_flashdata('error_berkas', '<script>swal("Gagal !", "Gambar harus berformat gif/jgp/png atau jpeg. Dan minimal ukuran gambar adalah 800 X 800", "error")</script>');
                redirect('profil');
            }
    }
    public function data_users(){
        $data['jumlah_santri'] = $this->santri_model->jumlah_santri()->num_rows();
        $data['perempuan'] = $this->santri_model->perempuan()->num_rows();
        $data['laki'] = $this->santri_model->laki()->num_rows();
        $data['users'] = $this->santri_model->read_users()->result();
        $this->load->view('admin/users', $data);
    }
    public function data_bayar(){
        $data['jumlah_santri'] = $this->santri_model->jumlah_santri()->num_rows();
        $data['perempuan'] = $this->santri_model->perempuan()->num_rows();
        $data['laki'] = $this->santri_model->laki()->num_rows();
        $data['tb_bayar'] = $this->santri_model->read_bayar()->result();
        $this->load->view('admin/bayar', $data);
    }
    public function edit_users($id){
        if($this->input->post('password') != ''){
            $data = [
                'nama'=>$this->input->post('nama'),
                'username'=>$this->input->post('username'),
                'password'=>md5($this->input->post('password'))
            ];
            $this->santri_model->update_users($data, $id);
            $this->session->set_flashdata('update_users', '<script>swal("Berhasil !", "Edit Users Berhasil !", "success")</script>');
            redirect('admin_control_panel/data_users');
        }else{
            $data = [
                'nama'=>$this->input->post('nama'),
                'username'=>$this->input->post('username'),
                
            ];
            $this->santri_model->update_users($data, $id);
            $this->session->set_flashdata('update_users', '<script>swal("Berhasil !", "Edit Users Berhasil !", "success")</script>');
            redirect('admin_control_panel/data_users');
        }
    }

	public function edit_bayar($id){
        
            $data = [
				'status'=>$this->input->post('status'),
                
            ];
            $this->santri_model->update_bayar($data, $id);
            $this->session->set_flashdata('update_bayar', '<script>swal("Berhasil !", "Edit PembayaranBerhasil !", "success")</script>');
            redirect('admin_control_panel/data_bayar');
    
    }
    public function insert_users(){
        $data = [
            'nama'=>$this->input->post('nama'),
            'username'=>$this->input->post('username'),
            'password'=>md5($this->input->post('password'))
        ];
        $this->santri_model->insert_users($data);
        $this->session->set_flashdata('insert_users', '<script>swal("Berhasil !", "User Berhasil Ditambahkan !", "success")</script>');
        redirect('admin_control_panel/data_users');
    }
    public function hapus_users($id){
        $this->santri_model->delete_users($id);
        $this->session->set_flashdata('hapus_users', '<script>swal("Berhasil !", "User Berhasil Dihapus !", "success")</script>');
        redirect('admin_control_panel/data_users');
    }
    public function download_data($file){
        force_download('./upload/berkas/'.$file,null);	

}

public function hapus_bayar($id){
	$this->santri_model->delete_bayar($id);
	$this->session->set_flashdata('hapus_bayar', '<script>swal("Berhasil !", "Pembayaran Berhasil Dihapus !", "success")</script>');
	redirect('admin_control_panel/data_bayar');
}
public function back_data(){
    $this->load->dbutil();
    $config = array(  
        'tables'        => array('tb_gambar','tb_santri','tb_wali'),   // Array of tables to backup.
        'ignore'        => array(),                     // List of tables to omit from the backup   
        'format'      => 'zip',             
        'filename'    => 'back_up_daftar.sql'
    );

    $backup =$this->dbutil->backup($config); 

    $db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
    $save = 'uploads/'.$db_name;

    $this->load->helper('file');
    write_file($save, $backup); 
    //$this->load->helper('download');
    force_download($db_name, $backup);
}

}
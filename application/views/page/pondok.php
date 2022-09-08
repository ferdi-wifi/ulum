<?php
   $pdf = new Pdf('P', 'mm', 'F4', true, 'UTF-8', false);
   $pdf->SetTitle('Bukti Pondok');
   $pdf->SetHeaderMargin(10);
   $pdf->SetTopMargin(6);
   $pdf->setFooterMargin(6);
   $pdf->SetAutoPageBreak(true);
   $pdf->SetAuthor('Author');
   $pdf->SetDisplayMode('real', 'default');
   $pdf->AddPage();
   $i=0;
   if ($ibu->num_rows() > 0) {
    foreach ($ibu->result_object() as $k) {
        $ibunama=$k->nama;
        $ibuagama=$k->agama;
        $ibupekerjaan=$k->pekerjaan;
    }
   } else {
        $ibunama="";
        $ibuagama="";
        $ibupekerjaan="";
   }

   if ($ayah->num_rows() > 0) {
    foreach ($ayah->result_object() as $y) {
        $ayahnama=$y->nama;
        $ayahagama=$y->agama;
        $ayahpekerjaan=$y->pekerjaan;
        $ayahtlp=$y->no_tel;
    }
   } else {
        $ayahnama="";
        $ayahagama="";
        $ayahpekerjaan="";
        $ayahtlp="";
   }
   
   $html='<table>
            <tr>
                <td colspan="3">
                <img src="'.base_url('assets/img/pondok.png').'">
                </td>
            </tr>';

   $html.='</table>';
   $html.='<h4><b align="center">FORMULIR PENDAFTARAN SANTRI BARU TAHUN PELAJARAN : 2021-2022</b></h4>
   <h5><b align="center">No. Registrasi :'.$cetak['no_reg'].'</b></h5>';
   $html.='<table border="0">
   <tr>
       <td colspan="2"><h4><b>DATA PRIBADI SANTRI</b></h4></td>
   </tr>
   <tr>
       <td width="150px">1. Nama Lengkap</td>
       <td width="400px">:<b>'.$cetak['nama_lengkap'].'</b></td>
   </tr>
   
   <tr>
       <td>2. Tempat, Tanggal Lahir</td>
       <td>:'.$cetak['tempat_lahir'].', '.tgl_indo($cetak['tanggal_lahir']).
       '</td>     
   </tr>
   <tr>
       <td width="150px">3. Jenis Kelamin</td>
       <td width="400px">:'.ucwords($cetak['jenis_kelamin']).'</td>
   </tr>
   <tr>
   <td width="150px">4. Anak ke</td>
            <td width="400px">:'.ucwords($cetak['anak_ke']).' Dari Saudara</td>
    </tr>
   <tr>
        <td>5. Alamat</td>
        <td>:'.$cetak['alamat_detail'].', Desa: '.$des['nama'].', Kec: ' .$kec['nama'].', '.$kab['nama'].' 
        <br/>Provinsi :'.$prov['nama'].',Kode Pos: '.$cetak['kode_pos'].'</td>
   </tr>
            <tr>
                <td colspan="3"><br/></td>
            </tr>
                <tr>
                <td colspan="3"><h4><b>DATA ORANG TUA/WALI</b></h4></td>
            </tr>
            <tr>
                <td colspan="3">1. Nama Orang Tua/Wali</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp; a.	Ayah</td>
                <td>:'. $ayahnama.'</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp; b.	Ibu</td>
                <td>:'.$ibunama.'</td>
            </tr>
            <tr>
                <td colspan="3">2.	Agama Orang Tua/Wali</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp; a.	Ayah</td>
                <td>:'. $ayahagama.'</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp; b.	Ibu</td>
                <td>:'.$ibuagama.'</td>
            </tr>
            <tr>
            <td colspan="3">3. Pekerjaan Orang Tua/Wali</td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp; a.	Ayah</td>
            <td>:'. $ayahpekerjaan.'</td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp; b.	Ibu</td>
            <td>:'.$ibupekerjaan.'</td>
        </tr>
        <tr>
            <td>4. Nomor Telepon/HP</td>
            <td>:'. $ayahtlp.'</td>
        </tr>
   </table>';
    if($cetak['foto_diri']==""){
        $html.='<img src="'.base_url("upload").'/user/fotokosong.gif" alt="Foto Diri Kosong" width="100"/>';
    }else{
        $html.='<img src="'.base_url("upload").'/user/'.$cetak['foto_diri'].'" alt="Foto Diri Kosong" width="100"/>';
    }
    $html.='<div style="text-align: right"><span><u>Tanggal Pendaftaran</u></span><br>
			<span>'.nama_hari(date('Y-m-d')).','.tgl_indo(date('Y-m-d')).'</span><br>
            <span>Jam:'
            .date("H:i:s").' WIB</span>

        </div>
        <br/>
        <table border="1">
            <tr align="center">
                <td>KETERANGAN</td>
                <td>KETERANGAN</td>
            </tr>
            <tr>
                <td height="100"></td>
                <td></td>
            </tr>
        </table>
	</div>
   ';
   $pdf->writeHTML($html, true, false, true, false, '');
   $pdf->Output('Bukti Pondok.pdf', 'I');
?>





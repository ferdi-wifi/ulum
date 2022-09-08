<?php $this->load->view('admin/header') ?>

<!-- /top tiles -->
<br><br><br><br><br><br><br><br>
<?php echo $this->session->flashdata('succ') ?>
<div class="row" style="padding: 20px;">
	<!-- tulis disini -->

    <table class="table" id="santri">
        <thead>
            <tr>
                <th>No. Registrasi</th>
                <th>Nama Lengkap</th>
                <th>Nomor Kartu Keluarga</th>
                <th>No. Telp</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php 
            echo $this->session->flashdata('berhasil');
        ?>
        <tbody>
            <?php foreach ($santri as $s) {
                ?>
                <tr>

                    <td><?=$s->no_reg?></td>
                    <td><?=$s->nama_lengkap?></td>
                    <td><?=$s->nomer_kk?></td>
                    <td><?=$s->no_telp?></td>
                    <td>
                        <a href="<?=base_url()?>admin_control_panel/detail/<?=$s->no_reg?>" class="btn btn-info btn-sm"><i class="fa fa-info-circle" aria-hidden="true"></i> </a>
                        <a href="<?=base_url()?>admin_control_panel/edit/<?=$s->no_reg?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                        <form action="<?=base_url()?>admin_control_panel/hapus_santri/<?=$s->no_reg?>" method="post" id="form_santri" style="display: inline">
                            <input type="hidden" name="no_reg" value="<?=$s->no_reg?>">
                            <button type="submit" class="btn btn-danger btn-sm btn-mit"><i class="fa fa-trash" aria-hidden="true"></i> </button>
                        </form>
                           
                    </td>
                </tr>
                <?php
            }?>
        </tbody>
    </table>

  


    <script>
        $(document).ready(function(){
            $('#santri').DataTable()
        })
    </script>

</div>
<br />
<?php $this->load->view('admin/footer') ?>

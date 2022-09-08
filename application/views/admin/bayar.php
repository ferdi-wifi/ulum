<?php $this->load->view('admin/header') ?>

<!-- /top tiles -->
<br><br><br><br><br><br><br><br>
<?php echo $this->session->flashdata('succ') ?>
<div class="row" style="padding: 20px;">
	<!-- tulis disini -->

    <?php

    echo $this->session->flashdata('upload_bayar');
    echo $this->session->flashdata('insert_bayar');
    echo $this->session->flashdata('hapus_bayar');
    ?>
    

    <table class="table" id="santri">
        <thead>
            <tr>
                <th>#</th>
               
                <th>ID Santri</th>
                <th>Status Pembayaran</th>
                
                <th>Action</th>
            </tr>
        </thead>
       
        <tbody>
            <?php $no=1; foreach ($tb_bayar as $s) {
                ?>
                <tr>

                    <td><?=$no?></td>
                   
                    <td><?=$s->id_santri?></td>
                    <td><?=$s->status?></td>

                    <td>
                        
                        <a data-toggle="modal" data-target="#edit_bayar" href="#" class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                        <!-- Modal -->
                        <div class="modal fade" id="edit_bayar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Bayar</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?=base_url()?>admin_control_panel/edit_bayar/<?=$s->id_bayar?>" method="post">
                                        <div class="form-group">
                                          <label for="">Bukti Bayar</label>
                                          <img src="<?=base_url('upload')?>/bayar/<?=$s->bukti_bayar?>" class="img-fluid img-thumbnail" alt="">
                                          
                                        </div>
                                        <div class="form-group">
                                          <label for="">Status</label>
                                          <select name="status" class="form-control" required    >
                                            <option selected disabled> -- Jenis Statu -- </option>
                                            <option value="Proses" <?php echo $s->status == 'Proses' ? 'selected' : ''?>>Proses</option>
                                            <option value="Lunas" <?php echo $s->status == 'Lunas' ? 'selected' : ''?>>Lunas</option>
                                            
                                          </select>
                                          
                                        </div>
                                       
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="<?=base_url()?>admin_control_panel/hapus_bayar/<?=$s->id_bayar?>" method="post" id="form_santri" style="display: inline">
                            <input type="hidden" name="id" value="<?=$s->id_bayar?>">
                            <button type="submit" class="btn btn-danger btn-sm btn-mit"><i class="fa fa-trash" aria-hidden="true"></i> </button>
                        </form>
                           
                    </td>
                </tr>
                <?php $no++;
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

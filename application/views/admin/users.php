<?php $this->load->view('admin/header') ?>

<!-- /top tiles -->
<br><br><br><br><br><br><br><br>
<?php echo $this->session->flashdata('succ') ?>
<div class="row" style="padding: 20px;">
	<!-- tulis disini -->

    <?php

    echo $this->session->flashdata('upload_users');
    echo $this->session->flashdata('insert_users');
    echo $this->session->flashdata('hapus_users');
    ?>
    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a>
 
    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Users</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form action="<?=base_url()?>admin_control_panel/insert_users" method="post">
                    <div class="form-group">
                      <label for="">Nama Lengkap</label>
                      <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap" aria-describedby="helpId">
                      
                    </div>
                    <div class="form-group">
                      <label for="">Username</label>
                      <input type="text" name="username" class="form-control" placeholder="Masukkan Username" aria-describedby="helpId">
                      
                    </div>
                    <div class="form-group">
                      <label for="">Password</label>
                      <input type="password" name="password" class="form-control" placeholder="Masukkan Password" aria-describedby="helpId">
                      
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
    <table class="table" id="santri">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                
                <th>Action</th>
            </tr>
        </thead>
       
        <tbody>
            <?php $no=1; foreach ($users as $s) {
                ?>
                <tr>

                    <td><?=$no?></td>
                    <td><?=$s->nama?></td>
                    <td><?=$s->username?></td>

                    <td>
                        
                        <a data-toggle="modal" data-target="#edit_users" href="#" class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                        <!-- Modal -->
                        <div class="modal fade" id="edit_users" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Users</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?=base_url()?>admin_control_panel/edit_users/<?=$s->id_users?>" method="post">
                                        <div class="form-group">
                                          <label for="">Nama Lengkap</label>
                                          <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Lengkap" aria-describedby="helpId">
                                          
                                        </div>
                                        <div class="form-group">
                                          <label for="">Username</label>
                                          <input type="text" name="username" class="form-control" placeholder="Username" aria-describedby="helpId">
                                          
                                        </div>
                                        <div class="form-group">
                                          <label for="">Password</label>
                                          <input type="password" name="password" class="form-control" placeholder="Masukan Password" aria-describedby="helpId">
                                          <small style="color: red"><i class="fa fa-info-circle" aria-hidden="true"></i> Isi Password jika, Password ingin diubah !</small>
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
                        <form action="<?=base_url()?>admin_control_panel/hapus_users/<?=$s->id_users?>" method="post" id="form_santri" style="display: inline">
                            <input type="hidden" name="id" value="<?=$s->id_users?>">
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

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            LAPORAN KASUS
            <small>DIT RESKRIMSUS POLDA RIAU</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">LaporanKasus</a></li>
            <li class="active">Daftar Laporan Kasus</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Daftar Laporan Kasus</h3>
                        <br />
                        <br />
                       <?php if ($this->session->flashdata('success')): ?>
						    <div class="alert alert-success alert-dismissible">
						        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						        <h4><i class="icon fa fa-check"></i> Selamat!</h4>
						        <?php echo $this->session->flashdata('success'); ?>
						    </div>
						<?php endif; ?>

						<?php if ($this->session->flashdata('error')): ?>
						    <div class="alert alert-danger alert-dismissible">
						        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						        <h4><i class="icon fa fa-ban"></i> WARNING!!</h4>
						        <?php echo $this->session->flashdata('error'); ?>
						    </div>
						<?php endif; ?>


                        <!-- Tombol Tambah Kasus -->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                            Tambah Kasus
                        </button>
                    </div>
                   <div class="box-body">
					    <div class="table-responsive">
					        <table id="tablesiji" class="table table-bordered table-striped">
					            <thead>
					                <tr>
					                    <th width="5%">No</th>
					                    <th>Nomor Laporan</th>
					                    <th>Nomor KK</th>
					                    <th>Nama</th>
					                    <th>Tanggal Laporan</th>
					                    <th>Deskripsi Kasus</th>
					                    <th>Status</th>
					                    <th>Aksi</th>
					                </tr>
					            </thead>
					            <tbody>
					                <?php
					                $no = 1;
					                foreach ($laporanKasus as $lp): ?>
					                    <tr>
					                        <td><?php echo $no++;?></td>
					                        <td><?php echo $lp->nomor_lp ;?></td>
					                        <td><?php echo $lp->nomor_kk ;?></td>
					                        <td><?php echo $lp->nama_pelapor ;?></td>
					                        <td><?php echo date('d F Y', strtotime($lp->tanggal_laporan)); ?></td>
					                        <td><?php echo $lp->deskripsi_kasus ;?></td>
					                        <td><?php echo $lp->status ;?></td>
					                        <td>
					                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?= $lp->id ?>">Edit</button>
					                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?= $lp->id ?>">Delete</button>
					                        </td>
					                    </tr>
					                <?php endforeach ;?>
					            </tbody>
					        </table>
					    </div>
					</div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
 <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">FORM KASUS</h4>
                </div>
                <div class="modal-body">
                    <form role="form" action="<?php echo base_url('laporan/add');?>" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nomor_lp">NOMOR LAPORAN</label>
                                <input type="text" class="form-control" id="nomor_lp" name="nomor_lp" placeholder="Masukkan Nomor LP..." required>
                            </div>
                            <div class="form-group">
                                <label for="nomor_kk">NOMOR KK</label>
                                <input type="text" class="form-control" id="nomor_kk" name="nomor_kk" placeholder="Masukkan Nomor KK..." required>
                            </div>
                            <div class="form-group">
                                <label for="nama_pelapor">NAMA PELAPOR</label>
                                <input type="text" class="form-control" id="nama_pelapor" name="nama_pelapor" placeholder="Masukkan Nama..." required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_laporan">TANGGAL LAPORAN</label>
                                <input type="date" class="form-control" id="tanggal_laporan" name="tanggal_laporan" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_kasus">DESKRIPSI KASUS</label>
                                <textarea class="form-control" rows="5" placeholder="Deskripsi Kasus..." name="deskripsi_kasus" required></textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                            <a href="<?php echo base_url('laporan/laporanKasus');?>" class="btn btn-danger">Close</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Edit -->
    <?php foreach ($laporanKasus as $lp): ?>
		<div class="modal fade" id="editModal<?= $lp->id ?>">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                    <span aria-hidden="true">&times;</span>
		                </button>
		                <h4 class="modal-title">Edit Kasus</h4>
		            </div>
		            <div class="modal-body">
		                <form role="form" action="<?= site_url('laporan/edit/'.$lp->id) ?>" method="post">
		                    <input type="hidden" name="edit_id" id="edit_id"> <!-- Input tersembunyi untuk menyimpan ID laporan kasus yang akan diedit -->
		                    <div class="box-body">
		                        <div class="form-group">
		                            <label for="edit_nomor_lp">NOMOR LAPORAN</label>
		                            <input type="text" class="form-control" id="edit_nomor_lp" name="nomor_lp" value="<?= $lp->nomor_lp ?>" placeholder="Masukkan Nomor LP..." required>
		                        </div>
		                        <div class="form-group">
		                            <label for="edit_nomor_kk">NOMOR KK</label>
		                            <input type="text" class="form-control" id="edit_nomor_kk" name="nomor_kk" value="<?= $lp->nomor_kk ?>" placeholder="Masukkan Nomor KK..." required>
		                        </div>
		                        <div class="form-group">
		                            <label for="edit_nama_pelapor">NAMA PELAPOR</label>
		                            <input type="text" class="form-control" id="edit_nama_pelapor" name="nama_pelapor" value="<?= $lp->nama_pelapor ?>" placeholder="Masukkan Nama..." required>
		                        </div>
		                        <div class="form-group">
		                            <label for="edit_tanggal_laporan">TANGGAL LAPORAN</label>
		                            <input type="date" class="form-control" id="edit_tanggal_laporan" value="<?= $lp->tanggal_laporan ?>" name="tanggal_laporan" required>
		                        </div>
		                        <div class="form-group">
		                            <label for="edit_deskripsi_kasus">DESKRIPSI KASUS</label>
		                            <textarea class="form-control" rows="5" id="edit_deskripsi_kasus" name="deskripsi_kasus" required><?= $lp->deskripsi_kasus ?>
		                            </textarea>
		                        </div>
		                    </div>
		                    <div class="box-footer">
		                        <button type="submit" class="btn btn-primary">Update</button>
		                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		                    </div>
		                </form>
		            </div>
		        </div>
		    </div>
		</div>
	<?php endforeach; ?>

	<!-- Modal Hapus Laporan Kasus -->
 <?php foreach ($laporanKasus as $lp): ?>
		<div class="modal fade" id="deleteModal<?= $lp->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Hapus Laporan Kasus</h4>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus laporan kasus ini?</p>
            </div>
            <div class="modal-footer">
                <a href="<?= site_url('laporan/delete/'.$lp->id) ?>" class="btn btn-danger">Ya</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

   
</div>
<!-- /.content-wrapper -->
